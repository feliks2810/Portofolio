@extends('layouts.admin')
@section('title', isset($experience) ? 'Edit Experience' : 'New Experience')
@section('content')
@php 
  $experience = $experience ?? null;
  $isEdit = !is_null($experience); 
  $action = $isEdit ? route('admin.experiences.update',$experience) : route('admin.experiences.store'); 
@endphp
<div class="max-w-2xl">
  <div class="flex items-center gap-3 mb-6">
    <a href="{{ route('admin.experiences.index') }}" class="text-gray-500 hover:text-white">← Back</a>
    <h2 class="text-xl font-bold text-white">{{ $isEdit ? 'Edit Experience' : 'New Experience' }}</h2>
  </div>
  @if($errors->any())<div class="mb-5 p-4 bg-red-500/10 border border-red-500/20 rounded-xl">@foreach($errors->all() as $e)<p class="text-red-400 text-sm">• {{ $e }}</p>@endforeach</div>@endif
  <form action="{{ $action }}" method="POST" class="card p-6 space-y-4">
    @csrf @if($isEdit) @method('PUT') @endif
    <div class="grid sm:grid-cols-2 gap-4">
      <div><label class="form-label">Company *</label><input type="text" name="company" value="{{ old('company',$experience->company??'') }}" required class="form-input" /></div>
      <div><label class="form-label">Position *</label><input type="text" name="position" value="{{ old('position',$experience->position??'') }}" required class="form-input" /></div>
    </div>
    <div class="grid sm:grid-cols-2 gap-4">
      <div><label class="form-label">Type</label>
        <select name="type" class="form-select">
          @foreach(['internship','fulltime','parttime','freelance'] as $t)
          <option value="{{ $t }}" {{ old('type',$experience->type??'internship')===$t ? 'selected' : '' }}>{{ ucfirst($t) }}</option>
          @endforeach
        </select></div>
      <div><label class="form-label">Location</label><input type="text" name="location" value="{{ old('location',$experience->location??'') }}" class="form-input" /></div>
    </div>
    <div><label class="form-label">Description</label><textarea name="description" rows="3" class="form-textarea">{{ old('description',$experience->description??'') }}</textarea></div>
    <div><label class="form-label">Responsibilities <span class="text-gray-600 text-xs">(one per line)</span></label>
      <textarea name="responsibilities" rows="5" class="form-textarea" placeholder="Task 1&#10;Task 2">{{ old('responsibilities', $isEdit ? implode("\n",$experience->responsibilities??[]) : '') }}</textarea></div>
    <div><label class="form-label">Tech Stack <span class="text-gray-600 text-xs">(comma-separated)</span></label>
      <input type="text" name="tech_stack" value="{{ old('tech_stack', $isEdit ? implode(', ',$experience->tech_stack??[]) : '') }}" class="form-input" /></div>
    <div class="grid sm:grid-cols-2 gap-4">
      <div><label class="form-label">Start Date *</label><input type="date" name="start_date" value="{{ old('start_date',$experience?->start_date?->format('Y-m-d')??'') }}" required class="form-input" /></div>
      <div><label class="form-label">End Date</label><input type="date" name="end_date" value="{{ old('end_date',$experience?->end_date?->format('Y-m-d')??'') }}" class="form-input" /></div>
    </div>
    <div class="flex gap-6">
      <label class="flex items-center gap-2 cursor-pointer"><input type="checkbox" name="is_current" value="1" {{ old('is_current',$experience->is_current??false) ? 'checked' : '' }} class="w-4 h-4 rounded border-white/10 bg-gray-800 text-blue-600" /><span class="text-sm text-gray-300">Currently working here</span></label>
      <label class="flex items-center gap-2 cursor-pointer"><input type="checkbox" name="is_active" value="1" {{ old('is_active',$experience->is_active??true) ? 'checked' : '' }} class="w-4 h-4 rounded border-white/10 bg-gray-800 text-blue-600" /><span class="text-sm text-gray-300">Active</span></label>
    </div>
    <div class="flex gap-3 pt-2">
      <button type="submit" class="btn-primary">{{ $isEdit ? 'Update' : 'Create' }} Experience</button>
      <a href="{{ route('admin.experiences.index') }}" class="btn-outline">Cancel</a>
    </div>
  </form>
</div>
@endsection
