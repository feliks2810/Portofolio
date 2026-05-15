<section id="projects" class="py-24 relative">
  <div class="absolute inset-0 bg-gradient-to-b from-transparent via-violet-950/10 to-transparent pointer-events-none"></div>
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-16" data-animate>
      <div class="section-badge">Portfolio</div>
      <h2 class="section-title">My Projects</h2>
      <p class="text-gray-400 mt-3 max-w-xl mx-auto">Real-world projects built with modern technologies</p>
    </div>

    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
      @forelse($projects as $project)
      @php
        $projectData = [
          "title" => $project->title,
          "category" => $project->category,
          "description" => $project->description,
          "long_description" => $project->long_description,
          "tech_stack" => $project->tech_stack,
          "features" => $project->features,
          "thumbnail" => $project->thumbnail ? asset("storage/".$project->thumbnail) : null,
          "demo_url" => $project->demo_url,
          "github_url" => $project->github_url
        ];
      @endphp
      <div class="card overflow-hidden glass-hover group cursor-pointer" data-animate
           onclick='openProjectModal(@json($projectData))'>

        {{-- Thumbnail --}}
        <div class="h-48 bg-gradient-to-br from-gray-800 to-gray-900 overflow-hidden relative">
          @if($project->thumbnail)
            <img src="{{ asset('storage/'.$project->thumbnail) }}" alt="{{ $project->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />
          @else
            <div class="w-full h-full flex items-center justify-center">
              <div class="text-6xl opacity-30">🚀</div>
            </div>
          @endif
          <div class="absolute inset-0 bg-gradient-to-t from-gray-950 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
          @if($project->is_featured)
          <div class="absolute top-3 right-3 px-2 py-1 bg-blue-600 text-white text-xs font-bold rounded-lg">Featured</div>
          @endif
          <div class="absolute top-3 left-3 px-2 py-1 bg-black/60 backdrop-blur text-gray-300 text-xs rounded-lg">{{ $project->category }}</div>
        </div>

        <div class="p-5">
          <h3 class="font-bold text-white text-lg mb-2 group-hover:text-blue-400 transition-colors">{{ $project->title }}</h3>
          <p class="text-gray-400 text-sm leading-relaxed line-clamp-2 mb-4">{{ $project->description }}</p>

          @if($project->tech_stack)
          <div class="flex flex-wrap gap-1.5 mb-4">
            @foreach(array_slice($project->tech_stack, 0, 4) as $tech)
            <span class="tag">{{ $tech }}</span>
            @endforeach
            @if(count($project->tech_stack) > 4)
            <span class="tag">+{{ count($project->tech_stack)-4 }}</span>
            @endif
          </div>
          @endif

          <div class="flex items-center justify-between pt-3 border-t border-white/5">
            <span class="text-xs text-gray-500 flex items-center gap-1">
              <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
              Click for details
            </span>
            <div class="flex gap-2">
              @if($project->github_url)
              <a href="{{ $project->github_url }}" target="_blank" onclick="event.stopPropagation()" class="text-gray-500 hover:text-white transition-colors">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C5.374 0 0 5.373 0 12c0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23A11.509 11.509 0 0112 5.803c1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576C20.566 21.797 24 17.3 24 12c0-6.627-5.373-12-12-12z"/></svg>
              </a>
              @endif
              @if($project->demo_url)
              <a href="{{ $project->demo_url }}" target="_blank" onclick="event.stopPropagation()" class="text-gray-500 hover:text-white transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
              </a>
              @endif
            </div>
          </div>
        </div>
      </div>
      @empty
      <div class="col-span-3 text-center text-gray-500 py-16">No projects yet.</div>
      @endforelse
    </div>
  </div>
</section>
