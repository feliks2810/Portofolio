<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title', 'Dashboard') — Admin Panel</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.0/dist/cdn.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="bg-gray-950 text-gray-100 antialiased"
      x-data="{
        sidebarOpen: false,
        sidebarCollapsed: false,
        previewMode: false,
        previewDevice: 'desktop'
      }">

{{-- ── PREVIEW MODAL ─────────────────────────────────────────────────────── --}}
<div x-show="previewMode"
     x-transition:enter="transition duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition duration-200"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     class="fixed inset-0 z-[9999] bg-gray-950/95 backdrop-blur-sm flex flex-col"
     style="display:none;">
  {{-- Preview toolbar --}}
  <div class="flex items-center gap-3 px-6 h-14 bg-gray-900 border-b border-white/5 flex-shrink-0">
    <span class="font-semibold text-white text-sm">Live Preview</span>
    <div class="flex items-center gap-1 ml-4 bg-gray-800 p-1 rounded-lg">
      @foreach([['desktop','🖥 Desktop'],['tablet','⬜ Tablet'],['mobile','📱 Mobile']] as [$dev,$label])
      <button @click="previewDevice = '{{ $dev }}'"
              :class="previewDevice === '{{ $dev }}' ? 'bg-blue-600 text-white' : 'text-gray-400 hover:text-white'"
              class="px-3 py-1 rounded-md text-xs font-medium transition-all">{{ $label }}</button>
      @endforeach
    </div>
    <a href="{{ route('home') }}" target="_blank" class="ml-2 text-xs text-blue-400 hover:underline">Open full page ↗</a>
    <button @click="previewMode = false" class="ml-auto text-gray-400 hover:text-white transition-colors">
      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
    </button>
  </div>
  {{-- iframe container --}}
  <div class="flex-1 flex items-start justify-center overflow-auto py-6 px-4">
    <div class="transition-all duration-500 rounded-2xl overflow-hidden shadow-2xl shadow-black/60 border border-white/10"
         :class="{
           'w-full max-w-6xl h-[calc(100vh-6rem)]': previewDevice==='desktop',
           'w-[768px] h-[calc(100vh-6rem)]': previewDevice==='tablet',
           'w-[375px] h-[calc(100vh-6rem)]': previewDevice==='mobile'
         }">
      <iframe src="{{ route('home') }}" class="w-full h-full border-0 bg-white"></iframe>
    </div>
  </div>
</div>

<div class="flex h-screen overflow-hidden">

    {{-- Sidebar Overlay (mobile) --}}
    <div x-show="sidebarOpen" @click="sidebarOpen = false"
         class="fixed inset-0 z-20 bg-black/60 backdrop-blur-sm lg:hidden" style="display:none;"></div>

    {{-- Sidebar --}}
    <aside class="fixed inset-y-0 left-0 z-30 flex flex-col bg-gray-900 border-r border-white/5 transition-all duration-300 lg:relative lg:translate-x-0"
           :class="[sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0', sidebarCollapsed ? 'w-20' : 'w-64']">

        {{-- Logo --}}
        <div class="flex items-center h-16 px-4 border-b border-white/5 flex-shrink-0">
            <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-blue-500 to-violet-600 flex items-center justify-center text-white font-black text-sm flex-shrink-0 shadow-lg shadow-blue-500/25">YFH</div>
            <div x-show="!sidebarCollapsed" x-transition:enter="transition duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" class="ml-3 min-w-0">
                <p class="font-bold text-white text-sm truncate">Admin Panel</p>
                <p class="text-gray-500 text-xs truncate">Portfolio CMS</p>
            </div>
            <button @click="sidebarCollapsed = !sidebarCollapsed" class="ml-auto hidden lg:flex items-center justify-center w-7 h-7 rounded-lg text-gray-500 hover:text-white hover:bg-white/5 transition-all flex-shrink-0">
                <svg class="w-4 h-4 transition-transform duration-300" :class="sidebarCollapsed ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7"/></svg>
            </button>
        </div>

        {{-- Admin Info --}}
        <div x-show="!sidebarCollapsed" x-transition class="px-4 py-3 border-b border-white/5">
            <div class="flex items-center gap-3">
                <div class="relative flex-shrink-0">
                    <img src="{{ auth()->user()->avatar_url }}" alt="avatar" class="w-9 h-9 rounded-full object-cover ring-2 ring-blue-500/30" />
                    <span class="absolute bottom-0 right-0 w-2.5 h-2.5 bg-green-400 rounded-full border-2 border-gray-900"></span>
                </div>
                <div class="min-w-0">
                    <p class="text-sm font-semibold text-white truncate">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-gray-500 truncate">Administrator</p>
                </div>
            </div>
        </div>

        {{-- Navigation --}}
        <nav class="flex-1 overflow-y-auto py-4 px-2 space-y-0.5">
            @php
            $navItems = [
                ['route' => 'admin.dashboard',        'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6', 'label' => 'Dashboard'],
                ['route' => 'admin.settings.index',   'icon' => 'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z M15 12a3 3 0 11-6 0 3 3 0 016 0z', 'label' => 'Settings/CMS'],
                ['route' => 'admin.projects.index',   'icon' => 'M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10', 'label' => 'Projects'],
                ['route' => 'admin.experiences.index','icon' => 'M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z', 'label' => 'Experience'],
                ['route' => 'admin.skills.index',     'icon' => 'M13 10V3L4 14h7v7l9-11h-7z', 'label' => 'Skills'],
                ['route' => 'admin.blog.index',       'icon' => 'M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z', 'label' => 'Blog'],
                ['route' => 'admin.testimonials.index','icon' => 'M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z', 'label' => 'Testimonials'],
                ['route' => 'admin.messages.index',   'icon' => 'M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z', 'label' => 'Inbox'],
                ['route' => 'admin.profile.edit',     'icon' => 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z', 'label' => 'Profile'],
            ];
            @endphp

            @foreach($navItems as $item)
            @php $isActive = request()->routeIs(str_replace('.index', '.*', $item['route'])) @endphp
            <a href="{{ route($item['route']) }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all group relative"
               :class="'{{ $isActive ? 'bg-blue-600/20 text-blue-400 shadow-inner' : 'text-gray-400 hover:text-white hover:bg-white/5' }}'">
                <svg class="w-5 h-5 flex-shrink-0 transition-colors {{ $isActive ? 'text-blue-400' : 'text-gray-500 group-hover:text-gray-300' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $item['icon'] }}"/>
                </svg>
                <span x-show="!sidebarCollapsed" class="truncate">{{ $item['label'] }}</span>
                @if($item['route'] === 'admin.messages.index')
                    @php $unread = \App\Models\ContactMessage::unread()->count() @endphp
                    @if($unread > 0)
                    <span x-show="!sidebarCollapsed" class="ml-auto text-xs bg-red-500 text-white px-1.5 py-0.5 rounded-full font-bold">{{ $unread }}</span>
                    <span x-show="sidebarCollapsed" class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full" style="display:none;"></span>
                    @endif
                @endif
                {{-- Tooltip when collapsed --}}
                <div x-show="sidebarCollapsed"
                     class="absolute left-full ml-2.5 px-2.5 py-1.5 bg-gray-800 border border-white/10 text-white text-xs rounded-lg whitespace-nowrap opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none z-50 shadow-xl"
                     style="display:none;">
                    {{ $item['label'] }}
                </div>
            </a>
            @endforeach
        </nav>

        {{-- Logout --}}
        <div class="p-2 border-t border-white/5 flex-shrink-0">
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-gray-400 hover:text-red-400 hover:bg-red-500/10 transition-all w-full group relative">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    <span x-show="!sidebarCollapsed">Logout</span>
                    <div x-show="sidebarCollapsed" class="absolute left-full ml-2.5 px-2.5 py-1.5 bg-gray-800 border border-white/10 text-white text-xs rounded-lg whitespace-nowrap opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none z-50" style="display:none;">Logout</div>
                </button>
            </form>
        </div>
    </aside>

    {{-- Main Content --}}
    <div class="flex-1 flex flex-col overflow-hidden min-w-0">
        {{-- Top Bar --}}
        <header class="h-16 bg-gray-900/50 backdrop-blur border-b border-white/5 flex items-center gap-4 px-6 flex-shrink-0">
            <button @click="sidebarOpen = !sidebarOpen" class="lg:hidden text-gray-400 hover:text-white transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
            </button>

            <div class="flex-1 min-w-0">
                <h1 class="text-base font-semibold text-white truncate">@yield('title', 'Dashboard')</h1>
                <p class="text-xs text-gray-600">@yield('breadcrumb', 'Admin Panel')</p>
            </div>

            <div class="flex items-center gap-2">
                {{-- Preview Button --}}
                <button @click="previewMode = true"
                        class="hidden md:flex items-center gap-2 px-3 py-1.5 bg-violet-600/20 hover:bg-violet-600/30 border border-violet-500/20 rounded-lg text-xs text-violet-400 hover:text-violet-300 transition-all">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    Preview
                </button>

                <a href="{{ route('home') }}" target="_blank" class="flex items-center gap-1.5 px-3 py-1.5 bg-white/5 hover:bg-white/10 rounded-lg text-xs text-gray-400 hover:text-white transition-all">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    View Site
                </a>
            </div>
        </header>

        {{-- Flash Messages --}}
        @if(session('success'))
        <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 4000)"
             class="mx-6 mt-4 px-4 py-3 bg-green-500/10 border border-green-500/20 rounded-xl text-green-400 text-sm flex items-center gap-2">
            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            {{ session('success') }}
        </div>
        @endif
        @if(session('error'))
        <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 5000)"
             class="mx-6 mt-4 px-4 py-3 bg-red-500/10 border border-red-500/20 rounded-xl text-red-400 text-sm flex items-center gap-2">
            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            {{ session('error') }}
        </div>
        @endif

        {{-- Page Content --}}
        <main class="flex-1 overflow-y-auto">
            <div class="p-6">
                @yield('content')
            </div>
        </main>
    </div>
</div>

@stack('scripts')
</body>
</html>
