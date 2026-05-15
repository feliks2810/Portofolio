@extends('layouts.admin')
@section('title','Read Message')
@section('content')
<div class="max-w-3xl">
  <div class="flex items-center gap-3 mb-6">
    <a href="{{ route('admin.messages.index') }}" class="text-gray-500 hover:text-white">← Back to Inbox</a>
  </div>
  <div class="card p-6 md:p-8">
    <div class="flex justify-between items-start border-b border-white/5 pb-6 mb-6">
      <div>
        <h2 class="text-2xl font-bold text-white mb-1">{{ $message->subject ?? 'No Subject' }}</h2>
        <div class="text-gray-400 text-sm">From: <span class="text-gray-200">{{ $message->name }}</span> &lt;<a href="mailto:{{ $message->email }}" class="text-blue-400 hover:underline">{{ $message->email }}</a>&gt;</div>
      </div>
      <div class="text-gray-500 text-sm text-right">
        <div>{{ $message->created_at->format('M d, Y') }}</div>
        <div>{{ $message->created_at->format('h:i A') }}</div>
      </div>
    </div>
    <div class="text-gray-300 leading-relaxed whitespace-pre-wrap">{{ $message->message }}</div>
    <div class="mt-10 pt-6 border-t border-white/5 flex gap-3">
      <a href="mailto:{{ $message->email }}" class="btn-primary">Reply via Email</a>
      <form action="{{ route('admin.messages.destroy',$message) }}" method="POST" onsubmit="return confirm('Delete message?')">
        @csrf @method('DELETE')
        <button class="btn-outline text-red-400 hover:bg-red-500/10 border-red-500/20">Delete</button>
      </form>
    </div>
  </div>
</div>
@endsection
