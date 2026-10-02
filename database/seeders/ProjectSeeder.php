<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Project::query()->delete();

        $projects = [
            [
                'title' => 'Enterprise EKS Kubernetes Migration & AWS Cost Optimization',
                'category' => 'Infrastructure Lab Benchmark',
                'tech_stack' => '38% AWS Cost Reduction, Zero-Downtime Deployment, 99.99% Uptime',
                'description' => 'Architected and executed a zero-downtime migration of multi-region monolithic workloads to AWS EKS clusters managed via IaC (Terraform) and GitOps deployment automation.',
                'content' => '<h3>Architectural Highlights</h3><p>Designed immutable infrastructure modules with Terraform to standardize cluster provisioning. Implemented GitOps using ArgoCD for automated canary deployments, reducing deployment lead time by 75% while maintaining strict SOC2 compliance standards.</p>',
                'live_url' => 'https://codeportlab.com',
                'article_url' => 'https://codeportlab.com/#journal',
                'sort_order' => 1,
                'is_featured' => true,
            ],
            [
                'title' => 'Productized Backend & Edge POS Infrastructure (Rose Villa)',
                'category' => 'Client Production System',
                'tech_stack' => 'Laravel 11 / PHP 8.2+ / MySQL 8.0, Filament v3, ESC/POS',
                'description' => 'Engineered high-performance Laravel 11 / PHP 8.2+ / MySQL 8.0 & Filament v3 backend integrated with ESC/POS print engines, automated cloud backups, and remote support.',
                'content' => '<h3>System Implementation</h3><p>Engineered resilient point-of-sale infrastructure connected to distributed cloud backends with real-time sync, automated offsite snapshots, and low-latency receipt generation.</p>',
                'live_url' => 'https://codeportlab.com',
                'article_url' => '#journal-rose-villa',
                'sort_order' => 2,
                'is_featured' => true,
            ],
            [
                'title' => 'Automated Cloud Governance & IaC Compliance Engine',
                'category' => 'Infrastructure Lab Benchmark',
                'tech_stack' => '38% AWS Cost Reduction, Zero-Downtime Deployment, 99.99% Uptime',
                'description' => 'Engineered continuous compliance rules checking infrastructure code against CIS benchmarks, automatically catching misconfigured S3 buckets and exposed security groups prior to merge.',
                'content' => '<h3>Security Controls</h3><p>Integrated pre-commit terraform validation with automated AWS Config custom rules. Reduced cloud security vulnerability findings by 90% across production accounts.</p>',
                'live_url' => 'https://codeportlab.com',
                'article_url' => 'https://codeportlab.com/#journal',
                'sort_order' => 3,
                'is_featured' => true,
            ],
        ];

        foreach ($projects as $project) {
            Project::updateOrCreate(
                ['title' => $project['title']],
                $project
            );
        }
    }
}
