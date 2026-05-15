<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\ContactMessage;
use App\Models\Experience;
use App\Models\PageView;
use App\Models\Project;
use App\Models\Skill;
use App\Models\Testimonial;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_visitors'  => PageView::getTotalVisitors(),
            'total_projects'  => Project::active()->count(),
            'total_posts'     => BlogPost::published()->count(),
            'total_messages'  => ContactMessage::count(),
            'unread_messages' => ContactMessage::unread()->count(),
        ];

        $recentMessages = ContactMessage::latest()->limit(5)->get();

        // Weekly Visitors Chart (last 7 days)
        $weeklyVisitors = [];
        $weeklyLabels   = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->toDateString();
            $weeklyLabels[] = Carbon::now()->subDays($i)->format('D');
            $weeklyVisitors[] = PageView::whereDate('visited_at', $date)->count();
        }

        // Skill Category Pie Chart
        $skillCategories = Skill::active()
            ->select('category', DB::raw('count(*) as total'))
            ->groupBy('category')
            ->pluck('total', 'category')
            ->toArray();

        // Synthesize Recent Activity from multiple models
        $recentProjects    = Project::latest()->limit(3)->get()->map(fn($m) => ['type' => 'project',  'icon' => '🚀', 'color' => 'blue',   'text' => "Project added: <b>{$m->title}</b>",          'time' => $m->created_at]);
        $recentPosts       = BlogPost::latest()->limit(3)->get()->map(fn($m) => ['type' => 'blog',    'icon' => '📝', 'color' => 'violet', 'text' => "Blog published: <b>{$m->title}</b>",          'time' => $m->created_at]);
        $recentMsgs        = ContactMessage::latest()->limit(3)->get()->map(fn($m) => ['type' => 'message', 'icon' => '📬', 'color' => 'orange', 'text' => "New message from <b>{$m->name}</b>",   'time' => $m->created_at]);
        $recentExperiences = Experience::latest()->limit(2)->get()->map(fn($m) => ['type' => 'exp',   'icon' => '💼', 'color' => 'emerald','text' => "Experience added: <b>{$m->position}</b>",     'time' => $m->created_at]);

        $recentActivity = $recentProjects->concat($recentPosts)->concat($recentMsgs)->concat($recentExperiences)
            ->filter(fn($a) => !is_null($a['time']))
            ->sortByDesc('time')
            ->take(8)
            ->values();

        return view('admin.dashboard', compact(
            'stats', 'recentMessages', 'weeklyLabels', 'weeklyVisitors', 'skillCategories', 'recentActivity'
        ));
    }
}
