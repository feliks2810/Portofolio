@extends('layouts.admin')
@section('title', isset($project) ? 'Edit Project' : 'New Project')
@section('content')

@php $isEdit = isset($project); $action = $isEdit ? route('admin.projects.update',$project) : route('admin.projects.store'); @endphp

<div class="max-w-3xl">
  <div class="flex items-center gap-3 mb-6">
    <a href="{{ route('admin.projects.index') }}" class="text-gray-500 hover:text-white transition-colors">← Back</a>
    <h2 class="text-xl font-bold text-white">{{ $isEdit ? 'Edit: '.$project->title : 'New Project' }}</h2>
  </div>

  @if($errors->any())
  <div class="mb-5 p-4 bg-red-500/10 border border-red-500/20 rounded-xl">
    @foreach($errors->all() as $err)<p class="text-red-400 text-sm">• {{ $err }}</p>@endforeach
  </div>
  @endif

  <form action="{{ $action }}" method="POST" enctype="multipart/form-data" class="space-y-5">
    @csrf @if($isEdit) @method('PUT') @endif

    <div class="card p-6 space-y-5">
      <div><label class="form-label">Title *</label>
        <input type="text" name="title" value="{{ old('title',$project->title??'') }}" required class="form-input" placeholder="My Awesome Project" /></div>

      <div><label class="form-label">Short Description *</label>
        <textarea name="description" rows="3" required class="form-textarea" placeholder="Brief description...">{{ old('description',$project->description??'') }}</textarea></div>

      <div><label class="form-label">Long Description</label>
        <textarea name="long_description" rows="5" class="form-textarea" placeholder="Detailed description for modal...">{{ old('long_description',$project->long_description??'') }}</textarea></div>

      <div class="grid sm:grid-cols-2 gap-4">
        <div><label class="form-label">Category</label>
          <input type="text" name="category" value="{{ old('category',$project->category??'') }}" class="form-input" placeholder="Web Application" /></div>
        <div><label class="form-label">Sort Order</label>
          <input type="number" name="sort_order" value="{{ old('sort_order',$project->sort_order??0) }}" class="form-input" /></div>
      </div>

      <div><label class="form-label">Tech Stack <span class="text-gray-600 text-xs">(comma-separated)</span></label>
        <input type="text" name="tech_stack" value="{{ old('tech_stack', $isEdit ? implode(', ',$project->tech_stack??[]) : '') }}" class="form-input" placeholder="Laravel, Vue 3, MySQL" /></div>

      <div><label class="form-label">Features <span class="text-gray-600 text-xs">(one per line)</span></label>
        <textarea name="features" rows="4" class="form-textarea" placeholder="Feature 1&#10;Feature 2&#10;Feature 3">{{ old('features', $isEdit ? implode("\n",$project->features??[]) : '') }}</textarea></div>

      <div class="grid sm:grid-cols-2 gap-4">
        <div><label class="form-label">Demo URL</label>
          <input type="url" name="demo_url" value="{{ old('demo_url',$project->demo_url??'') }}" class="form-input" placeholder="https://..." /></div>
        <div><label class="form-label">GitHub URL</label>
          <input type="url" name="github_url" value="{{ old('github_url',$project->github_url??'') }}" class="form-input" placeholder="https://github.com/..." /></div>
      </div>

      <div><label class="form-label">Thumbnail</label>
        @if($isEdit && $project->thumbnail)
        <img src="{{ asset('storage/'.$project->thumbnail) }}" class="h-24 rounded-lg mb-2 object-cover" />
        @endif
        <input type="file" name="thumbnail" accept="image/*" class="form-input text-gray-400 file:mr-3 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:bg-blue-600 file:text-white file:cursor-pointer" /></div>

      <div><label class="form-label">Gallery Images <span class="text-gray-600 text-xs">(multiple)</span></label>
        <input type="file" name="gallery[]" accept="image/*" multiple class="form-input text-gray-400 file:mr-3 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:bg-blue-600 file:text-white file:cursor-pointer" /></div>

      <div class="flex gap-6">
        <label class="flex items-center gap-2 cursor-pointer">
          <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $project->is_featured??false) ? 'checked' : '' }} class="w-4 h-4 rounded border-white/10 bg-gray-800 text-blue-600" />
          <span class="text-sm text-gray-300">Featured project</span>
        </label>
        <label class="flex items-center gap-2 cursor-pointer">
          <input type="checkbox" name="is_active" value="1" {{ old('is_active', $project->is_active??true) ? 'checked' : '' }} class="w-4 h-4 rounded border-white/10 bg-gray-800 text-blue-600" />
          <span class="text-sm text-gray-300">Active (visible)</span>
        </label>
      </div>
    </div>

    <div class="flex gap-3">
      <button type="submit" class="btn-primary">{{ $isEdit ? 'Update Project' : 'Create Project' }}</button>
      <a href="{{ route('admin.projects.index') }}" class="btn-outline">Cancel</a>
    </div>
  </form>
</div>
@endsection
