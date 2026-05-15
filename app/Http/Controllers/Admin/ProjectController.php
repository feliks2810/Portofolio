<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $query = Project::query();

        if ($search = $request->search) {
            $query->where(fn($q) => $q->where('title', 'like', "%{$search}%")
                                      ->orWhere('description', 'like', "%{$search}%")
                                      ->orWhere('category', 'like', "%{$search}%"));
        }

        if ($request->status === 'active')   $query->where('is_active', true);
        if ($request->status === 'inactive') $query->where('is_active', false);
        if ($request->status === 'featured') $query->where('is_featured', true);

        $projects = $query->orderBy('sort_order')->orderByDesc('created_at')->paginate(12)->withQueryString();

        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('admin.projects.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'            => 'required|string|max:255',
            'description'      => 'required|string',
            'long_description' => 'nullable|string',
            'category'         => 'nullable|string|max:100',
            'tech_stack'       => 'nullable|string',
            'features'         => 'nullable|string',
            'thumbnail'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'gallery.*'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'demo_url'         => 'nullable|url|max:500',
            'github_url'       => 'nullable|url|max:500',
            'sort_order'       => 'nullable|integer',
            'is_featured'      => 'boolean',
            'is_active'        => 'boolean',
        ]);

        $slug = Str::slug($validated['title']);
        $count = Project::where('slug', 'like', $slug . '%')->count();
        if ($count > 0) {
            $slug = $slug . '-' . ($count + 1);
        }

        $data = [
            ...$validated,
            'slug' => $slug,
            'tech_stack' => $validated['tech_stack'] ? array_map('trim', explode(',', $validated['tech_stack'])) : [],
            'features' => $validated['features'] ? array_map('trim', explode("\n", $validated['features'])) : [],
            'is_featured' => $request->boolean('is_featured'),
            'is_active' => $request->boolean('is_active', true),
        ];

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('projects', 'public');
        }

        if ($request->hasFile('gallery')) {
            $gallery = [];
            foreach ($request->file('gallery') as $file) {
                $gallery[] = $file->store('projects/gallery', 'public');
            }
            $data['gallery'] = $gallery;
        }

        Project::create($data);

        return redirect()->route('admin.projects.index')->with('success', 'Project created successfully!');
    }

    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title'            => 'required|string|max:255',
            'description'      => 'required|string',
            'long_description' => 'nullable|string',
            'category'         => 'nullable|string|max:100',
            'tech_stack'       => 'nullable|string',
            'features'         => 'nullable|string',
            'thumbnail'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'gallery.*'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'demo_url'         => 'nullable|url|max:500',
            'github_url'       => 'nullable|url|max:500',
            'sort_order'       => 'nullable|integer',
            'is_featured'      => 'boolean',
            'is_active'        => 'boolean',
        ]);

        $data = [
            ...$validated,
            'tech_stack' => $validated['tech_stack'] ? array_map('trim', explode(',', $validated['tech_stack'])) : [],
            'features' => $validated['features'] ? array_map('trim', explode("\n", $validated['features'])) : [],
            'is_featured' => $request->boolean('is_featured'),
            'is_active' => $request->boolean('is_active', true),
        ];

        if ($request->hasFile('thumbnail')) {
            if ($project->thumbnail) {
                Storage::disk('public')->delete($project->thumbnail);
            }
            $data['thumbnail'] = $request->file('thumbnail')->store('projects', 'public');
        }

        if ($request->hasFile('gallery')) {
            if ($project->gallery) {
                foreach ($project->gallery as $img) {
                    Storage::disk('public')->delete($img);
                }
            }
            $gallery = [];
            foreach ($request->file('gallery') as $file) {
                $gallery[] = $file->store('projects/gallery', 'public');
            }
            $data['gallery'] = $gallery;
        }

        $project->update($data);

        return redirect()->route('admin.projects.index')->with('success', 'Project updated successfully!');
    }

    public function destroy(Project $project)
    {
        if ($project->thumbnail) {
            Storage::disk('public')->delete($project->thumbnail);
        }
        if ($project->gallery) {
            foreach ($project->gallery as $img) {
                Storage::disk('public')->delete($img);
            }
        }
        $project->delete();

        return redirect()->route('admin.projects.index')->with('success', 'Project deleted successfully!');
    }
}
