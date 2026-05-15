@extends('layouts.admin')
@section('title','Testimonials')
@section('content')
<div class="flex justify-between items-center mb-6">
  <h2 class="text-xl font-bold text-white">Testimonials</h2>
  <a href="{{ route('admin.testimonials.create') }}" class="btn-primary text-sm">+ Add Testimonial</a>
</div>
<div class="grid md:grid-cols-2 gap-4">
  @forelse($testimonials as $t)
  <div class="card p-5">
    <div class="flex items-center gap-3 mb-3">
      @if($t->avatar)
      <img src="{{ asset('storage/'.$t->avatar) }}" class="w-12 h-12 rounded-full object-cover">
      @else
      <div class="w-12 h-12 rounded-full bg-gray-800 flex items-center justify-center text-gray-400 font-bold">{{ substr($t->name,0,1) }}</div>
      @endif
      <div class="flex-1 min-w-0">
        <h3 class="font-bold text-white text-sm">{{ $t->name }}</h3>
        <p class="text-gray-500 text-xs">{{ $t->position }} {{ $t->company ? 'at '.$t->company : '' }}</p>
      </div>
      <div class="text-yellow-500 text-sm flex-shrink-0">★ {{ $t->rating }}</div>
    </div>
    <p class="text-gray-400 text-sm italic mb-4 line-clamp-3">"{{ $t->content }}"</p>
    <div class="flex gap-2 border-t border-white/5 pt-3">
      <a href="{{ route('admin.testimonials.edit',$t) }}" class="text-xs px-3 py-1.5 bg-blue-600/20 text-blue-400 rounded-lg hover:bg-blue-600/30">Edit</a>
      <form action="{{ route('admin.testimonials.destroy',$t) }}" method="POST" onsubmit="return confirm('Delete?')">
        @csrf @method('DELETE')
        <button class="text-xs px-3 py-1.5 bg-red-600/10 text-red-400 rounded-lg hover:bg-red-600/20">Delete</button>
      </form>
    </div>
  </div>
  @empty
  <div class="col-span-2 text-center text-gray-500 py-16 card"><a href="{{ route('admin.testimonials.create') }}" class="text-blue-400">Add first testimonial</a></div>
  @endforelse
</div>
@endsection
