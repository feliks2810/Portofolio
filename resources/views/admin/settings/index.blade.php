@extends('layouts.admin')
@section('title','CMS Settings')
@section('breadcrumb','Site Builder')
@section('content')

<div x-data="{ activeTab: 'general' }">

  {{-- Tab Navigation --}}
  <div class="flex gap-1 overflow-x-auto mb-6 bg-gray-900/50 p-1 rounded-xl border border-white/5 scrollbar-hide">
    @foreach([
      ['general',  '⚙️',  'General'],
      ['hero',     '🌟',  'Hero Section'],
      ['about',    '👤',  'About Me'],
      ['contact',  '📩',  'Contact'],
      ['social',   '🔗',  'Social Links'],
      ['seo',      '🔍',  'SEO'],
    ] as [$key, $icon, $label])
    <button @click="activeTab = '{{ $key }}'"
            :class="activeTab === '{{ $key }}'
              ? 'bg-blue-600 text-white shadow-lg shadow-blue-500/20'
              : 'text-gray-400 hover:text-white hover:bg-white/5'"
            class="flex items-center gap-2 px-4 py-2 rounded-lg text-sm font-medium transition-all whitespace-nowrap flex-shrink-0">
      <span>{{ $icon }}</span>
      {{ $label }}
    </button>
    @endforeach
  </div>

  <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
    @csrf

    @if($errors->any())
    <div class="mb-5 p-4 bg-red-500/10 border border-red-500/20 rounded-xl">
      @foreach($errors->all() as $e)<p class="text-red-400 text-sm">• {{ $e }}</p>@endforeach
    </div>
    @endif

    {{-- ─── GENERAL ──────────────────────────────────────────────────────────── --}}
    <div x-show="activeTab === 'general'" class="space-y-6">
      <div class="card p-6">
        <h3 class="font-bold text-white mb-5 flex items-center gap-2"><span class="w-2 h-2 rounded-full bg-blue-500 inline-block"></span>Site Identity</h3>
        <div class="grid sm:grid-cols-2 gap-5">
          @foreach($settings['general'] ?? [] as $s)
          <div class="{{ in_array($s->type, ['textarea']) ? 'sm:col-span-2' : '' }}">
            <label class="form-label">{{ $s->label ?? $s->key }}</label>
            @if($s->type === 'image')
              <div class="space-y-3">
                @if($s->value)
                <div class="flex items-center gap-3 p-3 bg-gray-800/50 rounded-xl border border-white/5">
                  <img src="{{ asset('storage/'.$s->value) }}" class="h-14 w-auto rounded-lg object-cover" />
                  <div>
                    <p class="text-xs text-green-400 font-medium">✓ Image uploaded</p>
                    <p class="text-xs text-gray-500 mt-0.5">Upload new to replace</p>
                  </div>
                </div>
                @endif
                <input type="file" name="{{ $s->key }}" accept="image/*"
                       class="block w-full text-sm text-gray-400 file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:bg-blue-600 file:text-white file:cursor-pointer hover:file:bg-blue-700 transition-all" />
              </div>
            @elseif($s->type === 'file')
              <div class="space-y-3">
                @if($s->value)<p class="text-xs text-green-400 flex items-center gap-1.5"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>File uploaded: {{ basename($s->value) }}</p>@endif
                <input type="file" name="{{ $s->key }}" accept=".pdf,.doc,.docx"
                       class="block w-full text-sm text-gray-400 file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:bg-violet-600 file:text-white file:cursor-pointer" />
              </div>
            @else
              <input type="text" name="{{ $s->key }}" value="{{ $s->value }}" class="form-input" />
            @endif
          </div>
          @endforeach
        </div>
      </div>
    </div>

    {{-- ─── HERO ─────────────────────────────────────────────────────────────── --}}
    <div x-show="activeTab === 'hero'" class="space-y-6">
      <div class="card p-6">
        <h3 class="font-bold text-white mb-1 flex items-center gap-2"><span class="w-2 h-2 rounded-full bg-yellow-500 inline-block"></span>Hero Section</h3>
        <p class="text-gray-500 text-xs mb-5">This controls the big title section at the top of your portfolio.</p>
        <div class="grid sm:grid-cols-2 gap-5">
          @foreach($settings['hero'] ?? [] as $s)
          <div class="{{ $s->type === 'textarea' ? 'sm:col-span-2' : '' }}">
            <label class="form-label">{{ $s->label ?? $s->key }}</label>
            @if($s->type === 'textarea')
              <textarea name="{{ $s->key }}" rows="3" class="form-textarea">{{ $s->value }}</textarea>
            @else
              <input type="text" name="{{ $s->key }}" value="{{ $s->value }}" class="form-input" />
            @endif
            @if($s->key === 'hero_roles')<p class="text-xs text-gray-600 mt-1.5">Separate each role with a comma. Example: <em class="text-gray-500">Laravel Developer, Fullstack Developer</em></p>@endif
          </div>
          @endforeach
        </div>
      </div>
    </div>

    {{-- ─── ABOUT ────────────────────────────────────────────────────────────── --}}
    <div x-show="activeTab === 'about'" class="space-y-6">
      <div class="card p-6">
        <h3 class="font-bold text-white mb-1 flex items-center gap-2"><span class="w-2 h-2 rounded-full bg-emerald-500 inline-block"></span>About Me Section</h3>
        <p class="text-gray-500 text-xs mb-5">Controls the About Me section content and education details.</p>
        <div class="grid sm:grid-cols-2 gap-5">
          @foreach($settings['about'] ?? [] as $s)
          <div class="{{ $s->type === 'textarea' ? 'sm:col-span-2' : '' }}">
            <label class="form-label">{{ $s->label ?? $s->key }}</label>
            @if($s->type === 'textarea')
              <textarea name="{{ $s->key }}" rows="5" class="form-textarea">{{ $s->value }}</textarea>
            @else
              <input type="text" name="{{ $s->key }}" value="{{ $s->value }}" class="form-input" />
            @endif
          </div>
          @endforeach
        </div>
      </div>
    </div>

    {{-- ─── CONTACT ──────────────────────────────────────────────────────────── --}}
    <div x-show="activeTab === 'contact'" class="space-y-6">
      <div class="card p-6">
        <h3 class="font-bold text-white mb-1 flex items-center gap-2"><span class="w-2 h-2 rounded-full bg-orange-500 inline-block"></span>Contact Information</h3>
        <p class="text-gray-500 text-xs mb-5">Displayed in the Contact section of your portfolio.</p>
        <div class="grid sm:grid-cols-2 gap-5">
          @foreach($settings['contact'] ?? [] as $s)
          <div>
            <label class="form-label">{{ $s->label ?? $s->key }}</label>
            <input type="text" name="{{ $s->key }}" value="{{ $s->value }}" class="form-input" />
          </div>
          @endforeach
        </div>
      </div>
    </div>

    {{-- ─── SOCIAL ───────────────────────────────────────────────────────────── --}}
    <div x-show="activeTab === 'social'" class="space-y-6">
      <div class="card p-6">
        <h3 class="font-bold text-white mb-1 flex items-center gap-2"><span class="w-2 h-2 rounded-full bg-pink-500 inline-block"></span>Social Media Links</h3>
        <p class="text-gray-500 text-xs mb-5">Enter the full URL for each platform.</p>
        <div class="grid sm:grid-cols-2 gap-5">
          @foreach($settings['social'] ?? [] as $s)
          <div>
            <label class="form-label flex items-center gap-1.5">
              @if(str_contains($s->key,'github'))🐙 @elseif(str_contains($s->key,'linkedin'))💼 @elseif(str_contains($s->key,'instagram'))📸 @elseif(str_contains($s->key,'whatsapp'))💬 @else🔗 @endif
              {{ $s->label ?? $s->key }}
            </label>
            <input type="text" name="{{ $s->key }}" value="{{ $s->value }}" class="form-input" placeholder="https://..." />
          </div>
          @endforeach
        </div>
      </div>
    </div>

    {{-- ─── SEO ──────────────────────────────────────────────────────────────── --}}
    <div x-show="activeTab === 'seo'" class="space-y-6">
      <div class="card p-6">
        <h3 class="font-bold text-white mb-1 flex items-center gap-2"><span class="w-2 h-2 rounded-full bg-cyan-500 inline-block"></span>SEO & Meta Tags</h3>
        <p class="text-gray-500 text-xs mb-5">Helps your portfolio rank better on Google.</p>
        <div class="space-y-5">
          @foreach($settings['seo'] ?? [] as $s)
          <div>
            <label class="form-label">{{ $s->label ?? $s->key }}</label>
            @if($s->type === 'textarea')
              <textarea name="{{ $s->key }}" rows="3" class="form-textarea">{{ $s->value }}</textarea>
            @else
              <input type="text" name="{{ $s->key }}" value="{{ $s->value }}" class="form-input" />
            @endif
          </div>
          @endforeach
        </div>
      </div>
    </div>

    {{-- Save Button (always visible) --}}
    <div class="flex justify-end gap-3 mt-6">
      <button type="submit" class="btn-primary px-8">
        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
        Save All Settings
      </button>
    </div>
  </form>
</div>
@endsection
