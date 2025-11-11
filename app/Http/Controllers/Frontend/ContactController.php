<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactMessage;

class ContactController extends Controller
{
    /**
     * Show the contact form.
     */
    public function create()
    {
        return view('frontend.pages.contact'); // Make sure this path matches your Blade
    }

    /**
     * Store the contact form submission.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'message' => 'required|string',
        ]);

        ContactMessage::create($request->only('name', 'email', 'phone', 'message'));

        return redirect()->back()->with('success', 'Your message has been sent!');
    }
}
