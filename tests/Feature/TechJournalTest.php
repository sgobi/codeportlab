<?php

namespace Tests\Feature;

use App\Models\TechUpdate;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TechJournalTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_portfolio_renders_dynamic_published_tech_journal_articles(): void
    {
        TechUpdate::query()->delete();

        TechUpdate::create([
            'title' => 'Building Microservices with Go and Kubernetes',
            'category' => 'Cloud Architecture',
            'summary' => 'A comprehensive deep-dive into resilient microservice communication patterns.',
            'content' => '<p>A comprehensive deep-dive into resilient microservice communication patterns.</p>',
            'external_url' => 'https://medium.com/@gobik1990/building-microservices-with-go',
            'is_pinned' => false,
            'is_published' => true,
            'published_at' => now(),
        ]);

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Building Microservices with Go and Kubernetes');
        $response->assertSee('Cloud Architecture');
        $response->assertSee('A comprehensive deep-dive into resilient microservice communication patterns.');
        $response->assertSee('https://medium.com/@gobik1990/building-microservices-with-go');
        $response->assertSee('Published');
    }

    public function test_pinned_tech_journal_article_displays_featured_badge(): void
    {
        TechUpdate::query()->delete();

        TechUpdate::create([
            'title' => 'Mastering AWS Graviton3 Architecture',
            'category' => 'AWS & Performance',
            'summary' => 'Benchmarking ARM performance in mission-critical workloads.',
            'external_url' => 'https://medium.com/@gobik1990/aws-graviton3-architecture',
            'is_pinned' => true,
            'is_published' => true,
            'published_at' => now(),
        ]);

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Mastering AWS Graviton3 Architecture');
        $response->assertSee('Featured');
    }

    public function test_unpublished_tech_journal_articles_are_not_rendered(): void
    {
        TechUpdate::query()->delete();

        TechUpdate::create([
            'title' => 'Draft Confidential Architectural Analysis',
            'category' => 'Internal Research',
            'summary' => 'This draft is under review and should never be visible to the public.',
            'is_pinned' => false,
            'is_published' => false,
            'published_at' => now(),
        ]);

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertDontSee('Draft Confidential Architectural Analysis');
    }

    public function test_portfolio_renders_graceful_fallback_when_no_tech_updates_exist(): void
    {
        TechUpdate::query()->delete();

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Tech Journal');
        $response->assertSee('Zero-Touch Deployments on Shared cPanel Hosting with GitHub Actions');
        $response->assertSee('Ingress NGINX Retirement in March 2026: What to Do, When to Do It, and Why');
        $response->assertSee('ECS vs. EKS: Which AWS Container Orchestrator Is Right for Your Business?');
    }

    public function test_admin_can_access_filament_tech_updates_resource(): void
    {
        $user = User::first();

        $response = $this->actingAs($user)->get('/admin/tech-updates');
        $response->assertStatus(200);

        $createResponse = $this->actingAs($user)->get('/admin/tech-updates/create');
        $createResponse->assertStatus(200);

        $article = TechUpdate::first();
        if ($article) {
            $editResponse = $this->actingAs($user)->get("/admin/tech-updates/{$article->id}/edit");
            $editResponse->assertStatus(200);
        }
    }
}
