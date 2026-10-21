<?php

namespace Tests\Feature;

use App\Filament\Resources\AuditRequestResource\Pages\EditAuditRequest;
use App\Filament\Resources\AuditRequestResource\Pages\ListAuditRequests;
use App\Filament\Resources\AuditRequestResource\Pages\ViewAuditRequest;
use App\Models\AuditRequest;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Livewire\Livewire;
use Tests\TestCase;

class AuditRequestResourceTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->create();
    }

    public function test_unauthenticated_visitors_cannot_access_audit_requests_resource(): void
    {
        $lead = AuditRequest::create([
            'email' => 'client@example.com',
            'stack' => 'AWS + Laravel',
            'status' => 'pending',
        ]);

        $this->get('/admin/audit-requests')->assertRedirect('/admin/login');
        $this->get("/admin/audit-requests/{$lead->id}")->assertRedirect('/admin/login');
        $this->get("/admin/audit-requests/{$lead->id}/edit")->assertRedirect('/admin/login');
    }

    public function test_authenticated_admin_can_access_audit_requests_index(): void
    {
        AuditRequest::create([
            'email' => 'client@example.com',
            'stack' => 'AWS + Laravel',
            'status' => 'pending',
        ]);

        $response = $this->actingAs($this->admin)->get('/admin/audit-requests');
        $response->assertStatus(200);
        $response->assertSee('Audit Requests');
    }

    public function test_audit_requests_can_be_listed_and_searched(): void
    {
        $lead1 = AuditRequest::create([
            'email' => 'target.client@example.com',
            'stack' => 'Kubernetes + Terraform',
            'status' => 'pending',
        ]);

        $lead2 = AuditRequest::create([
            'email' => 'other.person@example.com',
            'stack' => 'Docker Swarm',
            'status' => 'sent',
        ]);

        Livewire::actingAs($this->admin);

        Livewire::test(ListAuditRequests::class)
            ->assertCanSeeTableRecords([$lead1, $lead2])
            ->searchTable('target.client')
            ->assertCanSeeTableRecords([$lead1])
            ->assertCanNotSeeTableRecords([$lead2]);
    }

    public function test_audit_requests_can_be_filtered_by_status(): void
    {
        $pendingLead = AuditRequest::create([
            'email' => 'pending@example.com',
            'stack' => 'AWS',
            'status' => 'pending',
        ]);

        $failedLead = AuditRequest::create([
            'email' => 'failed@example.com',
            'stack' => 'Azure',
            'status' => 'failed',
        ]);

        Livewire::actingAs($this->admin);

        Livewire::test(ListAuditRequests::class)
            ->filterTable('status', 'failed')
            ->assertCanSeeTableRecords([$failedLead])
            ->assertCanNotSeeTableRecords([$pendingLead]);
    }

    public function test_admin_can_view_lead_details(): void
    {
        $lead = AuditRequest::create([
            'email' => 'client.detail@example.com',
            'stack' => 'AWS EKS + Terraform',
            'scope' => 'Migrate 15 microservices from on-prem to AWS EKS with zero downtime.',
            'status' => 'pending',
        ]);

        $response = $this->actingAs($this->admin)->get("/admin/audit-requests/{$lead->id}");
        $response->assertStatus(200);
        $response->assertSee('client.detail@example.com');
        $response->assertSee('AWS EKS + Terraform');
        $response->assertSee('Migrate 15 microservices from on-prem to AWS EKS with zero downtime.');
    }

    public function test_admin_can_update_lead_status(): void
    {
        $lead = AuditRequest::create([
            'email' => 'client.update@example.com',
            'stack' => 'GCP + Cloud Run',
            'status' => 'pending',
        ]);

        Livewire::actingAs($this->admin);

        Livewire::test(EditAuditRequest::class, ['record' => $lead->getRouteKey()])
            ->fillForm([
                'status' => 'failed',
            ])
            ->call('save')
            ->assertHasNoFormErrors();

        $this->assertEquals('failed', $lead->fresh()->status);
    }

    public function test_admin_cannot_manually_forge_sent_status(): void
    {
        $lead = AuditRequest::create([
            'email' => 'client.unsent@example.com',
            'stack' => 'GCP',
            'status' => 'pending',
        ]);

        Livewire::actingAs($this->admin);

        Livewire::test(EditAuditRequest::class, ['record' => $lead->getRouteKey()])
            ->fillForm([
                'status' => 'sent',
            ])
            ->call('save')
            ->assertHasFormErrors(['status']);

        $this->assertEquals('pending', $lead->fresh()->status);
    }

    public function test_sent_lead_status_is_locked_and_duplicate_send_is_prevented(): void
    {
        $lead = AuditRequest::create([
            'email' => 'client.sent@example.com',
            'stack' => 'AWS IaC',
            'status' => 'sent',
            'email_sent_at' => now(),
        ]);

        Mail::shouldReceive('raw')->never();

        // sendNotification must return true immediately without dispatching mail
        $this->assertTrue($lead->sendNotification());
    }


    public function test_successful_retry_action_sends_notification_and_updates_status(): void
    {
        $lead = AuditRequest::create([
            'email' => 'retry.success@example.com',
            'stack' => 'AWS IaC',
            'scope' => 'Review CloudFormation templates',
            'status' => 'failed',
        ]);

        Mail::shouldReceive('raw')
            ->once()
            ->andReturn(null);

        Livewire::actingAs($this->admin);

        Livewire::test(ListAuditRequests::class)
            ->callTableAction('retryEmail', $lead)
            ->assertHasNoTableActionErrors();

        $lead->refresh();
        $this->assertEquals('sent', $lead->status);
        $this->assertNotNull($lead->email_sent_at);
    }

    public function test_failed_retry_action_preserves_lead_and_keeps_failed_status(): void
    {
        $lead = AuditRequest::create([
            'email' => 'retry.fail@example.com',
            'stack' => 'Azure DevOps',
            'scope' => 'Audit CI/CD security',
            'status' => 'failed',
        ]);

        Mail::shouldReceive('raw')
            ->once()
            ->andThrow(new \Exception('SMTP timeout'));

        Livewire::actingAs($this->admin);

        Livewire::test(ListAuditRequests::class)
            ->callTableAction('retryEmail', $lead);

        $lead->refresh();
        $this->assertEquals('failed', $lead->status);
        $this->assertNull($lead->email_sent_at);
    }
}
