@extends('layouts.admin')
@section('title', isset($blog) ? 'Edit Post' : 'New Post')
@section('content')
@php 
  $blog = $blog ?? null;
  $isEdit = !is_null($blog); 
  $action = $isEdit ? route('admin.blog.update',$blog) : route('admin.blog.store'); 
@endphp
<div class="max-w-4xl">
  <div class="flex items-center gap-3 mb-6">
    <a href="{{ route('admin.blog.index') }}" class="text-gray-500 hover:text-white">← Back</a>
    <h2 class="text-xl font-bold text-white">{{ $isEdit ? 'Edit Post' : 'New Post' }}</h2>
  </div>
  @if($errors->any())<div class="mb-5 p-4 bg-red-500/10 border border-red-500/20 rounded-xl">@foreach($errors->all() as $e)<p class="text-red-400 text-sm">• {{ $e }}</p>@endforeach</div>@endif
  <form action="{{ $action }}" method="POST" enctype="multipart/form-data" class="space-y-6">
    @csrf @if($isEdit) @method('PUT') @endif
    <div class="card p-6 space-y-4">
      <div><label class="form-label">Title *</label><input type="text" name="title" value="{{ old('title',$blog->title??'') }}" required class="form-input" /></div>
      
      <div><label class="form-label">Excerpt (Brief summary)</label><textarea name="excerpt" rows="2" class="form-textarea">{{ old('excerpt',$blog->excerpt??'') }}</textarea></div>
      
      <div><label class="form-label">Content *</label><textarea name="content" rows="15" required class="form-textarea">{{ old('content',$blog->content??'') }}</textarea></div>
      
      <div class="grid sm:grid-cols-2 gap-4">
        <div><label class="form-label">Thumbnail</label><input type="file" name="thumbnail" accept="image/*" class="form-input" />
          @if($isEdit && $blog?->thumbnail)<div class="mt-2 text-xs text-blue-400"><a href="{{ asset('storage/'.$blog->thumbnail) }}" target="_blank">View current thumbnail</a></div>@endif
        </div>
        <div><label class="form-label">Category</label><input type="text" name="category" value="{{ old('category',$blog->category??'') }}" class="form-input" /></div>
      </div>
      
      <div class="grid sm:grid-cols-2 gap-4">
        <div><label class="form-label">Tags <span class="text-xs text-gray-500">(comma-separated)</span></label><input type="text" name="tags" value="{{ old('tags', $isEdit ? implode(', ',$blog->tags??[]) : '') }}" class="form-input" /></div>
        <div><label class="form-label">Status *</label>
          <select name="status" class="form-select">
            <option value="draft" {{ old('status',$blog->status??'draft')==='draft' ? 'selected' : '' }}>Draft</option>
            <option value="published" {{ old('status',$blog->status??'draft')==='published' ? 'selected' : '' }}>Published</option>
          </select>
        </div>
      </div>
    </div>

    <div class="card p-6 space-y-4">
      <h3 class="font-bold text-white mb-2">SEO Settings</h3>
      <div><label class="form-label">Meta Title</label><input type="text" name="meta_title" value="{{ old('meta_title',$blog->meta_title??'') }}" class="form-input" /></div>
      <div><label class="form-label">Meta Description</label><textarea name="meta_description" rows="2" class="form-textarea">{{ old('meta_description',$blog->meta_description??'') }}</textarea></div>
    </div>

    <div class="flex gap-3">
      <button type="submit" class="btn-primary">{{ $isEdit ? 'Update' : 'Publish' }} Post</button>
      <a href="{{ route('admin.blog.index') }}" class="btn-outline">Cancel</a>
    </div>
  </form>
</div>
@endsection
