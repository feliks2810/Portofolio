<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function index()
    {
        $skills = Skill::orderBy('category')->orderBy('sort_order')->get()->groupBy('category');
        return view('admin.skills.index', compact('skills'));
    }

    public function create()
    {
        return view('admin.skills.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'       => 'required|string|max:100',
            'category'   => 'required|in:frontend,backend,database,ai,tools',
            'level'      => 'required|integer|min:1|max:100',
            'icon'       => 'nullable|string|max:100',
            'sort_order' => 'nullable|integer',
            'is_active'  => 'boolean',
        ]);

        Skill::create([...$validated, 'is_active' => $request->boolean('is_active', true)]);

        return redirect()->route('admin.skills.index')->with('success', 'Skill added!');
    }

    public function edit(Skill $skill)
    {
        return view('admin.skills.edit', compact('skill'));
    }

    public function update(Request $request, Skill $skill)
    {
        $validated = $request->validate([
            'name'       => 'required|string|max:100',
            'category'   => 'required|in:frontend,backend,database,ai,tools',
            'level'      => 'required|integer|min:1|max:100',
            'icon'       => 'nullable|string|max:100',
            'sort_order' => 'nullable|integer',
            'is_active'  => 'boolean',
        ]);

        $skill->update([...$validated, 'is_active' => $request->boolean('is_active', true)]);

        return redirect()->route('admin.skills.index')->with('success', 'Skill updated!');
    }

    public function destroy(Skill $skill)
    {
        $skill->delete();
        return redirect()->route('admin.skills.index')->with('success', 'Skill deleted!');
    }
}
