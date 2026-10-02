<?php

namespace Database\Seeders;

use App\Models\Skill;
use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $skills = [
            // Cloud & Infrastructure
            ['name' => 'AWS Cloud Architecture', 'group' => 'Cloud & Infrastructure', 'proficiency' => 'Expert', 'sort_order' => 1],
            ['name' => 'Terraform IaC', 'group' => 'Cloud & Infrastructure', 'proficiency' => 'Expert', 'sort_order' => 2],
            ['name' => 'CloudLinux 7 / cPanel Server Ops', 'group' => 'Cloud & Infrastructure', 'proficiency' => 'Expert', 'sort_order' => 3],
            ['name' => 'Google Cloud Platform (GCP)', 'group' => 'Cloud & Infrastructure', 'proficiency' => 'Advanced', 'sort_order' => 4],

            // Containers & CI/CD
            ['name' => 'Kubernetes (EKS / Bare-Metal)', 'group' => 'Containers & CI/CD', 'proficiency' => 'Expert', 'sort_order' => 1],
            ['name' => 'Docker & Containerization', 'group' => 'Containers & CI/CD', 'proficiency' => 'Expert', 'sort_order' => 2],
            ['name' => 'GitHub Actions & GitLab CI', 'group' => 'Containers & CI/CD', 'proficiency' => 'Expert', 'sort_order' => 3],
            ['name' => 'ArgoCD & GitOps', 'group' => 'Containers & CI/CD', 'proficiency' => 'Advanced', 'sort_order' => 4],

            // Backend & Web
            ['name' => 'Laravel 11 / PHP 8.2+ / MySQL 8.0', 'group' => 'Backend & Web', 'proficiency' => 'Expert', 'sort_order' => 1],
            ['name' => 'Filament PHP v3 CMS', 'group' => 'Backend & Web', 'proficiency' => 'Expert', 'sort_order' => 2],
            ['name' => 'RESTful & GraphQL API Design', 'group' => 'Backend & Web', 'proficiency' => 'Expert', 'sort_order' => 3],
            ['name' => 'Go (Golang) Microservices', 'group' => 'Backend & Web', 'proficiency' => 'Advanced', 'sort_order' => 4],

            // Databases & Ops
            ['name' => 'MySQL 8.0 & Database Architecture', 'group' => 'Databases & Ops', 'proficiency' => 'Expert', 'sort_order' => 1],
            ['name' => 'Redis Caching & Queue Management', 'group' => 'Databases & Ops', 'proficiency' => 'Expert', 'sort_order' => 2],
            ['name' => 'Prometheus & Grafana Monitoring', 'group' => 'Databases & Ops', 'proficiency' => 'Advanced', 'sort_order' => 3],
            ['name' => 'Apache & NGINX Web Servers', 'group' => 'Databases & Ops', 'proficiency' => 'Expert', 'sort_order' => 4],
        ];

        foreach ($skills as $skill) {
            Skill::updateOrCreate(
                ['name' => $skill['name'], 'group' => $skill['group']],
                $skill
            );
        }
    }
}
