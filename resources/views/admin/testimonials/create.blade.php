@extends('layouts.admin')
@section('title', isset($testimonial) ? 'Edit Testimonial' : 'New Testimonial')
@section('content')
@php 
  $testimonial = $testimonial ?? null;
  $isEdit = !is_null($testimonial); 
  $action = $isEdit ? route('admin.testimonials.update',$testimonial) : route('admin.testimonials.store'); 
@endphp
<div class="max-w-2xl">
  <div class="flex items-center gap-3 mb-6">
    <a href="{{ route('admin.testimonials.index') }}" class="text-gray-500 hover:text-white">← Back</a>
    <h2 class="text-xl font-bold text-white">{{ $isEdit ? 'Edit Testimonial' : 'New Testimonial' }}</h2>
  </div>
  @if($errors->any())<div class="mb-5 p-4 bg-red-500/10 border border-red-500/20 rounded-xl">@foreach($errors->all() as $e)<p class="text-red-400 text-sm">• {{ $e }}</p>@endforeach</div>@endif
  <form action="{{ $action }}" method="POST" enctype="multipart/form-data" class="card p-6 space-y-4">
    @csrf @if($isEdit) @method('PUT') @endif
    <div class="grid sm:grid-cols-2 gap-4">
      <div><label class="form-label">Name *</label><input type="text" name="name" value="{{ old('name',$testimonial->name??'') }}" required class="form-input" /></div>
      <div><label class="form-label">Avatar</label><input type="file" name="avatar" class="form-input" accept="image/*" />
        @if($isEdit && $testimonial?->avatar)<div class="mt-2 text-xs text-blue-400"><a href="{{ asset('storage/'.$testimonial->avatar) }}" target="_blank">View current avatar</a></div>@endif
      </div>
    </div>
    <div class="grid sm:grid-cols-2 gap-4">
      <div><label class="form-label">Position</label><input type="text" name="position" value="{{ old('position',$testimonial->position??'') }}" class="form-input" /></div>
      <div><label class="form-label">Company</label><input type="text" name="company" value="{{ old('company',$testimonial->company??'') }}" class="form-input" /></div>
    </div>
    <div><label class="form-label">Content *</label><textarea name="content" rows="4" required class="form-textarea">{{ old('content',$testimonial->content??'') }}</textarea></div>
    <div class="grid sm:grid-cols-2 gap-4">
      <div><label class="form-label">Rating (1-5) *</label><input type="number" name="rating" min="1" max="5" value="{{ old('rating',$testimonial->rating??5) }}" required class="form-input" /></div>
      <div><label class="form-label">Sort Order</label><input type="number" name="sort_order" value="{{ old('sort_order',$testimonial->sort_order??0) }}" class="form-input" /></div>
    </div>
    <div class="flex gap-6">
      <label class="flex items-center gap-2 cursor-pointer"><input type="checkbox" name="is_active" value="1" {{ old('is_active',$testimonial->is_active??true) ? 'checked' : '' }} class="w-4 h-4 rounded border-white/10 bg-gray-800 text-blue-600" /><span class="text-sm text-gray-300">Active</span></label>
    </div>
    <div class="flex gap-3 pt-2">
      <button type="submit" class="btn-primary">{{ $isEdit ? 'Update' : 'Create' }}</button>
      <a href="{{ route('admin.testimonials.index') }}" class="btn-outline">Cancel</a>
    </div>
  </form>
</div>
@endsection
