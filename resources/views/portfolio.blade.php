<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $siteProfile->brand_name . $siteProfile->brand_accent }} | {{ $siteProfile->tagline }}</title>
    <link rel="canonical" href="https://codeportlab.com/">
    <meta name="description" content="Production infrastructure, automated CI/CD pipelines, and cloud engineering projects by {{ $siteProfile->founder_name }}.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://codeportlab.com/">
    <meta property="og:title" content="{{ $siteProfile->brand_name . $siteProfile->brand_accent }} | {{ $siteProfile->tagline }}">
    <meta property="og:description" content="Production infrastructure, automated CI/CD pipelines, and cloud engineering projects by {{ $siteProfile->founder_name }}.">
    @if($siteProfile->logo_url)
    <meta property="og:image" content="{{ $siteProfile->logo_url }}">
    @endif
    <link rel="icon" type="image/png" href="{{ $siteProfile->logo_url }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Fira+Code:wght@400;500;600&family=Inter:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .font-mono {
            font-family: 'Fira Code', monospace;
        }
    </style>
</head>

<body class="bg-slate-950 text-slate-100 antialiased selection:bg-cyan-500 selection:text-slate-950">

    <!-- Clean Navigation (Trimmed to 5 Links, No Host Specs) -->
    <nav class="sticky top-0 z-50 backdrop-blur-md bg-slate-950/80 border-b border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <a href="#" class="flex items-center gap-3">
                <img src="{{ $siteProfile->logo_url }}" alt="{{ $siteProfile->brand_name }} Logo"
                    class="h-10 w-auto object-contain">
                <div class="flex flex-col leading-none">
                    <span class="font-mono text-lg font-bold text-white">{{ $siteProfile->brand_name }}<span
                            class="text-cyan-400">{{ $siteProfile->brand_accent }}</span></span>
                    <span
                        class="text-[10px] text-slate-400 tracking-widest font-mono mt-0.5">{{ $siteProfile->tagline }}</span>
                </div>
            </a>
            <div class="hidden md:flex items-center gap-8 text-sm font-medium text-slate-300">
                <a href="#services" class="hover:text-cyan-400 transition-colors">Services</a>
                <a href="#case-studies" class="hover:text-cyan-400 transition-colors">Case Studies</a>
                <a href="#journal" class="hover:text-cyan-400 transition-colors">Tech Journal</a>
                <a href="#terminal" class="hover:text-cyan-400 transition-colors">Terminal</a>
                <a href="#contact" class="hover:text-cyan-400 transition-colors">Contact</a>
            </div>
            <button onclick="toggleAuditModal()"
                class="px-4 py-2 text-xs font-semibold uppercase tracking-wider text-slate-950 bg-cyan-400 hover:bg-cyan-300 rounded transition-all">
                Book Audit
            </button>
        </div>
    </nav>

    <!-- B2B Focused Hero Section (No HR Disclaimers) -->
    <section class="py-24 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto text-center">
        <div
            class="inline-flex items-center gap-2 px-3 py-1 rounded-full border border-cyan-500/30 bg-cyan-500/10 text-cyan-300 text-xs font-mono mb-6">
            <span class="w-2 h-2 rounded-full bg-cyan-400 animate-ping"></span>
            Cloud Native & Infrastructure Engineering
        </div>
        <h1 class="text-4xl sm:text-6xl font-extrabold tracking-tight text-white max-w-4xl mx-auto leading-tight mb-6">
            Cloud Infrastructure & DevOps Engineering for High-Growth Teams.
        </h1>
        <p class="text-lg sm:text-xl text-slate-400 max-w-2xl mx-auto mb-10 leading-relaxed">
            I build, secure, and scale production environments using Terraform IaC, Automated CI/CD Pipelines,
            AWS/Azure Cloud Architectures, and Laravel 11 / PHP 8.2+ / MySQL 8.0 Edge Infrastructure.
        </p>
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
            <button onclick="toggleAuditModal()"
                class="w-full sm:w-auto px-8 py-4 bg-cyan-400 hover:bg-cyan-300 text-slate-950 font-bold rounded-lg shadow-lg shadow-cyan-500/20 transition-all text-center">
                Book Infrastructure Audit
            </button>
            <a href="#case-studies"
                class="w-full sm:w-auto px-8 py-4 bg-slate-900 hover:bg-slate-800 border border-slate-700 text-slate-200 font-semibold rounded-lg transition-all text-center">
                View Case Studies
            </a>
        </div>
    </section>

    <!-- Pre-populated Accessible Terminal CLI Container -->
    <section id="terminal" class="py-12 max-w-5xl mx-auto px-4">
        <div class="bg-slate-900 border border-slate-800 rounded-xl overflow-hidden shadow-2xl">
            <div class="bg-slate-950 px-4 py-3 border-b border-slate-800 flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <div class="w-3 h-3 rounded-full bg-red-500/80"></div>
                    <div class="w-3 h-3 rounded-full bg-yellow-500/80"></div>
                    <div class="w-3 h-3 rounded-full bg-green-500/80"></div>
                    <span class="text-xs font-mono text-slate-400 ml-2">codeportlab-shell v2.4</span>
                </div>
            </div>
            <!-- High WCAG Contrast Container -->
            <div id="terminal-window"
                class="p-6 font-mono text-sm leading-relaxed text-emerald-400 bg-slate-950 min-h-[280px] overflow-y-auto">
                <p class="text-slate-400">CodePortLab Shell v2.4 (x86_64-pc-linux-gnu)</p>
                <p class="text-slate-400 mb-4">Type <span class="text-amber-300 font-bold">'help'</span> or <span
                        class="text-amber-300 font-bold">'services'</span> for available commands.</p>
                <div id="terminal-output" class="space-y-2"></div>
                <div class="flex items-center gap-2 mt-4 text-emerald-300">
                    <span>guest@codeportlab:~$</span>
                    <input type="text" id="terminal-input"
                        class="bg-transparent border-none outline-none text-emerald-300 w-full focus:ring-0" focus
                        autofocus>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="py-20 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto border-t border-slate-900">
        <div class="text-center mb-16">
            <h2 class="text-3xl font-bold text-white tracking-tight mb-4">Productized DevOps & Cloud Solutions</h2>
            <p class="text-slate-400 max-w-2xl mx-auto">Scalable infrastructure, automated delivery pipelines, and fully
                managed cloud deployments tailored for businesses.</p>
        </div>
        <div class="grid md:grid-cols-3 gap-8">
            <div class="bg-slate-900/60 border border-slate-800 p-8 rounded-xl hover:border-cyan-500/50 transition-all">
                <div
                    class="w-12 h-12 bg-cyan-500/10 text-cyan-400 rounded-lg flex items-center justify-center font-mono font-bold mb-6">
                    &gt;_</div>
                <h3 class="text-xl font-bold text-white mb-3">AWS & Cloud Architecture</h3>
                <p class="text-slate-400 text-sm leading-relaxed mb-6">Production-ready IaC with Terraform, Kubernetes
                    (EKS/AKS) clusters, secure networking, and cloud cost optimization.</p>
                <a href="#contact"
                    class="text-cyan-400 text-sm font-semibold hover:text-cyan-300 flex items-center gap-1">Request
                    Audit &rarr;</a>
            </div>
            <div class="bg-slate-900/60 border border-slate-800 p-8 rounded-xl hover:border-cyan-500/50 transition-all">
                <div
                    class="w-12 h-12 bg-cyan-500/10 text-cyan-400 rounded-lg flex items-center justify-center font-mono font-bold mb-6">
                    #</div>
                <h3 class="text-xl font-bold text-white mb-3">DevSecOps & CI/CD Pipelines</h3>
                <p class="text-slate-400 text-sm leading-relaxed mb-6">Automated GitOps workflows with GitHub Actions &
                    ArgoCD, credential rotation with HashiCorp Vault, and Trivy security scans.</p>
                <a href="#contact"
                    class="text-cyan-400 text-sm font-semibold hover:text-cyan-300 flex items-center gap-1">Explore
                    Workflows &rarr;</a>
            </div>
            <div class="bg-slate-900/60 border border-slate-800 p-8 rounded-xl hover:border-cyan-500/50 transition-all">
                <div
                    class="w-12 h-12 bg-cyan-500/10 text-cyan-400 rounded-lg flex items-center justify-center font-mono font-bold mb-6">
                    ::</div>
                <h3 class="text-xl font-bold text-white mb-3">Productized Backend & Edge Infrastructure</h3>
                <p class="text-slate-400 text-sm leading-relaxed mb-6">Managed backends (Laravel 11 / PHP 8.2+ / MySQL 8.0), ESC/POS print engines, and
                    cloud backups for retail & hospitality.</p>
                <button onclick="toggleAuditModal()"
                    class="text-cyan-400 text-sm font-semibold hover:text-cyan-300 flex items-center gap-1">Request
                    Architecture &rarr;</button>
            </div>
        </div>
    </section>

    <!-- Case Studies Section (Hard Metrics Badges & No Admin/CMS Tags) -->
    <section id="case-studies" class="py-20 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto border-t border-slate-900">
        <div class="text-center mb-16">
            <h2 class="text-3xl font-bold text-white tracking-tight mb-4">Engineering Case Studies</h2>
            <p class="text-slate-400 max-w-2xl mx-auto">Production work and engineering lab projects.</p>
        </div>
        <div class="grid lg:grid-cols-3 gap-8">
            @foreach($caseStudies as $study)
                @php
                    $cleanDescription = str_ireplace('zero-downtime migration', 'migration', $study['description']);
                    $badgeType = $study['type'] ?? 'Benchmark';
                    $hasZeroDowntimeType = stripos($badgeType, 'zero-downtime') !== false;
                @endphp
                <div
                    class="bg-slate-900/80 border border-slate-800 rounded-xl p-6 flex flex-col justify-between hover:border-slate-700 transition-all">
                    <div>
                        <!-- Type Badge & Category Header -->
                        <div class="flex flex-wrap items-center justify-between gap-2 mb-3">
                            <span
                                class="text-xs font-mono text-cyan-400 uppercase tracking-wider">{{ $study['category'] }}</span>
                            @if(!$hasZeroDowntimeType)
                                <span
                                    class="inline-flex items-center px-2 py-0.5 rounded text-[11px] font-mono font-medium {{ str_contains($badgeType, 'Client') ? 'bg-emerald-500/10 text-emerald-400 border border-emerald-500/30' : 'bg-purple-500/10 text-purple-300 border border-purple-500/30' }}">
                                    {{ $badgeType }}
                                </span>
                            @endif
                        </div>
                        <h3 class="text-xl font-bold text-white mb-4 leading-snug">{{ $study['title'] }}</h3>
                        <p class="text-slate-400 text-sm leading-relaxed mb-6">{{ $cleanDescription }}</p>

                        <!-- Metrics Badges -->
                        <div class="flex flex-wrap gap-2 mb-6">
                            @foreach($study['metrics'] as $metric)
                                @if(stripos($metric, 'zero-downtime') !== false)
                                    {{-- removed zero-downtime badge --}}
                                @elseif(preg_match('/(99\.99%|50k\/min|<200ms|&lt;200ms|38%|95%\+)/i', $metric))
                                    {{-- TODO: add measured figure --}}
                                @else
                                    <span
                                        class="px-3 py-1 rounded bg-slate-800 border border-slate-700 text-cyan-300 font-mono text-xs font-medium">
                                        {{ $metric }}
                                    </span>
                                @endif
                            @endforeach
                        </div>
                    </div>

                    @if(isset($study['action_type']) && $study['action_type'] === 'rose_villa')
                        <button type="button" onclick="openRoseVillaModal()"
                            class="inline-flex items-center gap-2 text-sm font-semibold text-slate-950 bg-cyan-400 hover:bg-cyan-300 px-4 py-2 rounded transition-all w-fit font-bold cursor-pointer">
                            <span>{{ $study['link_text'] ?? 'View Benchmark Details' }}</span>
                            <span class="text-xs">&rarr;</span>
                        </button>
                    @elseif(isset($study['action_type']) && $study['action_type'] === 'preview')
                        <button type="button" onclick="openPreviewModal(@js($study['title']), @js($study['category']), @js($cleanDescription))"
                            class="inline-flex items-center gap-2 text-sm font-semibold text-white bg-slate-800 hover:bg-slate-700 hover:text-cyan-300 px-4 py-2 rounded transition-all w-fit cursor-pointer">
                            <span>{{ $study['link_text'] ?? 'View Benchmark Details' }}</span>
                            <span class="text-xs">&rarr;</span>
                        </button>
                    @elseif(isset($study['link']) && $study['link'] === '#audit-modal')
                        <button type="button" onclick="toggleAuditModal()"
                            class="inline-flex items-center gap-2 text-sm font-semibold text-slate-950 bg-cyan-400 hover:bg-cyan-300 px-4 py-2 rounded transition-all w-fit font-bold cursor-pointer">
                            <span>{{ $study['link_text'] }}</span>
                            <span class="text-xs">&rarr;</span>
                        </button>
                    @elseif(isset($study['link']) && str_starts_with($study['link'], 'http') && !str_contains($study['link'], '#journal'))
                        <a href="{{ $study['link'] }}" target="_blank" rel="noopener noreferrer"
                            class="inline-flex items-center gap-2 text-sm font-semibold text-white bg-slate-800 hover:bg-slate-700 px-4 py-2 rounded transition-all w-fit">
                            <span>{{ $study['link_text'] }}</span>
                            <span class="text-xs">&rarr;</span>
                        </a>
                    @else
                        <button type="button" onclick="openPreviewModal(@js($study['title']), @js($study['category']), @js($cleanDescription))"
                            class="inline-flex items-center gap-2 text-sm font-semibold text-white bg-slate-800 hover:bg-slate-700 hover:text-cyan-300 px-4 py-2 rounded transition-all w-fit cursor-pointer">
                            <span>{{ $study['link_text'] ?? 'View Benchmark Details' }}</span>
                            <span class="text-xs">&rarr;</span>
                        </button>
                    @endif
                </div>
            @endforeach
        </div>

        <!-- Guarantees & Standards Trust Proof Box -->
        <div
            class="mt-12 bg-slate-900/60 border border-slate-800 rounded-xl p-6 sm:p-8 flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
            <div class="flex items-start gap-4">
                <div
                    class="w-10 h-10 rounded-lg bg-cyan-500/10 border border-cyan-500/30 flex items-center justify-center shrink-0 text-cyan-400 font-mono text-sm font-bold">
                    &gt;_
                </div>
                <div>
                    <div class="flex flex-wrap items-center gap-2 mb-1">
                        <span
                            class="text-xs font-mono uppercase tracking-widest text-cyan-400 font-semibold">My Core Engineering Commitment</span>
                        <span class="text-xs font-mono text-slate-600">/</span>
                        <span
                            class="text-xs font-mono uppercase tracking-wider text-slate-400 font-semibold">Built by Design</span>
                    </div>
                    <p class="text-slate-200 text-sm sm:text-base font-medium leading-relaxed">
                        Engineered for reliable deployments, strict IaC auditability, and cloud cost efficiency across every production deployment.
                    </p>
                </div>
            </div>
            <button onclick="toggleAuditModal()"
                class="px-5 py-2.5 text-xs font-semibold uppercase tracking-wider text-slate-950 bg-cyan-400 hover:bg-cyan-300 rounded transition-all whitespace-nowrap shrink-0">
                Book Audit
            </button>
        </div>
    </section>
    <!-- Tech Journal Section (Fixes #journal link) -->
    <section id="journal" class="py-20 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto border-t border-slate-900">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-white tracking-tight mb-4">Tech Journal</h2>
            <p class="text-slate-400 max-w-2xl mx-auto">Latest insights on Cloud Native Architecture,
                Containerization, and DevOps Engineering.</p>
        </div>
        <div class="grid md:grid-cols-3 gap-6">
            @forelse($techUpdates as $update)
                @php
                    $isRoseVillaJournal = str_contains(strtolower($update->title), 'vps') 
                        || str_contains(strtolower($update->title), 'rose villa') 
                        || str_contains(strtolower($update->title), 'laravel');
                    $hasExternalUrl = !empty($update->external_url) 
                        && !str_starts_with($update->external_url, '#') 
                        && !str_contains($update->external_url, '#journal');
                @endphp

                @if($isRoseVillaJournal || $loop->iteration === 3)
                    <a href="https://medium.com/@gobik1990/zero-touch-deployments-on-shared-cpanel-hosting-with-github-actions-010d1e875444" target="_blank" rel="noopener noreferrer"
                        class="bg-slate-900/60 border border-slate-800 p-6 rounded-xl hover:border-cyan-500/50 transition-all flex flex-col justify-between group">
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-xs font-mono text-cyan-400 uppercase tracking-wider">DevOps &amp; CI/CD</span>
                                <span class="text-[11px] font-mono text-emerald-400 bg-emerald-500/10 border border-emerald-500/30 px-2 py-0.5 rounded">Published</span>
                            </div>
                            <h3 class="text-lg font-bold text-white mt-2 group-hover:text-cyan-300 transition-colors">
                                Zero-Touch Deployments on Shared cPanel Hosting with GitHub Actions
                            </h3>
                            <p class="text-slate-400 text-sm mt-2 leading-relaxed">CI/CD for shared cPanel with no SSH: GitHub Actions, FTPS sync, a key-protected PHP deploy hook, and a health check.</p>
                        </div>
                        <div class="mt-4 flex items-center text-xs font-mono font-semibold text-cyan-400 group-hover:text-cyan-300 gap-1.5">
                            <span>Read Article</span>
                            <span>&rarr;</span>
                        </div>
                    </a>
                @elseif($hasExternalUrl)
                    <a href="{{ $update->external_url }}" target="_blank" rel="noopener noreferrer"
                        class="bg-slate-900/60 border border-slate-800 p-6 rounded-xl hover:border-cyan-500/50 transition-all flex flex-col justify-between group">
                        <div>
                            <span class="text-xs font-mono text-cyan-400 uppercase tracking-wider">{{ $update->category ?: 'PUBLISHED ARTICLE' }}</span>
                            <h3 class="text-lg font-bold text-white mt-2 group-hover:text-cyan-300 transition-colors">
                                {{ $update->title }}
                            </h3>
                            <p class="text-slate-400 text-sm mt-2 leading-relaxed">{{ $update->summary }}</p>
                        </div>
                        <div class="mt-4 flex items-center text-xs font-mono font-semibold text-cyan-400 group-hover:text-cyan-300 gap-1.5">
                            <span>Read Article</span>
                            <span>&rarr;</span>
                        </div>
                    </a>
                @else
                    @php
                        $displayTitle = $update->title;
                        if ($loop->iteration === 1 || (str_contains(strtolower($update->title), 'aws') && str_contains(strtolower($update->title), 'terraform'))) {
                            $displayTitle = 'Reducing AWS Infrastructure Costs with Terraform';
                        } elseif ($loop->iteration === 2 || str_contains(strtolower($update->title), 'ci/cd')) {
                            $displayTitle = 'CI/CD Pipelines for Web Applications';
                        }
                    @endphp
                    <div onclick="openPreviewModal(@js($displayTitle), @js($update->category ?: 'Technical Whitepaper'), @js($update->summary))"
                        class="bg-slate-900/60 border border-slate-800 p-6 rounded-xl hover:border-cyan-500/50 transition-all flex flex-col justify-between group cursor-pointer">
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-xs font-mono text-cyan-400 uppercase tracking-wider">{{ $update->category ?: 'TECHNICAL WHITEPAPER' }}</span>
                                <span class="text-[11px] font-mono text-amber-400 bg-amber-500/10 border border-amber-500/30 px-2 py-0.5 rounded">Planned</span>
                            </div>
                            <h3 class="text-lg font-bold text-white group-hover:text-cyan-300 transition-colors">
                                {{ $displayTitle }}
                            </h3>
                            <p class="text-slate-400 text-sm mt-2 leading-relaxed">{{ $update->summary }}</p>
                        </div>
                        <div class="mt-4 flex items-center text-xs font-mono font-semibold text-slate-400 group-hover:text-cyan-300 gap-1.5">
                            <span>In-Depth Writeup Coming Soon</span>
                            <span>&rarr;</span>
                        </div>
                    </div>
                @endif
            @empty
                <div onclick="openPreviewModal('Reducing AWS Infrastructure Costs with Terraform', 'CLOUD COST OPTIMIZATION', 'A strategic breakdown of rightsizing AWS resources and automating lifecycle policies via Terraform IaC.')"
                    class="bg-slate-900/60 border border-slate-800 p-6 rounded-xl hover:border-cyan-500/50 transition-all flex flex-col justify-between group cursor-pointer">
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-xs font-mono text-cyan-400 uppercase tracking-wider">CLOUD COST OPTIMIZATION</span>
                            <span class="text-[11px] font-mono text-amber-400 bg-amber-500/10 border border-amber-500/30 px-2 py-0.5 rounded">Planned</span>
                        </div>
                        <h3 class="text-lg font-bold text-white mt-2 group-hover:text-cyan-300 transition-colors">Reducing AWS Infrastructure Costs with Terraform</h3>
                        <p class="text-slate-400 text-sm mt-2 leading-relaxed">A strategic breakdown of rightsizing AWS resources and automating lifecycle policies via Terraform IaC.</p>
                    </div>
                    <div class="mt-4 flex items-center text-xs font-mono font-semibold text-slate-400 group-hover:text-cyan-300 gap-1.5">
                        <span>In-Depth Writeup Coming Soon</span>
                        <span>&rarr;</span>
                    </div>
                </div>
                <div onclick="openPreviewModal('CI/CD Pipelines for Web Applications', 'DEVOPS & AUTOMATION', 'Architecting automated blue-green and canary delivery pipelines using GitHub Actions and container orchestration.')"
                    class="bg-slate-900/60 border border-slate-800 p-6 rounded-xl hover:border-cyan-500/50 transition-all flex flex-col justify-between group cursor-pointer">
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-xs font-mono text-cyan-400 uppercase tracking-wider">DEVOPS & AUTOMATION</span>
                            <span class="text-[11px] font-mono text-amber-400 bg-amber-500/10 border border-amber-500/30 px-2 py-0.5 rounded">Planned</span>
                        </div>
                        <h3 class="text-lg font-bold text-white mt-2 group-hover:text-cyan-300 transition-colors">CI/CD Pipelines for Web Applications</h3>
                        <p class="text-slate-400 text-sm mt-2 leading-relaxed">Architecting automated blue-green and canary delivery pipelines using GitHub Actions and container orchestration.</p>
                    </div>
                    <div class="mt-4 flex items-center text-xs font-mono font-semibold text-slate-400 group-hover:text-cyan-300 gap-1.5">
                        <span>In-Depth Writeup Coming Soon</span>
                        <span>&rarr;</span>
                    </div>
                </div>
                <a href="https://medium.com/@gobik1990/zero-touch-deployments-on-shared-cpanel-hosting-with-github-actions-010d1e875444" target="_blank" rel="noopener noreferrer"
                    class="bg-slate-900/60 border border-slate-800 p-6 rounded-xl hover:border-cyan-500/50 transition-all flex flex-col justify-between group">
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-xs font-mono text-cyan-400 uppercase tracking-wider">DevOps &amp; CI/CD</span>
                            <span class="text-[11px] font-mono text-emerald-400 bg-emerald-500/10 border border-emerald-500/30 px-2 py-0.5 rounded">Published</span>
                        </div>
                        <h3 class="text-lg font-bold text-white mt-2 group-hover:text-cyan-300 transition-colors">Zero-Touch Deployments on Shared cPanel Hosting with GitHub Actions</h3>
                        <p class="text-slate-400 text-sm mt-2 leading-relaxed">CI/CD for shared cPanel with no SSH: GitHub Actions, FTPS sync, a key-protected PHP deploy hook, and a health check.</p>
                    </div>
                    <div class="mt-4 flex items-center text-xs font-mono font-semibold text-cyan-400 group-hover:text-cyan-300 gap-1.5">
                        <span>Read Article</span>
                        <span>&rarr;</span>
                    </div>
                </a>
            @endforelse
        </div>
    </section>

    <!-- Contact & Consultation Section (Fixes #contact link) -->
    <section id="contact" class="py-20 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto border-t border-slate-900">
        <div class="bg-slate-900/80 border border-slate-800 rounded-2xl p-8 md:p-12 text-center max-w-4xl mx-auto">
            <span class="text-xs font-mono text-cyan-400 uppercase tracking-widest">GET IN TOUCH</span>
            <h2 class="text-3xl md:text-4xl font-bold text-white mt-2 mb-4">Ready to Optimize Your Infrastructure?
            </h2>
            <p class="text-slate-400 max-w-xl mx-auto mb-8">Schedule a 30-minute cloud assessment or send me your
                requirements.</p>

            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <button onclick="toggleAuditModal()"
                    class="w-full sm:w-auto px-8 py-4 bg-cyan-400 hover:bg-cyan-300 text-slate-950 font-bold rounded-lg transition-all">
                    Book Infrastructure Audit
                </button>
                <a href="mailto:{{ $siteProfile->email }}"
                    class="w-full sm:w-auto px-8 py-4 bg-slate-800 hover:bg-slate-700 text-slate-200 font-semibold rounded-lg transition-all border border-slate-700">
                    Send Email Direct
                </a>
            </div>
        </div>
    </section>

    <!-- Book Infrastructure Audit Modal -->
    <div id="audit-modal"
        class="fixed inset-0 z-50 hidden bg-slate-950/80 backdrop-blur-sm flex items-center justify-center p-4">
        <div class="bg-slate-900 border border-slate-800 rounded-2xl max-w-lg w-full p-6 md:p-8 relative shadow-2xl">
            <button onclick="toggleAuditModal()"
                class="absolute top-4 right-4 text-slate-400 hover:text-white text-xl">&times;</button>

            <h3 class="text-2xl font-bold text-white mb-2">Book Infrastructure Audit</h3>
            <p class="text-slate-400 text-sm mb-6">Fill in your email and primary cloud stack. I will respond
                within 24 hours.</p>

            @if(session('audit_success'))
                <div class="mb-6 p-4 rounded-xl bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 font-mono text-xs flex items-center gap-2">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    <span>{{ session('audit_success') }}</span>
                </div>
            @endif

            @if($errors->any())
                <div class="mb-6 p-4 rounded-xl bg-rose-500/10 border border-rose-500/30 text-rose-400 font-mono text-xs">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('audit.submit') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-mono text-slate-400 mb-1">YOUR EMAIL</label>
                    <input type="email" name="email" value="{{ old('email') }}" required placeholder="cto@company.com"
                        class="w-full bg-slate-950 border border-slate-800 rounded p-3 text-sm text-slate-100 focus:outline-none focus:border-cyan-400">
                </div>
                <div>
                    <label class="block text-xs font-mono text-slate-400 mb-1">CLOUD / STACK (AWS, AZURE, DOCKER,
                        LARAVEL 11 / PHP 8.2+ / MYSQL 8.0)</label>
                    <input type="text" name="stack" value="{{ old('stack') }}" required
                        placeholder="e.g. AWS EKS, Terraform, Laravel 11 / PHP 8.2+ / MySQL 8.0, POS Systems"
                        class="w-full bg-slate-950 border border-slate-800 rounded p-3 text-sm text-slate-100 focus:outline-none focus:border-cyan-400">
                </div>
                <div>
                    <label class="block text-xs font-mono text-slate-400 mb-1">PROJECT SCOPE & GOALS</label>
                    <textarea name="scope" rows="3" placeholder="Describe current pain points, cost targets, or migration needs..."
                        class="w-full bg-slate-950 border border-slate-800 rounded p-3 text-sm text-slate-100 focus:outline-none focus:border-cyan-400">{{ old('scope') }}</textarea>
                </div>
                <button type="submit"
                    class="w-full py-3 bg-cyan-400 hover:bg-cyan-300 text-slate-950 font-bold rounded transition-all">
                    Submit Audit Request
                </button>
            </form>
        </div>
    </div>

    <!-- Rose Villa Case Study Breakdown Modal -->
    <div id="rose-villa-modal"
        class="fixed inset-0 z-50 hidden bg-slate-950/85 backdrop-blur-md flex items-center justify-center p-4 overflow-y-auto">
        <div class="bg-slate-900 border border-slate-800 rounded-2xl max-w-2xl w-full p-6 sm:p-8 relative shadow-2xl my-8 max-h-[90vh] overflow-y-auto">
            <button type="button" onclick="closeRoseVillaModal()"
                class="absolute top-5 right-5 text-slate-400 hover:text-white text-2xl transition-colors">&times;</button>

            <!-- Header Badges -->
            <div class="flex flex-wrap items-center gap-2 mb-3">
                <span class="inline-flex items-center px-2.5 py-0.5 rounded text-xs font-mono font-semibold bg-emerald-500/10 text-emerald-400 border border-emerald-500/30">
                    Client Production System
                </span>
                <span class="inline-flex items-center px-2.5 py-0.5 rounded text-xs font-mono font-semibold bg-cyan-500/10 text-cyan-300 border border-cyan-500/30">
                    Laravel 11 &amp; Filament 3
                </span>
                <span class="inline-flex items-center px-2.5 py-0.5 rounded text-xs font-mono font-semibold bg-purple-500/10 text-purple-300 border border-purple-500/30">
                    cPanel Deployment
                </span>
            </div>

            <h3 class="text-2xl sm:text-3xl font-bold text-white mb-2 leading-tight">
                Productized Backend &amp; Edge POS Infrastructure
            </h3>
            <p class="text-slate-400 text-sm mb-6 leading-relaxed">
                Full-stack production benchmark deployed for Rose Villa: A resilient, high-throughput point-of-sale and kitchen telemetry backend running on resource-constrained hosting.
            </p>

            <!-- Key Hard Metrics Grid -->
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 mb-6 p-4 rounded-xl bg-slate-950/70 border border-slate-800">
                {{-- TODO: add measured figure --}}
                {{-- TODO: add measured figure --}}
                {{-- TODO: add measured figure --}}
                <div class="text-center sm:text-left">
                    <div class="text-xl sm:text-2xl font-bold font-mono text-purple-400">1-Click</div>
                    <div class="text-[11px] font-mono text-slate-400 uppercase mt-0.5">Atomic Deploy</div>
                </div>
            </div>

            <!-- Deep Dive Breakdown Sections -->
            <div class="space-y-4 text-sm text-slate-300 mb-8 leading-relaxed">
                <div class="p-4 rounded-xl bg-slate-950/50 border border-slate-800/80">
                    <h4 class="font-bold text-white text-base mb-1.5 flex items-center gap-2">
                        <span class="text-cyan-400 font-mono text-sm">&gt;</span> Laravel 11 &amp; PHP 8.2+ Architecture
                    </h4>
                    <p class="text-slate-400 text-xs sm:text-sm">
                        Built on Laravel 11 with strict typing and lightweight background job queues. Tuned Eloquent queries with eager-loading indexes to eliminate N+1 bottlenecks under peak dinner hour load surges.
                    </p>
                </div>

                <div class="p-4 rounded-xl bg-slate-950/50 border border-slate-800/80">
                    <h4 class="font-bold text-white text-base mb-1.5 flex items-center gap-2">
                        <span class="text-cyan-400 font-mono text-sm">&gt;</span> Filament v3 Real-Time Operations Panel
                    </h4>
                    <p class="text-slate-400 text-xs sm:text-sm">
                        Custom administration workspace providing live sales telemetry, multi-register management, role-based table access, and inventory depletion tracking with zero frontend overhead.
                    </p>
                </div>

                <div class="p-4 rounded-xl bg-slate-950/50 border border-slate-800/80">
                    <h4 class="font-bold text-white text-base mb-1.5 flex items-center gap-2">
                        <span class="text-cyan-400 font-mono text-sm">&gt;</span> Zero-touch cPanel deployments
                    </h4>
                    <p class="text-slate-400 text-xs sm:text-sm">
                        Zero-touch cPanel deployments: GitHub Actions build, FTPS sync, key-protected deploy hook, health check.
                    </p>
                    <div class="mt-2">
                        <a href="https://medium.com/@gobik1990/zero-touch-deployments-on-shared-cpanel-hosting-with-github-actions-010d1e875444"
                            target="_blank" rel="noopener noreferrer"
                            class="inline-flex items-center gap-1.5 text-xs font-mono font-semibold text-cyan-400 hover:text-cyan-300 transition-colors">
                            <span>Read the full guide</span>
                            <span>&rarr;</span>
                        </a>
                    </div>
                </div>

                <div class="p-4 rounded-xl bg-slate-950/50 border border-slate-800/80">
                    <h4 class="font-bold text-white text-base mb-1.5 flex items-center gap-2">
                        <span class="text-cyan-400 font-mono text-sm">&gt;</span> Edge ESC/POS Hardware &amp; Cloud Disaster Recovery
                    </h4>
                    <p class="text-slate-400 text-xs sm:text-sm">
                        Direct raw ESC/POS network socket integration for kitchen thermal printers, paired with automated encrypted offsite MySQL snapshots taken hourly and synced to AWS S3.
                    </p>
                </div>
            </div>

            <!-- Modal Action Buttons -->
            <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-4 border-t border-slate-800">
                <button type="button" onclick="closeRoseVillaModal(); toggleAuditModal();"
                    class="w-full sm:w-auto px-6 py-3 bg-cyan-400 hover:bg-cyan-300 text-slate-950 font-bold rounded-lg transition-all text-center text-sm">
                    Request Similar Architecture
                </button>
                <button type="button" onclick="closeRoseVillaModal()"
                    class="w-full sm:w-auto px-6 py-3 bg-slate-800 hover:bg-slate-700 text-slate-300 font-semibold rounded-lg transition-all text-center text-sm">
                    Close Breakdown
                </button>
            </div>
        </div>
    </div>

    <!-- In-Depth Writeup Coming Soon / Preview Modal -->
    <div id="preview-modal"
        class="fixed inset-0 z-50 hidden bg-slate-950/85 backdrop-blur-md flex items-center justify-center p-4 overflow-y-auto">
        <div class="bg-slate-900 border border-slate-800 rounded-2xl max-w-xl w-full p-6 sm:p-8 relative shadow-2xl my-8">
            <button type="button" onclick="closePreviewModal()"
                class="absolute top-5 right-5 text-slate-400 hover:text-white text-2xl transition-colors">&times;</button>

            <!-- Badge -->
            <div class="flex items-center gap-2 mb-3">
                <span id="preview-modal-category"
                    class="text-xs font-mono text-cyan-400 uppercase tracking-wider font-semibold">TECHNICAL WHITEPAPER</span>
                <span class="text-xs font-mono text-amber-400 bg-amber-500/10 border border-amber-500/30 px-2 py-0.5 rounded font-medium">In Peer Review</span>
            </div>

            <h3 id="preview-modal-title" class="text-xl sm:text-2xl font-bold text-white mb-3 leading-snug">
                In-Depth Technical Writeup Coming Soon
            </h3>

            <p id="preview-modal-description" class="text-slate-300 text-sm mb-6 leading-relaxed">
                Detailed architecture breakdown, performance benchmarks, and implementation code.
            </p>

            <div class="p-4 rounded-xl bg-slate-950/60 border border-slate-800 mb-6 space-y-2 text-xs font-mono text-slate-400">
                <div class="flex items-center gap-2 text-cyan-300 font-semibold">
                    <svg class="w-4 h-4 text-cyan-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span>Full Benchmark Specs &amp; IaC Blueprints</span>
                </div>
                <div class="flex items-center gap-2 text-cyan-300 font-semibold">
                    <svg class="w-4 h-4 text-cyan-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span>Production Telemetry &amp; Cost Data</span>
                </div>
                <div class="flex items-center gap-2 text-cyan-300 font-semibold">
                    <svg class="w-4 h-4 text-cyan-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span>Sanitized Code Artifacts &amp; Reproduction Guide</span>
                </div>
            </div>

            <p class="text-xs text-slate-500 mb-6 leading-relaxed">
                This writeup is currently undergoing final peer review and IP sanitization. If you require immediate architectural details or consultation for your organization, request an early briefing below.
            </p>

            <!-- Actions -->
            <div class="flex flex-col sm:flex-row items-center justify-between gap-3 pt-4 border-t border-slate-800">
                <button type="button" onclick="closePreviewModal(); toggleAuditModal();"
                    class="w-full sm:w-auto px-5 py-2.5 bg-cyan-400 hover:bg-cyan-300 text-slate-950 font-bold rounded-lg transition-all text-center text-xs uppercase tracking-wider">
                    Request Architecture Briefing
                </button>
                <div class="flex items-center gap-3 w-full sm:w-auto justify-end">
                    <a href="https://medium.com/@gobik1990" target="_blank" rel="noopener noreferrer"
                        class="text-xs font-mono text-cyan-400 hover:text-cyan-300 hover:underline">
                        Founder Medium &rarr;
                    </a>
                    <button type="button" onclick="closePreviewModal()"
                        class="px-4 py-2 bg-slate-800 hover:bg-slate-700 text-slate-300 text-xs font-semibold rounded-lg transition-all">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Founder Profile & Trust Footer (With Location & Social Proof Links) -->
    <footer class="bg-slate-950 border-t border-slate-900 py-16 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-start md:items-center justify-between gap-8">

            <!-- Founder Profile Badge -->
            <div class="flex items-center gap-4">
                @if($siteProfile->avatar_url)
                    <img src="{{ $siteProfile->avatar_url }}" alt="{{ $siteProfile->founder_name }}"
                        class="w-14 h-14 rounded-full object-cover border-2 border-cyan-500/40">
                @else
                    <div
                        class="w-14 h-14 rounded-full bg-slate-800 border-2 border-cyan-500/40 flex items-center justify-center font-mono font-bold text-cyan-400 text-lg">
                        {{ $siteProfile->founder_initials ?: 'GS' }}
                    </div>
                @endif
                <div>
                    <h4 class="text-white font-bold text-lg">{{ $siteProfile->founder_name }}</h4>
                    <p class="text-slate-400 text-sm">{{ $siteProfile->founder_title }}</p>
                    <p class="text-xs font-mono text-slate-500 mt-1">📍 {{ $siteProfile->location }}</p>
                </div>
            </div>

            <!-- Social Proof Links & Legal -->
            <div class="flex flex-col md:items-end gap-3">
                <div class="flex flex-wrap items-center gap-6 text-sm font-medium text-slate-400">
                    <a href="https://github.com/gobik1990" target="_blank" rel="noopener noreferrer"
                        class="hover:text-cyan-400 transition-colors">GitHub</a>
                    <a href="https://www.linkedin.com/in/gobikrishna-subramaniyam" target="_blank" rel="noopener noreferrer"
                        class="hover:text-cyan-400 transition-colors">LinkedIn</a>
                    <a href="https://medium.com/@gobik1990" target="_blank" rel="noopener noreferrer"
                        class="hover:text-cyan-400 transition-colors">Medium</a>
                    @foreach($siteProfile->all_social_links as $link)
                        @if(!in_array(strtolower($link['label']), ['github', 'linkedin', 'medium']))
                            <a href="{{ $link['url'] }}" target="_blank" rel="noopener noreferrer"
                                class="hover:text-cyan-400 transition-colors">{{ $link['label'] }}</a>
                        @endif
                    @endforeach
                </div>
                @if(!empty($siteProfile->phone))
                    <p class="text-xs font-mono text-slate-400">Direct / WhatsApp: <a href="tel:{{ $siteProfile->phone }}"
                            class="text-cyan-400 hover:underline">{{ $siteProfile->phone }}</a></p>
                @endif
                <p class="text-xs text-slate-600">© {{ date('Y') }} {{ $siteProfile->copyright_text }}</p>
            </div>
        </div>

    </footer>

    <!-- Terminal JavaScript Command Engine & Modal Controllers -->
    <script>
        function toggleAuditModal() {
            const modal = document.getElementById('audit-modal');
            if (modal) modal.classList.toggle('hidden');
        }

        function openRoseVillaModal() {
            const modal = document.getElementById('rose-villa-modal');
            if (modal) modal.classList.remove('hidden');
        }

        function closeRoseVillaModal() {
            const modal = document.getElementById('rose-villa-modal');
            if (modal) modal.classList.add('hidden');
        }

        function toggleRoseVillaModal() {
            const modal = document.getElementById('rose-villa-modal');
            if (modal) modal.classList.toggle('hidden');
        }

        function openPreviewModal(title, category, description) {
            const modal = document.getElementById('preview-modal');
            if (!modal) return;
            if (title) document.getElementById('preview-modal-title').textContent = title;
            if (category) document.getElementById('preview-modal-category').textContent = category;
            if (description) document.getElementById('preview-modal-description').textContent = description;
            modal.classList.remove('hidden');
        }

        function closePreviewModal() {
            const modal = document.getElementById('preview-modal');
            if (modal) modal.classList.add('hidden');
        }

        window.addEventListener('click', (e) => {
            const rvModal = document.getElementById('rose-villa-modal');
            const prevModal = document.getElementById('preview-modal');
            const auditModal = document.getElementById('audit-modal');
            if (e.target === rvModal) closeRoseVillaModal();
            if (e.target === prevModal) closePreviewModal();
            if (e.target === auditModal) toggleAuditModal();
        });

        window.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                closeRoseVillaModal();
                closePreviewModal();
                const auditModal = document.getElementById('audit-modal');
                if (auditModal && !auditModal.classList.contains('hidden')) {
                    toggleAuditModal();
                }
            }
        });

        document.addEventListener('DOMContentLoaded', () => {
            @if(session('audit_success') || $errors->any())
                const modal = document.getElementById('audit-modal');
                if (modal) modal.classList.remove('hidden');
            @endif
            const input = document.getElementById('terminal-input');
            const output = document.getElementById('terminal-output');

            const commands = {
                'help': 'Available commands: <span class="text-amber-300">services</span>, <span class="text-amber-300">stack</span>, <span class="text-amber-300">contact</span>, <span class="text-amber-300">clear</span>',
                'services': '1. AWS/Azure Cloud Infrastructure & IaC\n2. DevSecOps & Automated CI/CD Pipelines\n3. Managed Retail POS & Cloud Deployments',
                'stack': 'Laravel 11 / PHP 8.2+ / MySQL 8.0, Filament v3, Terraform, Docker, Kubernetes, AWS EKS, Tailwind CSS',
                'contact': 'Email: {{ $siteProfile->email }} | Location: {{ $siteProfile->location }}'
            };

            input.addEventListener('keydown', (e) => {
                if (e.key === 'Enter') {
                    const cmd = input.value.trim().toLowerCase();
                    const line = document.createElement('div');
                    line.className = 'mb-1';

                    if (cmd === 'clear') {
                        output.innerHTML = '';
                    } else if (commands[cmd]) {
                        line.innerHTML = `<span class="text-slate-400">guest@codeportlab:~$ ${cmd}</span><br><span class="text-emerald-300">${commands[cmd]}</span>`;
                        output.appendChild(line);
                    } else if (cmd !== '') {
                        line.innerHTML = `<span class="text-slate-400">guest@codeportlab:~$ ${cmd}</span><br><span class="text-red-400">Command not found. Type 'help'.</span>`;
                        output.appendChild(line);
                    }

                    input.value = '';
                    document.getElementById('terminal-window').scrollTop = document.getElementById('terminal-window').scrollHeight;
                }
            });
        });
    </script>
</body>

</html>