<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\SiteProfile;
use App\Models\TechUpdate;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function index()
    {
        $siteProfile = SiteProfile::getActive();

        // Load dynamic projects from database if available, otherwise graceful benchmark fallback
        $dbProjects = Project::where('is_featured', true)->orderBy('sort_order', 'asc')->get();

        if ($dbProjects->isNotEmpty()) {
            $caseStudies = $dbProjects->map(function ($project) {
                // Parse comma-separated tech stack or use it as metrics/tags
                $tags = array_filter(array_map('trim', explode(',', $project->tech_stack ?? '')));
                if (empty($tags)) {
                    $tags = ['Cloud Architecture', 'DevOps', 'IaC'];
                }

                $link = $project->article_url ?: $project->live_url;
                $linkText = 'Request Architecture Demo';

                if ($project->article_url) {
                    $linkText = str_contains($project->article_url, 'github') ? 'GitHub Repo' : 'Read Case Study';
                } elseif ($project->live_url) {
                    $linkText = 'Live Project';
                }

                return [
                    'title' => $project->title,
                    'category' => $project->category ?: 'Cloud Architecture & IaC',
                    'type' => str_contains(strtolower($project->category ?? ''), 'client') ? 'Client Production System' : 'Infrastructure Lab Benchmark',
                    'description' => $project->description,
                    'metrics' => array_slice($tags, 0, 3),
                    'link' => $link ?: '#audit-modal',
                    'link_text' => $linkText,
                ];
            })->toArray();
        } else {
            $caseStudies = [
                [
                    'title' => 'High-Availability AWS & Container Orchestration',
                    'category' => 'Cloud Architecture & IaC',
                    'type' => 'Infrastructure Lab Benchmark',
                    'description' => 'Migrated legacy monolith to AWS EKS with Terraform IaC, automated zero-downtime CI/CD pipelines, and secret management via HashiCorp Vault.',
                    'metrics' => [
                        '38% AWS Cost Reduction',
                        'Zero Downtime Deployment',
                        '99.99% Service Uptime',
                    ],
                    'link' => 'https://github.com/gobik1990/mcp-docker',
                    'link_text' => 'GitHub Repo',
                ],
                [
                    'title' => 'Automated DevOps CI/CD & Security Scanning',
                    'category' => 'DevSecOps & Automation',
                    'type' => 'Infrastructure Lab Benchmark',
                    'description' => 'Built GitOps pipelines using GitHub Actions, ArgoCD, and Trivy security scanners to enforce strict compliance and automated image deployments.',
                    'metrics' => [
                        '70% Faster Release Cycles',
                        'Automated Vulnerability Checks',
                        '100% Infrastructure as Code',
                    ],
                    'link' => 'https://medium.com/@gobik1990',
                    'link_text' => 'Read Case Study',
                ],
                [
                    'title' => 'Productized Backend & Edge POS Infrastructure',
                    'category' => 'Productized B2B Deployments',
                    'type' => 'Client Production System (Rose Villa)',
                    'description' => 'Engineered high-performance Laravel 11 (PHP 8.2+) & Filament v3 backend integrated with ESC/POS print engines, automated cloud backups, and remote support.',
                    'metrics' => [
                        '<200ms API Latency',
                        'Automated Offsite Backups',
                        '50k req/min Capacity',
                    ],
                    'link' => '#audit-modal',
                    'link_text' => 'Request Architecture Demo',
                ],
            ];
        }

        // Fetch dynamic tech journal articles
        $techUpdates = TechUpdate::where('is_published', true)
            ->orderBy('is_pinned', 'desc')
            ->orderBy('published_at', 'desc')
            ->take(4)
            ->get();

        return view('portfolio', compact('siteProfile', 'caseStudies', 'techUpdates'));
    }
}