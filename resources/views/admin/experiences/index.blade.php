@extends('layouts.admin')
@section('title','Experience')
@section('content')
<div class="flex justify-between items-center mb-6">
  <h2 class="text-xl font-bold text-white">Experience Timeline</h2>
  <a href="{{ route('admin.experiences.create') }}" class="btn-primary text-sm">+ Add Experience</a>
</div>
<div class="space-y-4">
  @forelse($experiences as $exp)
  <div class="card p-5 flex items-start gap-4">
    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-500 to-violet-600 flex items-center justify-center text-white font-bold text-sm flex-shrink-0">{{ substr($exp->company,0,2) }}</div>
    <div class="flex-1 min-w-0">
      <div class="flex flex-wrap gap-2 items-center mb-1">
        <h3 class="font-bold text-white">{{ $exp->position }}</h3>
        <span class="tag capitalize">{{ $exp->type }}</span>
        <span class="text-xs px-2 py-0.5 rounded-full {{ $exp->is_active ? 'bg-green-500/10 text-green-400' : 'bg-gray-500/10 text-gray-400' }}">{{ $exp->is_active ? 'Active' : 'Hidden' }}</span>
      </div>
      <p class="text-blue-400 text-sm">{{ $exp->company }}</p>
      <p class="text-gray-500 text-xs mt-0.5">{{ $exp->duration }} {{ $exp->location ? '· '.$exp->location : '' }}</p>
    </div>
    <div class="flex gap-2 flex-shrink-0">
      <a href="{{ route('admin.experiences.edit',$exp) }}" class="text-xs px-3 py-1.5 bg-blue-600/20 text-blue-400 rounded-lg hover:bg-blue-600/30">Edit</a>
      <form action="{{ route('admin.experiences.destroy',$exp) }}" method="POST" onsubmit="return confirm('Delete?')">
        @csrf @method('DELETE')
        <button class="text-xs px-3 py-1.5 bg-red-600/10 text-red-400 rounded-lg hover:bg-red-600/20">Delete</button>
      </form>
    </div>
  </div>
  @empty
  <div class="text-center text-gray-500 py-16 card"><a href="{{ route('admin.experiences.create') }}" class="text-blue-400">Add your first experience →</a></div>
  @endforelse
</div>
@endsection
