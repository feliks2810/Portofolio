<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\PageView;

class BlogController extends Controller
{
    public function index()
    {
        PageView::recordVisit('blog');
        $posts = BlogPost::published()
            ->orderByDesc('published_at')
            ->paginate(9);

        return view('blog.index', compact('posts'));
    }

    public function show(string $slug)
    {
        $post = BlogPost::published()->where('slug', $slug)->firstOrFail();
        $post->incrementViewCount();

        $related = BlogPost::published()
            ->where('id', '!=', $post->id)
            ->where('category', $post->category)
            ->limit(3)
            ->get();

        return view('blog.show', compact('post', 'related'));
    }
}
