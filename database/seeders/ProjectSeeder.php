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
        $projects = [
            [
                'title' => 'Enterprise EKS Kubernetes Migration & GitOps Pipeline',
                'category' => 'DevOps & Cloud',
                'tech_stack' => 'AWS EKS, Terraform, ArgoCD, Helm, Docker, GitHub Actions',
                'description' => 'Architected and executed a zero-downtime migration of multi-region monolithic workloads to AWS EKS clusters managed via IaC (Terraform) and GitOps deployment automation.',
                'content' => '<h3>Architectural Highlights</h3><p>Designed immutable infrastructure modules with Terraform to standardize cluster provisioning. Implemented GitOps using ArgoCD for automated canary deployments, reducing deployment lead time by 75% while maintaining strict SOC2 compliance standards.</p>',
                'live_url' => 'https://codeportlab.com',
                'article_url' => 'https://codeportlab.com/#journal',
                'sort_order' => 1,
                'is_featured' => true,
            ],
            [
                'title' => 'High-Availability Laravel Platform on CloudLinux 7 & Apache',
                'category' => 'Full-Stack Architecture',
                'tech_stack' => 'Laravel 10, PHP 8.1, MySQL 5.7, Apache, Redis, Filament v3',
                'description' => 'Built a high-performance developer portfolio & content engine optimized specifically for cPanel shared-virtual environments with tight MySQL 5.7 strict schema compatibility.',
                'content' => '<h3>Optimization Breakdown</h3><p>Optimized asset size and query performance under a strict 1GB storage quota budget. Configured custom Apache mod_rewrite root isolation to guarantee security while supporting full Filament 3 administration.</p>',
                'live_url' => 'https://codeportlab.com',
                'article_url' => 'https://codeportlab.com/#journal',
                'sort_order' => 2,
                'is_featured' => true,
            ],
            [
                'title' => 'Automated Cloud Governance & IaC Compliance Engine',
                'category' => 'Architecture & Security',
                'tech_stack' => 'AWS IAM, Terraform Cloud, Python, AWS Config, CloudWatch',
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
