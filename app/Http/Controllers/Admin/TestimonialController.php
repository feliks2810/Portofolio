<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::orderBy('sort_order')->get();
        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        return view('admin.testimonials.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'       => 'required|string|max:255',
            'position'   => 'nullable|string|max:255',
            'company'    => 'nullable|string|max:255',
            'avatar'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:1024',
            'content'    => 'required|string|max:2000',
            'rating'     => 'required|integer|min:1|max:5',
            'sort_order' => 'nullable|integer',
            'is_active'  => 'boolean',
        ]);

        if ($request->hasFile('avatar')) {
            $validated['avatar'] = $request->file('avatar')->store('testimonials', 'public');
        }

        Testimonial::create([...$validated, 'is_active' => $request->boolean('is_active', true)]);

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial added!');
    }

    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $validated = $request->validate([
            'name'       => 'required|string|max:255',
            'position'   => 'nullable|string|max:255',
            'company'    => 'nullable|string|max:255',
            'avatar'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:1024',
            'content'    => 'required|string|max:2000',
            'rating'     => 'required|integer|min:1|max:5',
            'sort_order' => 'nullable|integer',
            'is_active'  => 'boolean',
        ]);

        if ($request->hasFile('avatar')) {
            if ($testimonial->avatar) {
                Storage::disk('public')->delete($testimonial->avatar);
            }
            $validated['avatar'] = $request->file('avatar')->store('testimonials', 'public');
        }

        $testimonial->update([...$validated, 'is_active' => $request->boolean('is_active', true)]);

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial updated!');
    }

    public function destroy(Testimonial $testimonial)
    {
        if ($testimonial->avatar) {
            Storage::disk('public')->delete($testimonial->avatar);
        }
        $testimonial->delete();
        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial deleted!');
    }
}
