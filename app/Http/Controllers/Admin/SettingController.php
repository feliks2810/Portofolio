<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::orderBy('group')->orderBy('key')->get()->groupBy('group');
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $data = $request->except(['_token', '_method']);

        foreach ($data as $key => $value) {
            if ($request->hasFile($key)) {
                $file = $request->file($key);
                $path = $file->store("settings/{$key}", 'public');
                Setting::set($key, $path);
            } else {
                Setting::set($key, $value);
            }
        }

        // Handle file uploads separately
        foreach ($request->allFiles() as $key => $file) {
            // Delete old file
            $oldPath = Setting::get($key);
            if ($oldPath && Storage::disk('public')->exists($oldPath)) {
                Storage::disk('public')->delete($oldPath);
            }
            $path = $file->store("settings", 'public');
            Setting::set($key, $path);
        }

        Setting::clearCache();

        return redirect()->back()->with('success', 'Settings updated successfully!');
    }
}
