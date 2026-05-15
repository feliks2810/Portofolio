@extends('layouts.admin')
@section('title','Blog Posts')
@section('content')
<div class="flex justify-between items-center mb-6">
  <h2 class="text-xl font-bold text-white">Blog Posts</h2>
  <a href="{{ route('admin.blog.create') }}" class="btn-primary text-sm">+ Write Post</a>
</div>
<div class="space-y-4">
  @forelse($posts as $post)
  <div class="card p-5 flex items-center gap-4">
    @if($post->thumbnail)
    <img src="{{ asset('storage/'.$post->thumbnail) }}" class="w-16 h-16 rounded-xl object-cover flex-shrink-0">
    @else
    <div class="w-16 h-16 rounded-xl bg-gray-800 flex items-center justify-center text-gray-500 flex-shrink-0">📝</div>
    @endif
    <div class="flex-1 min-w-0">
      <div class="flex flex-wrap items-center gap-2 mb-1">
        <h3 class="font-bold text-white truncate">{{ $post->title }}</h3>
        <span class="text-xs px-2 py-0.5 rounded-full {{ $post->status==='published' ? 'bg-green-500/10 text-green-400' : 'bg-yellow-500/10 text-yellow-400' }}">{{ ucfirst($post->status) }}</span>
      </div>
      <p class="text-gray-400 text-sm truncate">{{ $post->excerpt ?? strip_tags(substr($post->content,0,100)).'...' }}</p>
      <div class="flex items-center gap-3 mt-1 text-xs text-gray-500">
        <span>{{ $post->category ?? 'Uncategorized' }}</span>
        <span>·</span>
        <span>{{ $post->created_at->format('M d, Y') }}</span>
        <span>·</span>
        <span>👁 {{ $post->views ?? 0 }} views</span>
      </div>
    </div>
    <div class="flex gap-2 flex-shrink-0">
      <a href="{{ route('admin.blog.edit',$post) }}" class="text-xs px-3 py-1.5 bg-blue-600/20 text-blue-400 rounded-lg hover:bg-blue-600/30">Edit</a>
      <form action="{{ route('admin.blog.destroy',$post) }}" method="POST" onsubmit="return confirm('Delete?')">
        @csrf @method('DELETE')
        <button class="text-xs px-3 py-1.5 bg-red-600/10 text-red-400 rounded-lg hover:bg-red-600/20">Delete</button>
      </form>
    </div>
  </div>
  @empty
  <div class="flex flex-col items-center justify-center py-16 text-center">
    <div class="w-20 h-20 rounded-2xl bg-gray-800/50 flex items-center justify-center text-4xl mb-4">📝</div>
    <h3 class="font-bold text-white mb-1">No blog posts yet</h3>
    <p class="text-gray-500 text-sm mb-4">Share your knowledge and insights with the world</p>
    <a href="{{ route('admin.blog.create') }}" class="btn-primary text-sm">+ Write First Article</a>
  </div>
  @endforelse
</div>
<div class="mt-4">{{ $posts->links() }}</div>
@endsection
