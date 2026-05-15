@extends('layouts.admin')
@section('title','Skills')
@section('content')
<div class="flex justify-between items-center mb-6">
  <h2 class="text-xl font-bold text-white">Skills Management</h2>
  <a href="{{ route('admin.skills.create') }}" class="btn-primary text-sm">+ Add Skill</a>
</div>
@foreach($skills as $cat => $catSkills)
<div class="mb-6">
  <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-3">{{ ucfirst($cat) }} ({{ count($catSkills) }})</h3>
  <div class="card overflow-hidden">
    <table class="admin-table">
      <thead><tr><th>Skill</th><th>Level</th><th>Active</th><th>Actions</th></tr></thead>
      <tbody>
        @foreach($catSkills as $skill)
        <tr>
          <td class="font-medium text-white">{{ $skill['name'] }}</td>
          <td>
            <div class="flex items-center gap-2">
              <div class="w-24 progress-bar"><div class="progress-fill" data-level="{{ $skill['level'] }}" style="width:{{ $skill['level'] }}%"></div></div>
              <span class="text-xs text-gray-500">{{ $skill['level'] }}%</span>
            </div>
          </td>
          <td>{{ $skill['is_active'] ? '✅' : '❌' }}</td>
          <td>
            <div class="flex gap-2">
              <a href="{{ route('admin.skills.edit',$skill['id']) }}" class="text-xs px-3 py-1.5 bg-blue-600/20 text-blue-400 rounded-lg hover:bg-blue-600/30">Edit</a>
              <form action="{{ route('admin.skills.destroy',$skill['id']) }}" method="POST" onsubmit="return confirm('Delete?')">
                @csrf @method('DELETE')
                <button class="text-xs px-3 py-1.5 bg-red-600/10 text-red-400 rounded-lg hover:bg-red-600/20">Delete</button>
              </form>
            </div>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endforeach
@endsection
