@extends('layouts.admin')
@section('title','Dashboard')
@section('breadcrumb','Overview & Analytics')
@section('content')

{{-- Welcome Header --}}
<div class="mb-8 flex items-center justify-between">
  <div>
    <h2 class="text-2xl font-black text-white">Welcome back, {{ explode(' ', auth()->user()->name)[0] }} 👋</h2>
    <p class="text-gray-500 text-sm mt-0.5">{{ now()->format('l, d F Y') }} · <span class="inline-flex items-center gap-1.5"><span class="w-1.5 h-1.5 rounded-full bg-green-400 animate-pulse inline-block"></span><span class="text-green-400">Online</span></span></p>
  </div>
  <div class="flex gap-2">
    <a href="{{ route('admin.projects.create') }}" class="btn-primary text-sm hidden sm:inline-flex">+ Quick Add Project</a>
    <a href="{{ route('home') }}" target="_blank" class="px-3 py-2 bg-white/5 hover:bg-white/10 rounded-lg text-xs text-gray-400 hover:text-white transition-all flex items-center gap-1.5">
      <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
      Preview Site
    </a>
  </div>
</div>

{{-- Stats Grid --}}
<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
  @php
  $cards = [
    ['label'=>'Total Visitors','value'=>$stats['total_visitors'],'icon'=>'👁️','color'=>'from-blue-500 to-cyan-500','change'=>'+12%'],
    ['label'=>'Active Projects','value'=>$stats['total_projects'],'icon'=>'🚀','color'=>'from-violet-500 to-purple-600','change'=>null],
    ['label'=>'Blog Posts','value'=>$stats['total_posts'],'icon'=>'📝','color'=>'from-emerald-500 to-teal-500','change'=>null],
    ['label'=>'Messages','value'=>$stats['total_messages'],'icon'=>'📬','color'=>'from-orange-500 to-red-500','change'=>$stats['unread_messages'] > 0 ? $stats['unread_messages'].' unread' : null],
  ];
  @endphp
  @foreach($cards as $card)
  <div class="stat-card group transition-all duration-300 hover:-translate-y-1 hover:shadow-xl hover:shadow-blue-500/10 cursor-default">
    <div class="flex items-center justify-between mb-3">
      <div class="w-11 h-11 rounded-xl bg-gradient-to-br {{ $card['color'] }} flex items-center justify-center text-xl shadow-lg">{{ $card['icon'] }}</div>
      @if($card['change'])
      <span class="text-xs {{ $card['label']==='Messages' ? 'bg-red-500/20 text-red-400' : 'bg-green-500/10 text-green-400' }} px-2 py-0.5 rounded-full font-medium">{{ $card['change'] }}</span>
      @endif
    </div>
    <p class="text-3xl font-black text-white tracking-tight">{{ number_format($card['value']) }}</p>
    <p class="text-gray-400 text-sm mt-1">{{ $card['label'] }}</p>
    <div class="mt-3 h-0.5 bg-gradient-to-r {{ $card['color'] }} opacity-30 rounded-full group-hover:opacity-60 transition-opacity"></div>
  </div>
  @endforeach
</div>

{{-- Charts Row --}}
<div class="grid lg:grid-cols-3 gap-6 mb-8">
  {{-- Weekly Visitors Line Chart --}}
  <div class="lg:col-span-2 card p-6">
    <div class="flex items-center justify-between mb-6">
      <div>
        <h3 class="font-bold text-white">Visitor Analytics</h3>
        <p class="text-gray-500 text-xs mt-0.5">Last 7 days</p>
      </div>
      <div class="w-8 h-8 rounded-lg bg-blue-500/10 flex items-center justify-center">
        <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"/></svg>
      </div>
    </div>
    <canvas id="visitorsChart" height="120"></canvas>
  </div>

  {{-- Skill Pie Chart --}}
  <div class="card p-6">
    <div class="flex items-center justify-between mb-6">
      <div>
        <h3 class="font-bold text-white">Skills</h3>
        <p class="text-gray-500 text-xs mt-0.5">By category</p>
      </div>
      <div class="w-8 h-8 rounded-lg bg-violet-500/10 flex items-center justify-center">
        <svg class="w-4 h-4 text-violet-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"/></svg>
      </div>
    </div>
    @if(!empty($skillCategories))
    <canvas id="skillsChart" height="170"></canvas>
    @else
    <div class="flex flex-col items-center justify-center h-40 text-center">
      <div class="text-4xl mb-3">⚡</div>
      <p class="text-gray-500 text-sm">No skills added yet</p>
      <a href="{{ route('admin.skills.index') }}" class="text-blue-400 text-xs hover:underline mt-1">Add skills →</a>
    </div>
    @endif
  </div>
</div>

{{-- Bottom: Quick Actions + Recent Activity --}}
<div class="grid lg:grid-cols-5 gap-6">

  {{-- Quick Actions --}}
  <div class="lg:col-span-2 space-y-4">
    <h2 class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Quick Actions</h2>
    <div class="grid grid-cols-2 gap-3">
      @foreach([
        ['admin.projects.create', 'New Project', '🚀', 'hover:border-blue-500/40'],
        ['admin.blog.create',     'New Post',    '📝', 'hover:border-violet-500/40'],
        ['admin.experiences.create','Add Exp',   '💼', 'hover:border-emerald-500/40'],
        ['admin.skills.index',    'Manage Skills','⚡','hover:border-yellow-500/40'],
        ['admin.testimonials.create','Add Review','💬','hover:border-pink-500/40'],
        ['admin.settings.index',  'Edit CMS',    '⚙️', 'hover:border-gray-500/40'],
      ] as [$route, $label, $icon, $hov])
      <a href="{{ route($route) }}" class="flex items-center gap-2.5 p-3.5 glass rounded-xl border border-white/5 {{ $hov }} transition-all group">
        <span class="text-xl leading-none">{{ $icon }}</span>
        <span class="text-xs font-medium text-gray-400 group-hover:text-white transition-colors leading-tight">{{ $label }}</span>
      </a>
      @endforeach
    </div>

    {{-- Messages Snapshot --}}
    @if($recentMessages->isNotEmpty())
    <div class="mt-2">
      <div class="flex items-center justify-between mb-3">
        <h2 class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Recent Messages</h2>
        <a href="{{ route('admin.messages.index') }}" class="text-xs text-blue-400 hover:text-blue-300">All →</a>
      </div>
      <div class="space-y-2">
        @foreach($recentMessages->take(3) as $msg)
        <a href="{{ route('admin.messages.show', $msg) }}" class="flex items-center gap-3 p-3 glass rounded-xl hover:bg-white/5 transition-all group">
          <div class="w-8 h-8 rounded-full bg-gradient-to-br from-orange-500 to-red-500 flex items-center justify-center text-white text-xs font-bold flex-shrink-0">{{ strtoupper(substr($msg->name, 0, 1)) }}</div>
          <div class="flex-1 min-w-0">
            <p class="text-sm text-white truncate font-medium">{{ $msg->name }}</p>
            <p class="text-xs text-gray-500 truncate">{{ $msg->subject ?: 'No subject' }}</p>
          </div>
          @if(!$msg->is_read)<span class="w-2 h-2 rounded-full bg-blue-500 flex-shrink-0"></span>@endif
        </a>
        @endforeach
      </div>
    </div>
    @endif
  </div>

  {{-- Recent Activity Timeline --}}
  <div class="lg:col-span-3">
    <h2 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-4">Recent Activity</h2>
    @if($recentActivity->isNotEmpty())
    <div class="card p-5 space-y-0">
      @foreach($recentActivity as $index => $activity)
      @php
        $colorMap = ['blue'=>'bg-blue-500','violet'=>'bg-violet-500','orange'=>'bg-orange-500','emerald'=>'bg-emerald-500'];
        $dotColor = $colorMap[$activity['color']] ?? 'bg-gray-500';
      @endphp
      <div class="flex gap-4 {{ !$loop->last ? 'pb-4 border-b border-white/5' : '' }} {{ !$loop->first ? 'pt-4' : '' }}">
        <div class="flex flex-col items-center flex-shrink-0">
          <div class="w-9 h-9 rounded-xl glass flex items-center justify-center text-base">{{ $activity['icon'] }}</div>
          @if(!$loop->last)<div class="w-px flex-1 bg-white/5 mt-2"></div>@endif
        </div>
        <div class="flex-1 min-w-0 pt-1.5">
          <p class="text-sm text-gray-300 leading-snug">{!! $activity['text'] !!}</p>
          <p class="text-xs text-gray-600 mt-1">{{ $activity['time']?->diffForHumans() }}</p>
        </div>
        <div class="flex-shrink-0 pt-2">
          <div class="w-2 h-2 rounded-full {{ $dotColor }} opacity-60"></div>
        </div>
      </div>
      @endforeach
    </div>
    @else
    <div class="card p-8 text-center">
      <div class="text-5xl mb-3">🌟</div>
      <p class="text-gray-400 font-medium">All quiet here</p>
      <p class="text-gray-600 text-sm mt-1">Start adding content to see your activity</p>
    </div>
    @endif
  </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
Chart.defaults.color = '#6b7280';
Chart.defaults.borderColor = 'rgba(255,255,255,0.05)';

// Weekly Visitors Line Chart
const visitorsCtx = document.getElementById('visitorsChart');
if (visitorsCtx) {
  new Chart(visitorsCtx, {
    type: 'line',
    data: {
      labels: @json($weeklyLabels),
      datasets: [{
        label: 'Visitors',
        data: @json($weeklyVisitors),
        borderColor: '#3b82f6',
        backgroundColor: 'rgba(59,130,246,0.08)',
        borderWidth: 2.5,
        pointBackgroundColor: '#3b82f6',
        pointRadius: 4,
        pointHoverRadius: 6,
        fill: true,
        tension: 0.4,
      }]
    },
    options: {
      responsive: true,
      plugins: { legend: { display: false } },
      scales: {
        x: { grid: { color: 'rgba(255,255,255,0.04)' } },
        y: { beginAtZero: true, grid: { color: 'rgba(255,255,255,0.04)' }, ticks: { stepSize: 1 } }
      }
    }
  });
}

// Skills Doughnut Chart
const skillsCtx = document.getElementById('skillsChart');
if (skillsCtx) {
  const skillData = @json($skillCategories);
  const palette = ['#3b82f6','#8b5cf6','#10b981','#f59e0b','#ef4444','#06b6d4'];
  new Chart(skillsCtx, {
    type: 'doughnut',
    data: {
      labels: Object.keys(skillData),
      datasets: [{
        data: Object.values(skillData),
        backgroundColor: palette,
        borderColor: 'rgba(10,10,30,0.8)',
        borderWidth: 3,
        hoverOffset: 8,
      }]
    },
    options: {
      responsive: true,
      cutout: '65%',
      plugins: {
        legend: { position: 'bottom', labels: { padding: 12, boxWidth: 10, font: { size: 11 } } }
      }
    }
  });
}
</script>
@endpush
