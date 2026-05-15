<section id="experience" class="py-24">
  <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-16" data-animate>
      <div class="section-badge">Work Experience</div>
      <h2 class="section-title">My Journey</h2>
    </div>

    <div class="relative">
      {{-- Vertical line --}}
      <div class="absolute left-5 top-8 bottom-0 w-0.5 bg-gradient-to-b from-blue-600 via-violet-600 to-transparent hidden sm:block"></div>

      <div class="space-y-8">
        @forelse($experiences as $exp)
        <div class="relative flex gap-6" data-animate>
          {{-- Dot --}}
          <div class="timeline-dot flex-shrink-0 hidden sm:flex z-10">
            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01"/></svg>
          </div>

          {{-- Card --}}
          <div class="card p-6 flex-1 glass-hover">
            <div class="flex flex-wrap items-start justify-between gap-3 mb-3">
              <div>
                <h3 class="text-lg font-bold text-white">{{ $exp->position }}</h3>
                <p class="text-blue-400 font-medium">{{ $exp->company }}</p>
              </div>
              <div class="text-right">
                <span class="text-xs font-semibold px-3 py-1 bg-blue-600/20 text-blue-400 rounded-full capitalize">{{ $exp->type }}</span>
                <p class="text-gray-500 text-xs mt-1">{{ $exp->duration }}</p>
                @if($exp->location)
                <p class="text-gray-600 text-xs">📍 {{ $exp->location }}</p>
                @endif
              </div>
            </div>

            @if($exp->description)
            <p class="text-gray-400 text-sm mb-4">{{ $exp->description }}</p>
            @endif

            @if($exp->responsibilities)
            <ul class="space-y-1.5 mb-4">
              @foreach($exp->responsibilities as $task)
              <li class="flex gap-2 text-sm text-gray-300">
                <span class="text-blue-400 mt-0.5 flex-shrink-0">▸</span>{{ $task }}
              </li>
              @endforeach
            </ul>
            @endif

            @if($exp->tech_stack)
            <div class="flex flex-wrap gap-2 mt-4 pt-4 border-t border-white/5">
              @foreach($exp->tech_stack as $tech)
              <span class="tag">{{ $tech }}</span>
              @endforeach
            </div>
            @endif
          </div>
        </div>
        @empty
        <p class="text-gray-500 text-center">No experience entries yet.</p>
        @endforelse
      </div>
    </div>
  </div>
</section>
