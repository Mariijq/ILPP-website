<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AboutUs;

class AboutUsController extends Controller
{
    public function edit()
    {
        // Get first record or null
        $about = AboutUs::first();

        return view('backend.about.index', compact('about'));
    }

    public function updateOrCreate(Request $request)
    {
        $data = $request->validate([
            'vision' => 'nullable|string',
            'mission' => 'nullable|string',
            'goals' => 'nullable|string',
        ]);

        AboutUs::updateOrCreate(
            ['id' => 1], // ensure single record
            $data
        );

        return redirect()->back()->with('success', 'About Us updated successfully.');
    }
}
