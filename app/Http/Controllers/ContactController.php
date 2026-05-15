<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'subject' => 'nullable|string|max:255',
            'phone'   => 'nullable|string|max:20',
            'message' => 'required|string|min:10|max:5000',
        ]);

        ContactMessage::create([
            ...$validated,
            'ip_address' => $request->ip(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Thank you for your message! I will get back to you soon.',
        ]);
    }
}
