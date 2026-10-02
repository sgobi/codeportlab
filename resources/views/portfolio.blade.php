<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $siteProfile->brand_name . $siteProfile->brand_accent }} | {{ $siteProfile->tagline }}</title>
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
                <img src="{{ $siteProfile->logo_url }}" alt="{{ $siteProfile->brand_name }} Logo" class="h-10 w-auto object-contain">
                <div class="flex flex-col leading-none">
                    <span class="font-mono text-lg font-bold text-white">{{ $siteProfile->brand_name }}<span class="text-cyan-400">{{ $siteProfile->brand_accent }}</span></span>
                    <span class="text-[10px] text-slate-400 tracking-widest font-mono mt-0.5">{{ $siteProfile->tagline }}</span>
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
            We build, secure, and scale production environments using Terraform IaC, Automated CI/CD Pipelines,
            AWS/Azure Cloud Architectures, and Managed POS Infrastructure.
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
                <p class="text-slate-400 text-sm leading-relaxed mb-6">Managed backends, ESC/POS print engines, and cloud backups for retail & hospitality.</p>
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
            <p class="text-slate-400 max-w-2xl mx-auto">Real-world production benchmarks and infrastructure outcomes
                delivered for clients.</p>
        </div>
        <div class="grid lg:grid-cols-3 gap-8">
            @foreach($caseStudies as $study)
                <div
                    class="bg-slate-900/80 border border-slate-800 rounded-xl p-6 flex flex-col justify-between hover:border-slate-700 transition-all">
                    <div>
                        <!-- Type Badge & Category Header -->
                        <div class="flex flex-wrap items-center justify-between gap-2 mb-3">
                            <span class="text-xs font-mono text-cyan-400 uppercase tracking-wider">{{ $study['category'] }}</span>
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-[11px] font-mono font-medium {{ str_contains($study['type'] ?? '', 'Client') ? 'bg-emerald-500/10 text-emerald-400 border border-emerald-500/30' : 'bg-purple-500/10 text-purple-300 border border-purple-500/30' }}">
                                {{ $study['type'] ?? 'Benchmark' }}
                            </span>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-4 leading-snug">{{ $study['title'] }}</h3>
                        <p class="text-slate-400 text-sm leading-relaxed mb-6">{{ $study['description'] }}</p>

                        <!-- Metrics Badges -->
                        <div class="flex flex-wrap gap-2 mb-6">
                            @foreach($study['metrics'] as $metric)
                                <span
                                    class="px-3 py-1 rounded bg-slate-800 border border-slate-700 text-cyan-300 font-mono text-xs font-medium">
                                    {{ $metric }}
                                </span>
                            @endforeach
                        </div>
                    </div>

                    @if(isset($study['link']) && str_starts_with($study['link'], 'http'))
                        <a href="{{ $study['link'] }}" target="_blank" rel="noopener noreferrer"
                            class="inline-flex items-center gap-2 text-sm font-semibold text-white bg-slate-800 hover:bg-slate-700 px-4 py-2 rounded transition-all w-fit">
                            <span>{{ $study['link_text'] }}</span>
                            <span class="text-xs">&rarr;</span>
                        </a>
                    @else
                        <button onclick="toggleAuditModal()"
                            class="inline-flex items-center gap-2 text-sm font-semibold text-slate-950 bg-cyan-400 hover:bg-cyan-300 px-4 py-2 rounded transition-all w-fit font-bold">
                            <span>{{ $study['link_text'] }}</span>
                            <span class="text-xs">&rarr;</span>
                        </button>
                    @endif
                </div>
            @endforeach
        </div>

        <!-- Guarantees & Standards Trust Proof Box -->
        <div class="mt-12 bg-slate-900/60 border border-slate-800 rounded-xl p-6 sm:p-8 flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
            <div class="flex items-start gap-4">
                <div class="w-10 h-10 rounded-lg bg-cyan-500/10 border border-cyan-500/30 flex items-center justify-center shrink-0 text-cyan-400 font-mono text-sm font-bold">
                    &gt;_
                </div>
                <div>
                    <span class="text-xs font-mono uppercase tracking-widest text-cyan-400 font-semibold block mb-1">Guarantees & Standards</span>
                    <blockquote class="text-slate-200 text-sm sm:text-base italic leading-relaxed">
                        &ldquo;Engineered for zero-downtime, strict IaC auditability, and cloud cost efficiency.&rdquo;
                        <span class="not-italic text-slate-400 block sm:inline font-mono text-xs sm:ml-2">&mdash; Lead Cloud Architect, CodePortLab</span>
                    </blockquote>
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
        <div class="grid md:grid-cols-2 gap-6">
            @forelse($techUpdates as $update)
                <a href="{{ $update->external_url ?: 'https://medium.com/@gobik1990' }}" target="_blank" rel="noopener"
                    class="bg-slate-900/60 border border-slate-800 p-6 rounded-xl hover:border-cyan-500/50 transition-all block group">
                    <span class="text-xs font-mono text-cyan-400 uppercase">{{ $update->category ?: 'PUBLISHED ARTICLE' }}</span>
                    <h3 class="text-lg font-bold text-white mt-2 group-hover:text-cyan-300 transition-colors">{{ $update->title }}</h3>
                    <p class="text-slate-400 text-sm mt-2">{{ $update->summary }}</p>
                </a>
            @empty
                <a href="https://medium.com/@gobik1990" target="_blank" rel="noopener"
                    class="bg-slate-900/60 border border-slate-800 p-6 rounded-xl hover:border-cyan-500/50 transition-all block group">
                    <span class="text-xs font-mono text-cyan-400">PUBLISHED ARTICLE</span>
                    <h3 class="text-lg font-bold text-white mt-2 group-hover:text-cyan-300 transition-colors">Stop Shell
                        Scripting: Build a Smart Docker Assistant with MCP</h3>
                    <p class="text-slate-400 text-sm mt-2">How Model Context Protocol replaces brittle bash scripts for
                        container orchestration.</p>
                </a>
                <a href="https://medium.com/@gobik1990" target="_blank" rel="noopener"
                    class="bg-slate-900/60 border border-slate-800 p-6 rounded-xl hover:border-cyan-500/50 transition-all block group">
                    <span class="text-xs font-mono text-cyan-400">ARCHITECTURAL COMPARISON</span>
                    <h3 class="text-lg font-bold text-white mt-2 group-hover:text-cyan-300 transition-colors">ECS vs.
                        EKS: Which AWS Container Orchestrator is Right?</h3>
                    <p class="text-slate-400 text-sm mt-2">A technical cost and ops breakdown for engineering leaders
                        evaluating AWS compute.</p>
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
            <p class="text-slate-400 max-w-xl mx-auto mb-8">Schedule a 30-minute cloud assessment or send us your
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
            <p class="text-slate-400 text-sm mb-6">Fill in your email and primary cloud stack. We will respond
                within 24 hours.</p>

            <form action="#contact" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-mono text-slate-400 mb-1">YOUR EMAIL</label>
                    <input type="email" required placeholder="cto@company.com"
                        class="w-full bg-slate-950 border border-slate-800 rounded p-3 text-sm text-slate-100 focus:outline-none focus:border-cyan-400">
                </div>
                <div>
                    <label class="block text-xs font-mono text-slate-400 mb-1">CLOUD / STACK (AWS, AZURE, DOCKER,
                        LARAVEL 11 / PHP 8.2+)</label>
                    <input type="text" required placeholder="e.g. AWS EKS, Terraform, Laravel 11 (PHP 8.2+), POS Systems"
                        class="w-full bg-slate-950 border border-slate-800 rounded p-3 text-sm text-slate-100 focus:outline-none focus:border-cyan-400">
                </div>
                <div>
                    <label class="block text-xs font-mono text-slate-400 mb-1">PROJECT SCOPE & GOALS</label>
                    <textarea rows="3" placeholder="Describe current pain points, cost targets, or migration needs..."
                        class="w-full bg-slate-950 border border-slate-800 rounded p-3 text-sm text-slate-100 focus:outline-none focus:border-cyan-400"></textarea>
                </div>
                <button type="submit"
                    class="w-full py-3 bg-cyan-400 hover:bg-cyan-300 text-slate-950 font-bold rounded transition-all">
                    Submit Audit Request
                </button>
            </form>
        </div>
    </div>




    <!-- Founder Profile & Trust Footer (With Location & Social Proof Links) -->
    <footer class="bg-slate-950 border-t border-slate-900 py-16 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-start md:items-center justify-between gap-8">

            <!-- Founder Profile Badge -->
            <div class="flex items-center gap-4">
                @if($siteProfile->avatar_url)
                    <img src="{{ $siteProfile->avatar_url }}" alt="{{ $siteProfile->founder_name }}" class="w-14 h-14 rounded-full object-cover border-2 border-cyan-500/40">
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
                    @foreach($siteProfile->all_social_links as $link)
                        <a href="{{ $link['url'] }}" target="_blank" rel="noopener noreferrer"
                            class="hover:text-cyan-400 transition-colors">{{ $link['label'] }}</a>
                    @endforeach
                </div>
                @if(!empty($siteProfile->phone))
                    <p class="text-xs font-mono text-slate-400">Direct / WhatsApp: <a href="tel:{{ $siteProfile->phone }}" class="text-cyan-400 hover:underline">{{ $siteProfile->phone }}</a></p>
                @endif
                <p class="text-xs text-slate-600">© {{ date('Y') }} {{ $siteProfile->copyright_text }}</p>
            </div>
        </div>



    </footer>

    <!-- Terminal JavaScript Command Engine -->
    <script>
        function toggleAuditModal() {
            const modal = document.getElementById('audit-modal');
            modal.classList.toggle('hidden');
        }

        document.addEventListener('DOMContentLoaded', () => {
            const input = document.getElementById('terminal-input');
            const output = document.getElementById('terminal-output');

            const commands = {
                'help': 'Available commands: <span class="text-amber-300">services</span>, <span class="text-amber-300">stack</span>, <span class="text-amber-300">contact</span>, <span class="text-amber-300">clear</span>',
                'services': '1. AWS/Azure Cloud Infrastructure & IaC\n2. DevSecOps & Automated CI/CD Pipelines\n3. Managed Retail POS & Cloud Deployments',
                'stack': 'Laravel 11 (PHP 8.2+), Filament v3, Terraform, Docker, Kubernetes, AWS EKS, MySQL, Tailwind CSS',
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