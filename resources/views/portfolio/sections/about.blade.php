<section id="about" class="py-24 relative">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid lg:grid-cols-2 gap-16 items-center">
      <div data-animate>
        <div class="section-badge">About Me</div>
        <h2 class="section-title mb-6">{{ $settings['about_title'] ?? 'Who I Am' }}</h2>
        <div class="text-gray-400 leading-relaxed space-y-4 text-base">
          @foreach(explode("\n\n", $settings['about_bio'] ?? '') as $para)
            <p>{{ trim($para) }}</p>
          @endforeach
        </div>

        {{-- Education --}}
        <div class="mt-8 p-5 glass rounded-2xl">
          <div class="flex items-start gap-4">
            <div class="w-12 h-12 rounded-xl bg-blue-600/20 flex items-center justify-center flex-shrink-0">
              <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/></svg>
            </div>
            <div>
              <p class="font-semibold text-white">{{ $settings['about_degree'] ?? 'D3 Teknik Informatika' }}</p>
              <p class="text-blue-400 text-sm">{{ $settings['about_university'] ?? 'Politeknik Negeri Batam' }}</p>
              <p class="text-gray-500 text-sm">Graduated {{ $settings['about_year'] ?? '2025' }} • GPA {{ $settings['about_gpa'] ?? '3.61' }}/4.00</p>
            </div>
          </div>
        </div>

        {{-- Strengths --}}
        <div class="mt-6 flex flex-wrap gap-2">
          @foreach(['Adaptif','Problem Solving','Fast Learner','Team Player','Clean Code','Detail-Oriented'] as $trait)
          <span class="tag">{{ $trait }}</span>
          @endforeach
        </div>
      </div>

      {{-- Stats --}}
      <div class="grid grid-cols-2 gap-4" data-animate>
        @php
        $stats = [
          ['value'=>'3.61','label'=>'GPA Score','suffix'=>'/4.00','decimals'=>2,'icon'=>'🎓'],
          ['value'=>'3','label'=>'Projects Built','suffix'=>'+','decimals'=>0,'icon'=>'🚀'],
          ['value'=>'9','label'=>'Months Internship','suffix'=>'mo','decimals'=>0,'icon'=>'💼'],
          ['value'=>'5','label'=>'Tech Stacks','suffix'=>'+','decimals'=>0,'icon'=>'⚡'],
        ];
        @endphp
        @foreach($stats as $s)
        <div class="card p-6 text-center">
          <div class="text-3xl mb-2">{{ $s['icon'] }}</div>
          <div class="text-3xl font-black gradient-text">
            <span data-count="{{ $s['value'] }}" data-decimals="{{ $s['decimals'] }}">{{ $s['value'] }}</span>{{ $s['suffix'] }}
          </div>
          <p class="text-gray-400 text-sm mt-1">{{ $s['label'] }}</p>
        </div>
        @endforeach
      </div>
    </div>
  </div>
</section>
