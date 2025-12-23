<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use Illuminate\Http\Request;
use Toastr;

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
    $languages = ['en', 'mk', 'al'];

    $rules = [];
    foreach ($languages as $lang) {
        $rules["vision_$lang"] = 'nullable|string';
        $rules["mision_$lang"] = 'nullable|string';
        $rules["goals_$lang"]  = 'nullable|string';
    }

    $validated = $request->validate($rules);

    $data = [
        'vision' => [],
        'mision' => [],
        'goals'  => [],
    ];

    foreach ($languages as $lang) {
        $data['vision'][$lang] = $validated["vision_$lang"] ?? '';
        $data['mision'][$lang] = $validated["mision_$lang"] ?? '';
        $data['goals'][$lang]  = $validated["goals_$lang"] ?? '';
    }

    AboutUs::updateOrCreate(['id' => 1], $data);

    Toastr::success('About Us updated successfully!', ['title' => 'Success']);

    return redirect()->back();
}
}
