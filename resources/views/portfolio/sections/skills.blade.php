<section id="skills" class="py-24 relative">
  <div class="absolute inset-0 bg-gradient-to-b from-transparent via-blue-950/10 to-transparent pointer-events-none"></div>
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-16" data-animate>
      <div class="section-badge">Technical Skills</div>
      <h2 class="section-title">My Tech Stack</h2>
      <p class="text-gray-400 mt-3 max-w-xl mx-auto">Technologies and tools I work with to build modern web applications</p>
    </div>

    @php
    $categoryMeta = [
      'frontend'  => ['label'=>'Frontend','icon'=>'🎨','color'=>'from-blue-500 to-cyan-500'],
      'backend'   => ['label'=>'Backend','icon'=>'⚙️','color'=>'from-violet-500 to-purple-600'],
      'database'  => ['label'=>'Database','icon'=>'🗄️','color'=>'from-emerald-500 to-teal-500'],
      'ai'        => ['label'=>'AI & Integration','icon'=>'🤖','color'=>'from-orange-500 to-red-500'],
      'tools'     => ['label'=>'Tools','icon'=>'🛠️','color'=>'from-pink-500 to-rose-500'],
    ];
    @endphp

    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
      @foreach($skills as $category => $catSkills)
      @php $meta = $categoryMeta[$category] ?? ['label'=>ucfirst($category),'icon'=>'💡','color'=>'from-blue-500 to-violet-500'] @endphp
      <div class="card p-6 glass-hover" data-animate>
        <div class="flex items-center gap-3 mb-5">
          <div class="w-10 h-10 rounded-xl bg-gradient-to-br {{ $meta['color'] }} flex items-center justify-center text-lg shadow-lg">{{ $meta['icon'] }}</div>
          <h3 class="font-bold text-white">{{ $meta['label'] }}</h3>
        </div>
        <div class="space-y-4">
          @foreach($catSkills as $skill)
          <div>
            <div class="flex justify-between mb-1.5">
              <span class="text-sm font-medium text-gray-300">{{ $skill['name'] }}</span>
              <span class="text-xs text-gray-500 font-mono">{{ $skill['level'] }}%</span>
            </div>
            <div class="progress-bar">
              <div class="progress-fill" data-level="{{ $skill['level'] }}" style="width:0%"></div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>
