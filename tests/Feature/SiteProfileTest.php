<?php

namespace Tests\Feature;

use App\Models\SiteProfile;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SiteProfileTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_portfolio_renders_seeded_site_profile(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('CodePort');
        $response->assertSee('Lab');
        $response->assertSee('CLOUD & DEVOPS');
        $response->assertSee('Gobikrishna Subramaniyam');
        $response->assertSee('Founder & Senior Cloud Architect @ CodePortLab');
        $response->assertSee('Jaffna, Sri Lanka / UTC+5:30');
    }

    public function test_portfolio_updates_when_site_profile_is_edited(): void
    {
        $profile = SiteProfile::getActive();
        $profile->update([
            'brand_name' => 'DevOpsPro',
            'brand_accent' => 'Cloud',
            'tagline' => 'ENTERPRISE SRE & CLOUD',
            'founder_name' => 'Gobikrishna S.',
            'founder_title' => 'Principal Cloud Architect',
            'location' => 'Singapore / UTC+8',
            'email' => 'admin@codeportlab.com',
            'phone' => '+65 9123 4567',
            'twitter_url' => 'https://x.com/gobikrishna',
            'youtube_url' => 'https://youtube.com/@codeportlab',
            'custom_social_links' => [
                ['label' => 'Discord Community', 'url' => 'https://discord.gg/codeportlab'],
                ['label' => 'Substack Newsletter', 'url' => 'https://codeportlab.substack.com'],
            ],
            'copyright_text' => 'DevOpsPro Cloud Consulting Ltd.',
        ]);

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('DevOpsPro');
        $response->assertSee('Cloud');
        $response->assertSee('ENTERPRISE SRE & CLOUD');
        $response->assertSee('Gobikrishna S.');
        $response->assertSee('Principal Cloud Architect');
        $response->assertSee('Singapore / UTC+8');
        $response->assertSee('admin@codeportlab.com');
        $response->assertSee('+65 9123 4567');
        $response->assertSee('X / Twitter');
        $response->assertSee('YouTube');
        $response->assertSee('Discord Community');
        $response->assertSee('Substack Newsletter');
        $response->assertSee('DevOpsPro Cloud Consulting Ltd.');
    }

    public function test_admin_can_access_filament_site_profiles_resource(): void
    {
        $user = User::first();

        $response = $this->actingAs($user)->get('/admin/site-profiles');
        $response->assertStatus(200);

        $createResponse = $this->actingAs($user)->get('/admin/site-profiles/create');
        $createResponse->assertStatus(200);

        $profile = SiteProfile::getActive();
        $editResponse = $this->actingAs($user)->get("/admin/site-profiles/{$profile->id}/edit");
        $editResponse->assertStatus(200);
    }

    public function test_login_route_redirects_to_filament_login(): void
    {
        $response = $this->get('/login');
        $response->assertRedirect('/admin/login');
    }
}
