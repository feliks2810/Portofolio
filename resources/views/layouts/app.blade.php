<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    {{-- SEO --}}
    <title>{{ $seoTitle ?? ($settings['seo_meta_title'] ?? config('app.name')) }}</title>
    <meta name="description" content="{{ $seoDesc ?? ($settings['seo_meta_description'] ?? '') }}" />
    <meta name="keywords" content="{{ $settings['seo_keywords'] ?? 'laravel developer, fullstack developer' }}" />

    {{-- Open Graph --}}
    <meta property="og:title" content="{{ $seoTitle ?? ($settings['seo_meta_title'] ?? config('app.name')) }}" />
    <meta property="og:description" content="{{ $seoDesc ?? ($settings['seo_meta_description'] ?? '') }}" />
    <meta property="og:type" content="website" />

    {{-- Favicon --}}
    @if(!empty($settings['favicon']))
        <link rel="icon" type="image/x-icon" href="{{ asset('storage/' . $settings['favicon']) }}" />
    @else
        <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>💻</text></svg>" />
    @endif

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet" />

    {{-- Alpine.js --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.0/dist/cdn.min.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="bg-gray-950 text-gray-100 antialiased" x-data="{ mobileMenuOpen: false }">

    {{-- Navigation --}}
    <nav class="fixed top-0 left-0 right-0 z-50 transition-all duration-300" id="navbar"
         x-data="{ scrolled: false }"
         x-init="window.addEventListener('scroll', () => { scrolled = window.scrollY > 50 })"
         :class="scrolled ? 'bg-gray-950/95 backdrop-blur-xl border-b border-white/5 shadow-xl' : 'bg-transparent'">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                {{-- Logo --}}
                <a href="{{ route('home') }}" class="flex items-center gap-2 group">
                    @if(!empty($settings['site_logo']))
                        <img src="{{ asset('storage/' . $settings['site_logo']) }}" alt="Logo" class="h-8 w-auto" />
                    @else
                        <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-blue-500 to-violet-600 flex items-center justify-center text-white font-bold text-sm shadow-lg shadow-blue-500/25">YFH</div>
                    @endif
                    <span class="font-bold text-white group-hover:text-blue-400 transition-colors hidden sm:block">Yoel Feliks</span>
                </a>

                {{-- Desktop Nav --}}
                <div class="hidden md:flex items-center gap-1">
                    @foreach([['#hero','Home'],['#about','About'],['#skills','Skills'],['#experience','Experience'],['#projects','Projects'],['#testimonials','Testimonials'],['#blog','Blog'],['#contact','Contact']] as [$href, $label])
                    <a href="{{ $href }}" class="px-3 py-2 text-sm text-gray-400 hover:text-white rounded-lg hover:bg-white/5 transition-all duration-200 font-medium">{{ $label }}</a>
                    @endforeach
                </div>

                {{-- CTA + Mobile --}}
                <div class="flex items-center gap-3">
                    @if(!empty($settings['cv_file']))
                    <a href="{{ asset('storage/' . $settings['cv_file']) }}" download
                       class="hidden sm:inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-blue-600 to-violet-600 hover:from-blue-500 hover:to-violet-500 text-white text-sm font-semibold rounded-xl transition-all duration-300 shadow-lg shadow-blue-500/25 hover:shadow-blue-500/40 hover:-translate-y-0.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        Download CV
                    </a>
                    @endif
                    {{-- Mobile toggle --}}
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden p-2 rounded-lg text-gray-400 hover:text-white hover:bg-white/10 transition-all">
                        <svg x-show="!mobileMenuOpen" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                        <svg x-show="mobileMenuOpen" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display:none;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
            </div>
        </div>

        {{-- Mobile Menu --}}
        <div x-show="mobileMenuOpen" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-2" class="md:hidden bg-gray-950/98 backdrop-blur-xl border-b border-white/5" style="display:none;">
            <div class="px-4 py-4 space-y-1">
                @foreach([['#hero','Home'],['#about','About'],['#skills','Skills'],['#experience','Experience'],['#projects','Projects'],['#testimonials','Testimonials'],['#blog','Blog'],['#contact','Contact']] as [$href, $label])
                <a href="{{ $href }}" @click="mobileMenuOpen = false" class="block px-4 py-2.5 text-sm text-gray-300 hover:text-white hover:bg-white/5 rounded-xl transition-all">{{ $label }}</a>
                @endforeach
                @if(!empty($settings['cv_file']))
                <a href="{{ asset('storage/' . $settings['cv_file']) }}" download class="flex items-center gap-2 px-4 py-2.5 mt-2 bg-gradient-to-r from-blue-600 to-violet-600 text-white text-sm font-semibold rounded-xl">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    Download CV
                </a>
                @endif
            </div>
        </div>
    </nav>

    {{-- Main Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="bg-gray-950 border-t border-white/5">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
                {{-- Brand --}}
                <div>
                    <div class="flex items-center gap-2 mb-4">
                        <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-blue-500 to-violet-600 flex items-center justify-center text-white font-bold text-sm">YFH</div>
                        <span class="font-bold text-white">Yoel Feliks Hutabarat</span>
                    </div>
                    <p class="text-gray-400 text-sm leading-relaxed">Fullstack Web Developer — Turning ideas into elegant digital experiences.</p>
                </div>

                {{-- Quick Links --}}
                <div>
                    <h4 class="font-semibold text-white mb-4">Quick Links</h4>
                    <ul class="space-y-2">
                        @foreach([['#about','About Me'],['#projects','Projects'],['#experience','Experience'],['#blog','Blog'],['#contact','Contact']] as [$href, $label])
                        <li><a href="{{ $href }}" class="text-gray-400 hover:text-blue-400 text-sm transition-colors">{{ $label }}</a></li>
                        @endforeach
                    </ul>
                </div>

                {{-- Social --}}
                <div>
                    <h4 class="font-semibold text-white mb-4">Connect</h4>
                    <div class="flex flex-wrap gap-3">
                        @if(!empty($settings['social_github']))
                        <a href="{{ $settings['social_github'] }}" target="_blank" rel="noopener" class="flex items-center gap-2 px-3 py-2 bg-white/5 hover:bg-white/10 rounded-lg text-sm text-gray-400 hover:text-white transition-all">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C5.374 0 0 5.373 0 12c0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23A11.509 11.509 0 0112 5.803c1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576C20.566 21.797 24 17.3 24 12c0-6.627-5.373-12-12-12z"/></svg>
                            GitHub
                        </a>
                        @endif
                        @if(!empty($settings['social_linkedin']))
                        <a href="{{ $settings['social_linkedin'] }}" target="_blank" rel="noopener" class="flex items-center gap-2 px-3 py-2 bg-white/5 hover:bg-white/10 rounded-lg text-sm text-gray-400 hover:text-white transition-all">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                            LinkedIn
                        </a>
                        @endif
                        @if(!empty($settings['social_whatsapp']))
                        <a href="{{ $settings['social_whatsapp'] }}" target="_blank" rel="noopener" class="flex items-center gap-2 px-3 py-2 bg-white/5 hover:bg-white/10 rounded-lg text-sm text-gray-400 hover:text-white transition-all">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M12 0C5.373 0 0 5.373 0 12c0 2.137.567 4.156 1.549 5.897L.057 23.525a.45.45 0 00.544.553l5.758-1.498A11.948 11.948 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 21.818a9.818 9.818 0 01-5.016-1.374l-.354-.21-3.718.968.994-3.607-.234-.372A9.818 9.818 0 012.182 12C2.182 6.57 6.57 2.182 12 2.182c5.43 0 9.818 4.388 9.818 9.818 0 5.43-4.388 9.818-9.818 9.818z"/></svg>
                            WhatsApp
                        </a>
                        @endif
                    </div>
                </div>
            </div>

            <div class="border-t border-white/5 pt-6 flex flex-col sm:flex-row items-center justify-between gap-4">
                <p class="text-gray-500 text-sm">© {{ date('Y') }} Yoel Feliks Hutabarat. All rights reserved.</p>
                <a href="{{ route('admin.login') }}" class="text-gray-600 hover:text-gray-400 text-xs transition-colors">Admin</a>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
