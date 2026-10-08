<?php

namespace Database\Seeders;

use App\Models\TechUpdate;
use Illuminate\Database\Seeder;

class TechUpdateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TechUpdate::query()->delete();

        $updates = [
            [
                'title' => 'Zero-Touch Deployments on Shared cPanel Hosting with GitHub Actions',
                'category' => 'DEVOPS & CI/CD',
                'summary' => 'CI/CD for shared cPanel with no SSH: GitHub Actions, FTPS sync, a key-protected PHP deploy hook, and a health check.',
                'content' => '<p>CI/CD for shared cPanel with no SSH: GitHub Actions, FTPS sync, a key-protected PHP deploy hook, and a health check.</p>',
                'external_url' => 'https://medium.com/@gobik1990/zero-touch-deployments-on-shared-cpanel-hosting-with-github-actions-010d1e875444',
                'is_pinned' => true,
                'is_published' => true,
                'published_at' => now()->subDays(5),
            ],
            [
                'title' => 'Ingress NGINX Retirement in March 2026: What to Do, When to Do It, and Why',
                'category' => 'KUBERNETES',
                'summary' => 'A phased migration plan from Ingress NGINX to Gateway API, with a comparison of NGINX, F5 BIG-IP and API gateways.',
                'content' => '<p>A phased migration plan from Ingress NGINX to Gateway API, with a comparison of NGINX, F5 BIG-IP and API gateways.</p>',
                'external_url' => 'https://medium.com/@gobik1990/ingress-nginx-retirement-in-march-2026-what-to-do-when-to-do-it-and-why-fb692cfc16d2',
                'is_pinned' => false,
                'is_published' => true,
                'published_at' => now()->subDays(12),
            ],
            [
                'title' => 'ECS vs. EKS: Which AWS Container Orchestrator Is Right for Your Business?',
                'category' => 'AWS & CONTAINERS',
                'summary' => 'A practical comparison of AWS ECS and EKS to help you choose a container orchestrator.',
                'content' => '<p>A practical comparison of AWS ECS and EKS to help you choose a container orchestrator.</p>',
                'external_url' => 'https://medium.com/@gobik1990/ecs-vs-eks-which-aws-container-orchestrator-is-right-for-your-business-25b4445eb9a1',
                'is_pinned' => false,
                'is_published' => true,
                'published_at' => now()->subDays(20),
            ],
        ];

        foreach ($updates as $update) {
            TechUpdate::updateOrCreate(
                ['title' => $update['title']],
                $update
            );
        }
    }
}
