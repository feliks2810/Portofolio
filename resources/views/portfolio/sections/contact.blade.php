<section id="contact" class="py-24 relative">
  <div class="absolute inset-0 bg-gradient-to-b from-transparent via-blue-950/10 to-transparent pointer-events-none"></div>
  <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-16" data-animate>
      <div class="section-badge">Get In Touch</div>
      <h2 class="section-title">Let's Work Together</h2>
      <p class="text-gray-400 mt-3 max-w-xl mx-auto">Have a project in mind? I'd love to hear about it.</p>
    </div>

    <div class="grid lg:grid-cols-2 gap-12">
      {{-- Contact Info --}}
      <div data-animate>
        <h3 class="text-xl font-bold text-white mb-6">Contact Information</h3>
        <div class="space-y-4">
          @if(!empty($settings['contact_email']))
          <a href="mailto:{{ $settings['contact_email'] }}" class="flex items-center gap-4 p-4 glass rounded-xl hover:border-blue-500/30 transition-all group">
            <div class="w-10 h-10 rounded-lg bg-blue-600/20 flex items-center justify-center flex-shrink-0 group-hover:bg-blue-600/30 transition-colors">
              <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
            </div>
            <div><p class="text-xs text-gray-500">Email</p><p class="text-white font-medium">{{ $settings['contact_email'] }}</p></div>
          </a>
          @endif
          @if(!empty($settings['social_whatsapp']))
          <a href="{{ $settings['social_whatsapp'] }}" target="_blank" class="flex items-center gap-4 p-4 glass rounded-xl hover:border-green-500/30 transition-all group">
            <div class="w-10 h-10 rounded-lg bg-green-600/20 flex items-center justify-center flex-shrink-0">
              <svg class="w-5 h-5 text-green-400" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M12 0C5.373 0 0 5.373 0 12c0 2.137.567 4.156 1.549 5.897L.057 23.525a.45.45 0 00.544.553l5.758-1.498A11.948 11.948 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 21.818a9.818 9.818 0 01-5.016-1.374l-.354-.21-3.718.968.994-3.607-.234-.372A9.818 9.818 0 012.182 12C2.182 6.57 6.57 2.182 12 2.182c5.43 0 9.818 4.388 9.818 9.818 0 5.43-4.388 9.818-9.818 9.818z"/></svg>
            </div>
            <div><p class="text-xs text-gray-500">WhatsApp</p><p class="text-white font-medium">{{ $settings['contact_phone'] ?? 'Chat on WhatsApp' }}</p></div>
          </a>
          @endif
          @if(!empty($settings['social_github']))
          <a href="{{ $settings['social_github'] }}" target="_blank" class="flex items-center gap-4 p-4 glass rounded-xl hover:border-white/20 transition-all group">
            <div class="w-10 h-10 rounded-lg bg-white/10 flex items-center justify-center flex-shrink-0">
              <svg class="w-5 h-5 text-gray-300" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C5.374 0 0 5.373 0 12c0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23A11.509 11.509 0 0112 5.803c1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576C20.566 21.797 24 17.3 24 12c0-6.627-5.373-12-12-12z"/></svg>
            </div>
            <div><p class="text-xs text-gray-500">GitHub</p><p class="text-white font-medium">{{ $settings['social_github'] }}</p></div>
          </a>
          @endif
          @if(!empty($settings['contact_location']))
          <div class="flex items-center gap-4 p-4 glass rounded-xl">
            <div class="w-10 h-10 rounded-lg bg-violet-600/20 flex items-center justify-center flex-shrink-0">
              <svg class="w-5 h-5 text-violet-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            </div>
            <div><p class="text-xs text-gray-500">Location</p><p class="text-white font-medium">{{ $settings['contact_location'] }}</p></div>
          </div>
          @endif
        </div>
      </div>

      {{-- Contact Form --}}
      <div data-animate>
        <form id="contact-form" action="{{ route('contact.store') }}" method="POST" class="card p-6 space-y-4">
          @csrf
          <div class="grid sm:grid-cols-2 gap-4">
            <div>
              <label class="form-label">Your Name *</label>
              <input type="text" name="name" required class="form-input" placeholder="John Doe" />
            </div>
            <div>
              <label class="form-label">Email Address *</label>
              <input type="email" name="email" required class="form-input" placeholder="john@example.com" />
            </div>
          </div>
          <div>
            <label class="form-label">Phone (Optional)</label>
            <input type="text" name="phone" class="form-input" placeholder="+62 812-xxxx-xxxx" />
          </div>
          <div>
            <label class="form-label">Subject</label>
            <input type="text" name="subject" class="form-input" placeholder="Project Discussion" />
          </div>
          <div>
            <label class="form-label">Message *</label>
            <textarea name="message" required rows="4" class="form-textarea" placeholder="Tell me about your project..."></textarea>
          </div>
          <button type="submit" class="btn-primary w-full flex items-center justify-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
            Send Message
          </button>
          <div id="form-message" class="hidden"></div>
        </form>
      </div>
    </div>
  </div>
</section>
