<section id="hero" class="relative min-h-screen flex items-center justify-center overflow-hidden pt-16">
  {{-- Background --}}
  <div class="absolute inset-0">
    <canvas id="particles-canvas" class="w-full h-full"></canvas>
    <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-blue-600/10 rounded-full blur-3xl animate-blob"></div>
    <div class="absolute bottom-1/4 right-1/4 w-80 h-80 bg-violet-600/10 rounded-full blur-3xl animate-blob" style="animation-delay:2s"></div>
  </div>

  <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
    <div class="grid lg:grid-cols-2 gap-16 items-center">
      {{-- Text --}}
      <div>
        <div class="section-badge mb-6">
          <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></span>
          Available for opportunities
        </div>
        <p class="text-gray-400 text-lg mb-2">{{ $settings['hero_greeting'] ?? 'Hello, I\'m' }}</p>
        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black text-white leading-tight mb-4">
          {{ $settings['hero_name'] ?? 'Yoel Feliks Hutabarat' }}
        </h1>
        <div class="flex items-center gap-2 mb-6 h-10">
          <span class="text-blue-400 text-2xl font-bold">〈</span>
          <span id="typing-text" data-roles="{{ $settings['hero_roles'] ?? 'Fullstack Developer,Laravel Developer,AI Web Developer' }}"
                class="gradient-text text-2xl font-bold min-w-[200px]"></span>
          <span class="w-0.5 h-7 bg-blue-400 animate-pulse ml-1"></span>
          <span class="text-blue-400 text-2xl font-bold">/〉</span>
        </div>
        <p class="text-gray-400 text-lg leading-relaxed mb-8 max-w-xl">
          {{ $settings['hero_subtitle'] ?? 'Building modern web applications with clean code and innovative solutions.' }}
        </p>
        <div class="flex flex-wrap gap-3">
          @if(!empty($settings['cv_file']))
          <a href="{{ asset('storage/'.$settings['cv_file']) }}" download class="btn-primary flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            Download CV
          </a>
          @endif
          <a href="#projects" class="btn-outline flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
            View Projects
          </a>
          <a href="#contact" class="btn-outline flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
            Contact Me
          </a>
        </div>
        {{-- Social icons --}}
        <div class="flex gap-3 mt-8">
          @if(!empty($settings['social_github']))
          <a href="{{ $settings['social_github'] }}" target="_blank" class="w-10 h-10 glass rounded-xl flex items-center justify-center text-gray-400 hover:text-white hover:border-blue-500/40 transition-all">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C5.374 0 0 5.373 0 12c0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23A11.509 11.509 0 0112 5.803c1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576C20.566 21.797 24 17.3 24 12c0-6.627-5.373-12-12-12z"/></svg>
          </a>
          @endif
          @if(!empty($settings['social_linkedin']))
          <a href="{{ $settings['social_linkedin'] }}" target="_blank" class="w-10 h-10 glass rounded-xl flex items-center justify-center text-gray-400 hover:text-white hover:border-blue-500/40 transition-all">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
          </a>
          @endif
          @if(!empty($settings['contact_email']))
          <a href="mailto:{{ $settings['contact_email'] }}" class="w-10 h-10 glass rounded-xl flex items-center justify-center text-gray-400 hover:text-white hover:border-blue-500/40 transition-all">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
          </a>
          @endif
        </div>
      </div>

      {{-- Profile Photo --}}
      <div class="flex justify-center lg:justify-end">
        <div class="relative">
          <div class="absolute inset-0 bg-gradient-to-br from-blue-500/30 to-violet-500/30 rounded-3xl blur-2xl scale-110"></div>
          <div class="relative w-72 h-72 lg:w-80 lg:h-80 rounded-3xl overflow-hidden ring-2 ring-white/10 shadow-2xl animate-float">
            @if(!empty($settings['profile_photo']))
              <img src="{{ asset('storage/'.$settings['profile_photo']) }}" alt="{{ $settings['hero_name'] ?? 'Profile' }}" class="w-full h-full object-cover" />
            @else
              <div class="w-full h-full gradient-bg flex items-center justify-center">
                <span class="text-8xl">👨‍💻</span>
              </div>
            @endif
          </div>
          {{-- Floating badges --}}
          <div class="absolute -bottom-4 -left-4 glass rounded-xl p-3 animate-pulse-glow">
            <div class="flex items-center gap-2">
              <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
              <span class="text-xs font-medium text-white">Open to work</span>
            </div>
          </div>
          <div class="absolute -top-4 -right-4 glass rounded-xl p-3">
            <div class="text-center"><p class="text-xl font-black gradient-text">3.61</p><p class="text-xs text-gray-400">GPA</p></div>
          </div>
        </div>
      </div>
    </div>

    {{-- Scroll indicator --}}
    <div class="flex justify-center mt-16">
      <a href="#about" class="flex flex-col items-center gap-2 text-gray-500 hover:text-gray-300 transition-colors animate-float">
        <span class="text-xs">Scroll</span>
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
      </a>
    </div>
  </div>
</section>
