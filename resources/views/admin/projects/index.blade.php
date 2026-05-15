@extends('layouts.admin')
@section('title','Projects')
@section('breadcrumb','Manage your portfolio projects')
@section('content')

{{-- Header & Search Bar --}}
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
  <div>
    <h2 class="text-xl font-bold text-white">All Projects</h2>
    <p class="text-gray-500 text-sm mt-0.5">{{ $projects->total() }} total projects</p>
  </div>
  <a href="{{ route('admin.projects.create') }}" class="btn-primary text-sm flex-shrink-0">+ Add Project</a>
</div>

{{-- Search & Filter Bar --}}
<form method="GET" action="{{ route('admin.projects.index') }}" class="flex flex-col sm:flex-row gap-3 mb-6">
  <div class="relative flex-1">
    <svg class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search projects by title, category..." class="form-input pl-10 w-full" />
  </div>
  <select name="status" class="form-select w-full sm:w-44">
    <option value="">All Status</option>
    <option value="active"   {{ request('status')==='active'   ? 'selected':'' }}>Active</option>
    <option value="inactive" {{ request('status')==='inactive' ? 'selected':'' }}>Hidden</option>
    <option value="featured" {{ request('status')==='featured' ? 'selected':'' }}>Featured</option>
  </select>
  <button type="submit" class="btn-primary text-sm flex-shrink-0">Filter</button>
  @if(request('search') || request('status'))
  <a href="{{ route('admin.projects.index') }}" class="btn-outline text-sm flex-shrink-0">Clear</a>
  @endif
</form>

{{-- Table --}}
<div class="card overflow-hidden">
  <table class="admin-table">
    <thead>
      <tr>
        <th>Project</th>
        <th>Category</th>
        <th>Featured</th>
        <th>Status</th>
        <th class="text-right">Actions</th>
      </tr>
    </thead>
    <tbody>
      @forelse($projects as $project)
      <tr class="group hover:bg-white/[0.015] transition-colors">
        <td>
          <div class="flex items-center gap-3">
            <div class="w-12 h-10 rounded-lg overflow-hidden bg-gray-800 flex-shrink-0 border border-white/5">
              @if($project->thumbnail)
              <img src="{{ asset('storage/'.$project->thumbnail) }}" class="w-full h-full object-cover" />
              @else
              <div class="w-full h-full flex items-center justify-center text-lg">🚀</div>
              @endif
            </div>
            <div>
              <p class="font-medium text-white group-hover:text-blue-300 transition-colors">{{ $project->title }}</p>
              <p class="text-xs text-gray-600">{{ $project->slug }}</p>
            </div>
          </div>
        </td>
        <td><span class="tag">{{ $project->category ?? '—' }}</span></td>
        <td>
          @if($project->is_featured)
          <span class="text-xs bg-yellow-500/10 text-yellow-400 px-2 py-0.5 rounded-full font-medium">⭐ Featured</span>
          @else
          <span class="text-gray-600">—</span>
          @endif
        </td>
        <td>
          <span class="text-xs px-2.5 py-1 rounded-full font-medium {{ $project->is_active ? 'bg-green-500/10 text-green-400' : 'bg-gray-500/10 text-gray-400' }}">
            {{ $project->is_active ? '● Active' : '○ Hidden' }}
          </span>
        </td>
        <td class="text-right">
          <div class="flex gap-2 justify-end">
            <a href="{{ route('admin.projects.edit', $project) }}" class="text-xs px-3 py-1.5 bg-blue-600/20 text-blue-400 rounded-lg hover:bg-blue-600/30 transition-colors">Edit</a>
            <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" onsubmit="return confirm('Delete this project?')">
              @csrf @method('DELETE')
              <button class="text-xs px-3 py-1.5 bg-red-600/10 text-red-400 rounded-lg hover:bg-red-600/20 transition-colors">Delete</button>
            </form>
          </div>
        </td>
      </tr>
      @empty
      <tr>
        <td colspan="5">
          <div class="flex flex-col items-center justify-center py-16 text-center">
            <div class="w-20 h-20 rounded-2xl bg-gray-800/50 flex items-center justify-center text-4xl mb-4">🚀</div>
            <h3 class="font-bold text-white mb-1">
              @if(request('search') || request('status'))
                No projects match your filter
              @else
                No projects yet
              @endif
            </h3>
            <p class="text-gray-500 text-sm mb-4">
              @if(request('search') || request('status'))
                Try clearing your search or filter
              @else
                Add your first project to showcase your work
              @endif
            </p>
            @if(request('search') || request('status'))
            <a href="{{ route('admin.projects.index') }}" class="text-blue-400 text-sm hover:underline">Clear filters</a>
            @else
            <a href="{{ route('admin.projects.create') }}" class="btn-primary text-sm">+ Add First Project</a>
            @endif
          </div>
        </td>
      </tr>
      @endforelse
    </tbody>
  </table>
  @if($projects->hasPages())
  <div class="p-4 border-t border-white/5">{{ $projects->links() }}</div>
  @endif
</div>

@endsection
