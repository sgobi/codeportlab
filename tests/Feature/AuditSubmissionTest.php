<?php

namespace Tests\Feature;

use App\Models\AuditRequest;
use Exception;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class AuditSubmissionTest extends TestCase
{
    use RefreshDatabase;

    public function test_valid_audit_submission_is_stored_in_database_and_sends_notification(): void
    {
        Mail::shouldReceive('raw')->once();

        $response = $this->post('/', [
            'email' => 'CTO@Company.COM',
            'stack' => 'AWS EKS, Terraform IaC',
            'scope' => 'Need architecture review and cost tuning.',
        ]);

        $response->assertRedirect('/#contact');
        $response->assertSessionHas('audit_success');

        // Email should be normalized to lowercase
        $this->assertDatabaseHas('audit_requests', [
            'email' => 'cto@company.com',
            'stack' => 'AWS EKS, Terraform IaC',
            'scope' => 'Need architecture review and cost tuning.',
            'status' => 'sent',
        ]);

        $lead = AuditRequest::where('email', 'cto@company.com')->first();
        $this->assertNotNull($lead);
        $this->assertNotNull($lead->email_sent_at);
    }

    public function test_audit_submission_via_contact_route_works(): void
    {
        Mail::shouldReceive('raw')->once();

        $response = $this->post('/contact', [
            'email' => 'lead@domain.com',
            'stack' => 'Docker, Kubernetes',
        ]);

        $response->assertRedirect('/#contact');
        $response->assertSessionHas('audit_success');

        $this->assertDatabaseHas('audit_requests', [
            'email' => 'lead@domain.com',
            'stack' => 'Docker, Kubernetes',
            'status' => 'sent',
        ]);
    }

    public function test_invalid_email_and_missing_stack_produce_validation_errors(): void
    {
        Mail::shouldReceive('raw')->never();

        $response = $this->post('/', [
            'email' => 'not-a-valid-email',
            'stack' => '',
            'scope' => 'Some description',
        ]);

        $response->assertSessionHasErrors(['email', 'stack']);
        $this->assertDatabaseCount('audit_requests', 0);
    }

    public function test_scope_exceeding_max_length_fails_validation(): void
    {
        Mail::shouldReceive('raw')->never();

        $response = $this->post('/', [
            'email' => 'valid@domain.com',
            'stack' => 'AWS',
            'scope' => str_repeat('a', 2001),
        ]);

        $response->assertSessionHasErrors(['scope']);
        $this->assertDatabaseCount('audit_requests', 0);
    }

    public function test_mail_failure_leaves_lead_stored_with_failed_status(): void
    {
        Mail::shouldReceive('raw')
            ->once()
            ->andThrow(new Exception('Simulated SMTP connection timeout'));

        $response = $this->post('/', [
            'email' => 'client@enterprise.com',
            'stack' => 'Laravel 11, CloudLinux cPanel',
            'scope' => 'Offsite backups setup',
        ]);

        $response->assertRedirect('/#contact');
        // Must show truthful warning rather than misleading success
        $response->assertSessionHas('audit_warning');

        $this->assertDatabaseHas('audit_requests', [
            'email' => 'client@enterprise.com',
            'stack' => 'Laravel 11, CloudLinux cPanel',
            'status' => 'failed',
            'email_sent_at' => null,
        ]);
    }

    public function test_duplicate_submission_within_five_minutes_is_debounced(): void
    {
        // First submission sends 1 email, second is debounced (0 emails)
        Mail::shouldReceive('raw')->once();

        // First submission
        $this->post('/', [
            'email' => 'repeat@client.com',
            'stack' => 'AWS EKS',
            'scope' => 'Initial inquiry',
        ]);

        $this->assertDatabaseCount('audit_requests', 1);

        // Immediate duplicate submission with case difference
        $response2 = $this->post('/', [
            'email' => 'REPEAT@CLIENT.COM',
            'stack' => 'AWS EKS',
            'scope' => 'Initial inquiry',
        ]);

        $response2->assertSessionHas('audit_success');

        // No new record inserted, no second email sent
        $this->assertDatabaseCount('audit_requests', 1);
    }

    public function test_rate_limiting_returns_429_after_exceeding_limit(): void
    {
        Mail::shouldReceive('raw')->times(5);

        for ($i = 0; $i < 5; $i++) {
            $this->post('/', [
                'email' => "user{$i}@example.com",
                'stack' => "Stack {$i}",
            ]);
        }

        // 6th attempt within the 1-minute throttle window
        $response = $this->post('/', [
            'email' => 'user6@example.com',
            'stack' => 'Stack 6',
        ]);

        $response->assertStatus(429);
    }

    public function test_ajax_submission_returns_json_response(): void
    {
        Mail::shouldReceive('raw')->once();

        $response = $this->postJson('/', [
            'email' => 'ajax@client.com',
            'stack' => 'Terraform',
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
        ]);

        $this->assertDatabaseHas('audit_requests', [
            'email' => 'ajax@client.com',
            'status' => 'sent',
        ]);
    }
}
