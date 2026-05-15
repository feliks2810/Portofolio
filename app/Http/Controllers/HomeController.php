<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\Experience;
use App\Models\PageView;
use App\Models\Project;
use App\Models\Setting;
use App\Models\Skill;
use App\Models\Testimonial;

class HomeController extends Controller
{
    public function index()
    {
        // Track page view
        PageView::recordVisit('home');

        $projects = Project::active()->orderBy('sort_order')->orderBy('is_featured', 'desc')->get();
        $skills = Skill::active()->orderBy('category')->orderBy('sort_order')->get()->groupBy('category');
        $experiences = Experience::active()->orderBy('sort_order')->orderByDesc('start_date')->get();
        $testimonials = Testimonial::active()->orderBy('sort_order')->get();
        $latestPosts = BlogPost::published()->orderByDesc('published_at')->limit(3)->get();

        $settings = Setting::all()->pluck('value', 'key')->toArray();

        return view('portfolio.home', compact(
            'projects', 'skills', 'experiences', 'testimonials', 'latestPosts', 'settings'
        ));
    }
}
