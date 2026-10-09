<?php

namespace Database\Seeders;

use App\Models\ProductizedSolution;
use Illuminate\Database\Seeder;

class ProductizedSolutionSeeder extends Seeder
{
    public function run(): void
    {
        if (ProductizedSolution::count() > 0) {
            return;
        }

        $items = [
            [
                'icon_text' => '>_',
                'slug' => 'service-cloud-architecture',
                'opens_modal' => false,
                'title' => 'AWS & Cloud Architecture',
                'description' => 'Production-ready IaC with Terraform, Kubernetes (EKS/AKS) clusters, secure networking, and cloud cost optimization.',
                'link_label' => 'Request Audit',
                'link_url' => '#contact',
            ],
            [
                'icon_text' => '#',
                'slug' => 'service-devsecops',
                'opens_modal' => false,
                'title' => 'DevSecOps & CI/CD Pipelines',
                'description' => 'Automated GitOps workflows with GitHub Actions & ArgoCD, credential rotation with HashiCorp Vault, and Trivy security scans.',
                'link_label' => 'Explore Workflows',
                'link_url' => '#contact',
            ],
            [
                'icon_text' => '::',
                'slug' => 'service-backend-edge',
                'opens_modal' => true,
                'title' => 'Productized Backend & Edge Infrastructure',
                'description' => 'Managed backends (Laravel 11 / PHP 8.2+ / MySQL 8.0), ESC/POS print engines, and cloud backups for retail & hospitality.',
                'link_label' => 'Request Architecture',
                'link_url' => '#contact',
            ],
        ];

        foreach ($items as $i => $item) {
            ProductizedSolution::create($item + ['sort_order' => $i + 1]);
        }
    }
}