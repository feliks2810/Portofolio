<section id="blog" class="py-24">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    @if($latestPosts->isNotEmpty())
    <div class="flex items-end justify-between mb-16" data-animate>
      <div>
        <div class="section-badge">Blog</div>
        <h2 class="section-title">Latest Articles</h2>
      </div>
      <a href="{{ route('blog.index') }}" class="btn-outline text-sm hidden sm:inline-flex items-center gap-2">
        View All <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
      </a>
    </div>
    <div class="grid md:grid-cols-3 gap-6">
      @foreach($latestPosts as $post)
      <a href="{{ route('blog.show', $post->slug) }}" class="card overflow-hidden glass-hover group block" data-animate>
        <div class="h-40 bg-gradient-to-br from-gray-800 to-gray-900 overflow-hidden">
          @if($post->thumbnail)
            <img src="{{ asset('storage/'.$post->thumbnail) }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />
          @else
            <div class="w-full h-full flex items-center justify-center text-4xl opacity-20">📝</div>
          @endif
        </div>
        <div class="p-5">
          @if($post->category)<span class="tag text-xs mb-2 inline-block">{{ $post->category }}</span>@endif
          <h3 class="font-bold text-white leading-snug mb-2 group-hover:text-blue-400 transition-colors line-clamp-2">{{ $post->title }}</h3>
          <p class="text-gray-500 text-sm line-clamp-2 mb-3">{{ $post->excerpt }}</p>
          <div class="flex items-center gap-3 text-xs text-gray-600">
            <span>{{ $post->reading_time }}</span>
            <span>·</span>
            <span>{{ $post->published_at?->format('M d, Y') }}</span>
          </div>
        </div>
      </a>
      @endforeach
    </div>
    <div class="text-center mt-8 sm:hidden">
      <a href="{{ route('blog.index') }}" class="btn-outline">View All Articles</a>
    </div>
    @endif
  </div>
</section>
