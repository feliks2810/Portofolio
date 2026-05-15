@extends('layouts.admin')
@section('title','My Profile')
@section('content')
<div class="max-w-4xl">
  <div class="mb-6"><h2 class="text-xl font-bold text-white">My Profile</h2></div>
  @if($errors->any())<div class="mb-5 p-4 bg-red-500/10 border border-red-500/20 rounded-xl">@foreach($errors->all() as $e)<p class="text-red-400 text-sm">• {{ $e }}</p>@endforeach</div>@endif
  @if(session('success'))<div class="mb-5 p-4 bg-green-500/10 border border-green-500/20 rounded-xl text-green-400 text-sm">{{ session('success') }}</div>@endif
  
  <div class="grid md:grid-cols-2 gap-6">
    <!-- Profile Info -->
    <div class="card p-6">
      <h3 class="font-bold text-white mb-4">Profile Information</h3>
      <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        <div>
          <label class="form-label">Avatar</label>
          <div class="flex items-center gap-4">
            @if($user->avatar)
            <img src="{{ asset('storage/'.$user->avatar) }}" class="w-16 h-16 rounded-full object-cover">
            @else
            <div class="w-16 h-16 rounded-full bg-gray-800 flex items-center justify-center text-gray-400 font-bold text-xl">{{ substr($user->name,0,1) }}</div>
            @endif
            <input type="file" name="avatar" accept="image/*" class="form-input text-sm">
          </div>
        </div>
        <div><label class="form-label">Name</label><input type="text" name="name" value="{{ old('name',$user->name) }}" required class="form-input" /></div>
        <div><label class="form-label">Email</label><input type="email" name="email" value="{{ old('email',$user->email) }}" required class="form-input" /></div>
        <div class="pt-2"><button type="submit" class="btn-primary">Save Profile</button></div>
      </form>
    </div>

    <!-- Password -->
    <div class="card p-6">
      <h3 class="font-bold text-white mb-4">Change Password</h3>
      <form action="{{ route('admin.profile.password') }}" method="POST" class="space-y-4">
        @csrf
        <div><label class="form-label">Current Password</label><input type="password" name="current_password" required class="form-input" /></div>
        <div><label class="form-label">New Password</label><input type="password" name="password" required class="form-input" /></div>
        <div><label class="form-label">Confirm Password</label><input type="password" name="password_confirmation" required class="form-input" /></div>
        <div class="pt-2"><button type="submit" class="btn-primary">Update Password</button></div>
      </form>
    </div>
  </div>
</div>
@endsection
