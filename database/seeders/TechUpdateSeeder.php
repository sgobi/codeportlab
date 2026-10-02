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
                'title' => 'How We Reduced AWS Infrastructure Costs by 38% Using Terraform',
                'category' => 'Cloud Cost Optimization',
                'summary' => 'A strategic breakdown of rightsizing AWS resources, optimizing container compute on EKS, and automating lifecycle policies via Terraform IaC.',
                'content' => '<p>A strategic breakdown of rightsizing AWS resources, optimizing container compute on EKS, and automating lifecycle policies via Terraform IaC.</p>',
                'external_url' => 'https://codeportlab.com/#journal',
                'is_pinned' => true,
                'is_published' => true,
                'published_at' => now(),
            ],
            [
                'title' => 'Zero-Downtime CI/CD Pipelines for Enterprise Web Applications',
                'category' => 'DevOps & CI/CD',
                'summary' => 'Architecting resilient automated delivery pipelines using GitHub Actions, Docker containerization, and canary deployment rollouts.',
                'content' => '<p>Architecting resilient automated delivery pipelines using GitHub Actions, Docker containerization, and canary deployment rollouts.</p>',
                'external_url' => 'https://codeportlab.com/#journal',
                'is_pinned' => false,
                'is_published' => true,
                'published_at' => now()->subDays(2),
            ],
            [
                'title' => 'Optimizing High-Traffic Laravel Applications on Constrained VPS Hosting',
                'category' => 'Backend Architecture',
                'summary' => 'Techniques for maximizing throughput and reducing database bottlenecks for Laravel 11 / PHP 8.2+ / MySQL 8.0, with backward compatibility notes for legacy cPanel environments.',
                'content' => '<p>Techniques for maximizing throughput and reducing database bottlenecks for Laravel 11 / PHP 8.2+ / MySQL 8.0, with backward compatibility notes for legacy cPanel environments.</p>',
                'external_url' => '#journal-rose-villa',
                'is_pinned' => false,
                'is_published' => true,
                'published_at' => now()->subDays(5),
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
