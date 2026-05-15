@extends('layouts.admin')
@section('title','Messages')
@section('content')
<div class="flex justify-between items-center mb-6">
  <h2 class="text-xl font-bold text-white">Inbox</h2>
</div>
<div class="card overflow-hidden">
  <table class="w-full text-left border-collapse">
    <thead>
      <tr class="bg-gray-800/50 text-gray-400 text-sm border-b border-white/5">
        <th class="p-4 font-medium">Status</th>
        <th class="p-4 font-medium">Sender</th>
        <th class="p-4 font-medium">Subject</th>
        <th class="p-4 font-medium">Date</th>
        <th class="p-4 font-medium text-right">Actions</th>
      </tr>
    </thead>
    <tbody class="divide-y divide-white/5 text-sm">
      @forelse($messages as $msg)
      <tr class="hover:bg-white/[0.02] transition-colors {{ !$msg->is_read ? 'bg-blue-900/10' : '' }}">
        <td class="p-4">
          @if(!$msg->is_read)
          <span class="w-2.5 h-2.5 rounded-full bg-blue-500 inline-block shadow-[0_0_8px_rgba(59,130,246,0.5)]"></span>
          @else
          <span class="w-2 h-2 rounded-full bg-gray-600 inline-block"></span>
          @endif
        </td>
        <td class="p-4">
          <div class="font-medium text-gray-200">{{ $msg->name }}</div>
          <div class="text-gray-500 text-xs">{{ $msg->email }}</div>
        </td>
        <td class="p-4 text-gray-300">{{ $msg->subject ?? 'No Subject' }}</td>
        <td class="p-4 text-gray-500 text-xs">{{ $msg->created_at->diffForHumans() }}</td>
        <td class="p-4 text-right flex justify-end gap-2">
          <a href="{{ route('admin.messages.show',$msg) }}" class="text-blue-400 hover:text-blue-300">View</a>
          <form action="{{ route('admin.messages.destroy',$msg) }}" method="POST" onsubmit="return confirm('Delete message?')">
            @csrf @method('DELETE')
            <button class="text-red-400 hover:text-red-300 ml-2">Delete</button>
          </form>
        </td>
      </tr>
      @empty
      <tr><td colspan="5">
        <div class="flex flex-col items-center justify-center py-16 text-center">
          <div class="w-20 h-20 rounded-2xl bg-gray-800/50 flex items-center justify-center text-4xl mb-4">📭</div>
          <h3 class="font-bold text-white mb-1">Your inbox is empty</h3>
          <p class="text-gray-500 text-sm">New messages from your contact form will appear here</p>
        </div>
      </td></tr>
      @endforelse
    </tbody>
  </table>
</div>
<div class="mt-4">{{ $messages->links() }}</div>
@endsection
