<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    public function index()
    {
        $experiences = Experience::orderBy('sort_order')->orderByDesc('start_date')->get();
        return view('admin.experiences.index', compact('experiences'));
    }

    public function create()
    {
        return view('admin.experiences.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'company'          => 'required|string|max:255',
            'position'         => 'required|string|max:255',
            'description'      => 'nullable|string',
            'responsibilities' => 'nullable|string',
            'location'         => 'nullable|string|max:255',
            'type'             => 'required|in:internship,fulltime,parttime,freelance',
            'tech_stack'       => 'nullable|string',
            'start_date'       => 'required|date',
            'end_date'         => 'nullable|date|after:start_date',
            'is_current'       => 'boolean',
            'sort_order'       => 'nullable|integer',
            'is_active'        => 'boolean',
        ]);

        Experience::create([
            ...$validated,
            'responsibilities' => $validated['responsibilities'] ? array_map('trim', explode("\n", $validated['responsibilities'])) : [],
            'tech_stack'       => $validated['tech_stack'] ? array_map('trim', explode(',', $validated['tech_stack'])) : [],
            'is_current'       => $request->boolean('is_current'),
            'is_active'        => $request->boolean('is_active', true),
        ]);

        return redirect()->route('admin.experiences.index')->with('success', 'Experience added successfully!');
    }

    public function edit(Experience $experience)
    {
        return view('admin.experiences.edit', compact('experience'));
    }

    public function update(Request $request, Experience $experience)
    {
        $validated = $request->validate([
            'company'          => 'required|string|max:255',
            'position'         => 'required|string|max:255',
            'description'      => 'nullable|string',
            'responsibilities' => 'nullable|string',
            'location'         => 'nullable|string|max:255',
            'type'             => 'required|in:internship,fulltime,parttime,freelance',
            'tech_stack'       => 'nullable|string',
            'start_date'       => 'required|date',
            'end_date'         => 'nullable|date',
            'is_current'       => 'boolean',
            'sort_order'       => 'nullable|integer',
            'is_active'        => 'boolean',
        ]);

        $experience->update([
            ...$validated,
            'responsibilities' => $validated['responsibilities'] ? array_map('trim', explode("\n", $validated['responsibilities'])) : [],
            'tech_stack'       => $validated['tech_stack'] ? array_map('trim', explode(',', $validated['tech_stack'])) : [],
            'is_current'       => $request->boolean('is_current'),
            'is_active'        => $request->boolean('is_active', true),
        ]);

        return redirect()->route('admin.experiences.index')->with('success', 'Experience updated successfully!');
    }

    public function destroy(Experience $experience)
    {
        $experience->delete();
        return redirect()->route('admin.experiences.index')->with('success', 'Experience deleted!');
    }
}
