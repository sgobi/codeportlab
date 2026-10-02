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
        $updates = [
            [
                'title' => 'Optimizing Laravel 10 Applications for MySQL 5.7 Legacy cPanel Hosts',
                'category' => 'DevOps & Cloud',
                'summary' => 'Key techniques for deploying modern Laravel 10 and Filament v3 apps on legacy MySQL 5.7 hosting without relying on native JSON types or MySQL 8 CTE syntax.',
                'content' => '<p>Deploying modern Laravel 10 frameworks onto cPanel environments running MySQL 5.7 requires careful database indexing and legacy query optimization. In this writeup, we analyze storage layout, root directory isolation, and opcode caching settings for maximum speed under 1GB quota limits.</p>',
                'external_url' => 'https://codeportlab.com',
                'is_pinned' => true,
                'is_published' => true,
                'published_at' => now(),
            ],
            [
                'title' => 'Building Zero-Downtime Infrastructure Pipelines with Terraform & GitHub Actions',
                'category' => 'Architecture',
                'summary' => 'A practical guide to structuring modular Terraform code with remote state locking, automated plans on PR, and controlled apply steps.',
                'content' => '<p>Infrastructure as Code is only as good as the CI/CD pipeline enforcing it. Learn how to set up plan previews on Pull Requests and strict approval gates for production deployments.</p>',
                'external_url' => 'https://codeportlab.com',
                'is_pinned' => false,
                'is_published' => true,
                'published_at' => now()->subDays(2),
            ],
            [
                'title' => 'Designing Glassmorphic Dark UIs with Tailwind CSS & Filament v3',
                'category' => 'Full-Stack',
                'summary' => 'How to craft sleek, responsive developer tools and admin panels using dynamic backdrop filters, custom color tokens, and JetBrains Mono typography.',
                'content' => '<p>Combining high aesthetic visual design with enterprise usability. We breakdown CSS backdrop-filter tricks, tailored HSL color palettes, and responsive glass panel components.</p>',
                'external_url' => 'https://codeportlab.com',
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
