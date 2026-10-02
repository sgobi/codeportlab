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
                    $tags = ['38% AWS Cost Reduction', 'Zero-Downtime Deployment', '99.99% Uptime'];
                }

                $link = $project->article_url ?: $project->live_url;
                $linkText = 'View Benchmark Details';

                $isRoseVilla = str_contains(strtolower($project->title ?? ''), 'rose villa')
                    || str_contains(strtolower($project->description ?? ''), 'rose villa')
                    || str_contains(strtolower($project->category ?? ''), 'client');

                if ($isRoseVilla) {
                    $link = '#journal-rose-villa';
                    $linkText = 'View Benchmark Details';
                } elseif ($project->article_url) {
                    $linkText = str_contains($project->article_url, 'github') ? 'GitHub Repo' : 'View Benchmark Details';
                } elseif ($project->live_url) {
                    $linkText = 'Live Project';
                }

                return [
                    'title' => $project->title,
                    'category' => $project->category ?: 'Cloud Architecture & IaC',
                    'type' => $isRoseVilla ? 'Client Production System' : 'Infrastructure Lab Benchmark',
                    'description' => $project->description,
                    'metrics' => array_slice($tags, 0, 3),
                    'link' => $link ?: '#audit-modal',
                    'link_text' => $linkText,
                ];
            })->toArray();
        } else {
            $caseStudies = [
                [
                    'title' => 'Enterprise EKS & AWS Cost Optimization',
                    'category' => 'Cloud Architecture & IaC',
                    'type' => 'Infrastructure Lab Benchmark',
                    'description' => 'Migrated legacy monolith to AWS EKS with Terraform IaC, automated zero-downtime CI/CD pipelines, and secret management via HashiCorp Vault.',
                    'metrics' => [
                        '38% AWS Cost Reduction',
                        'Zero-Downtime Deployment',
                        '99.99% Uptime',
                    ],
                    'link' => 'https://github.com/gobik1990/mcp-docker',
                    'link_text' => 'View Benchmark Details',
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
                    'link_text' => 'View Benchmark Details',
                ],
                [
                    'title' => 'Productized Backend & Edge POS Infrastructure (Rose Villa)',
                    'category' => 'Productized B2B Deployments',
                    'type' => 'Client Production System',
                    'description' => 'Engineered high-performance Laravel 11 / PHP 8.2+ / MySQL 8.0 & Filament v3 backend integrated with ESC/POS print engines, automated cloud backups, and remote support.',
                    'metrics' => [
                        '<200ms API Latency',
                        'Automated Offsite Backups',
                        '50k req/min Capacity',
                    ],
                    'link' => '#journal-rose-villa',
                    'link_text' => 'View Benchmark Details',
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

    /**
     * Handle inbound infrastructure audit booking requests.
     */
    public function submitAudit(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|max:255',
            'stack' => 'required|string|max:255',
            'scope' => 'nullable|string|max:2000',
        ]);

        try {
            $siteProfile = SiteProfile::getActive();
            $recipient = $siteProfile->email ?: 'gobi@codeportlab.com';

            \Illuminate\Support\Facades\Mail::raw(
                "New Infrastructure Audit Request:\n\nEmail: {$validated['email']}\nCloud/Stack: {$validated['stack']}\nScope: " . ($validated['scope'] ?? 'None provided'),
                function ($message) use ($recipient, $validated) {
                    $message->to($recipient)
                        ->replyTo($validated['email'])
                        ->subject('New Infrastructure Audit Request - CodePortLab');
                }
            );
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::info('Audit request received: ' . json_encode($validated));
        }

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Thank you! Your audit request has been received. We will respond within 24 hours.',
            ]);
        }

        return redirect()->to(url('/#contact'))->with('audit_success', 'Thank you! Your audit request has been received. We will respond within 24 hours.');
    }
}