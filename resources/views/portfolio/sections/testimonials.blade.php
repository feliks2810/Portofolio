<section id="testimonials" class="py-24 relative">
  <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    @if($testimonials->isNotEmpty())
    <div class="text-center mb-16" data-animate>
      <div class="section-badge">Testimonials</div>
      <h2 class="section-title">What People Say</h2>
    </div>
    <div id="testimonial-slider" class="relative" style="min-height:200px;">
      @foreach($testimonials as $testimonial)
      <div class="testimonial-item transition-all duration-500" style="opacity:0;transform:translateX(20px);">
        <div class="card p-8 text-center glass-hover">
          <div class="flex justify-center mb-4">
            @for($i=0;$i<5;$i++)
            <svg class="w-5 h-5 {{ $i < $testimonial->rating ? 'text-yellow-400' : 'text-gray-700' }}" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
            @endfor
          </div>
          <blockquote class="text-gray-300 text-lg leading-relaxed italic mb-6">"{{ $testimonial->content }}"</blockquote>
          <div class="flex items-center justify-center gap-3">
            <img src="{{ $testimonial->avatar_url }}" alt="{{ $testimonial->name }}" class="w-12 h-12 rounded-full object-cover ring-2 ring-blue-500/30" />
            <div class="text-left">
              <p class="font-semibold text-white">{{ $testimonial->name }}</p>
              <p class="text-gray-500 text-sm">{{ $testimonial->position }}{{ $testimonial->company ? ' · '.$testimonial->company : '' }}</p>
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>
    @endif
  </div>
</section>
