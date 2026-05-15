@extends('layouts.admin')
@section('title', isset($skill) ? 'Edit Skill' : 'New Skill')
@section('content')
@php $isEdit = isset($skill); $action = $isEdit ? route('admin.skills.update',$skill) : route('admin.skills.store'); @endphp
<div class="max-w-lg">
  <div class="flex items-center gap-3 mb-6">
    <a href="{{ route('admin.skills.index') }}" class="text-gray-500 hover:text-white">← Back</a>
    <h2 class="text-xl font-bold text-white">{{ $isEdit ? 'Edit Skill' : 'New Skill' }}</h2>
  </div>
  <form action="{{ $action }}" method="POST" class="card p-6 space-y-4">
    @csrf @if($isEdit) @method('PUT') @endif
    <div><label class="form-label">Skill Name *</label><input type="text" name="name" value="{{ old('name',$skill->name??'') }}" required class="form-input" /></div>
    <div><label class="form-label">Category *</label>
      <select name="category" class="form-select">
        @foreach(['frontend','backend','database','ai','tools'] as $cat)
        <option value="{{ $cat }}" {{ old('category',$skill->category??'')===$cat ? 'selected' : '' }}>{{ ucfirst($cat) }}</option>
        @endforeach
      </select></div>
    <div><label class="form-label">Proficiency Level: <span id="level-val" class="text-blue-400">{{ old('level',$skill->level??80) }}%</span></label>
      <input type="range" name="level" min="1" max="100" value="{{ old('level',$skill->level??80) }}" class="w-full accent-blue-500 mt-2" oninput="document.getElementById('level-val').textContent=this.value+'%'" /></div>
    <div><label class="form-label">Sort Order</label><input type="number" name="sort_order" value="{{ old('sort_order',$skill->sort_order??0) }}" class="form-input" /></div>
    <label class="flex items-center gap-2 cursor-pointer"><input type="checkbox" name="is_active" value="1" {{ old('is_active',$skill->is_active??true) ? 'checked' : '' }} class="w-4 h-4 rounded border-white/10 bg-gray-800 text-blue-600" /><span class="text-sm text-gray-300">Active</span></label>
    <div class="flex gap-3 pt-2">
      <button type="submit" class="btn-primary">{{ $isEdit ? 'Update' : 'Create' }} Skill</button>
      <a href="{{ route('admin.skills.index') }}" class="btn-outline">Cancel</a>
    </div>
  </form>
</div>
@endsection
