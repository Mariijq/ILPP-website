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
        $data = $request->validate([
            'vision' => 'nullable|string',
            'mision' => 'nullable|string',
            'goals' => 'nullable|string',
        ]);
        
        $data['vision'] = $data['vision'] ?? '';
        $data['mision'] = $data['mision'] ?? '';
        $data['goals'] = $data['goals'] ?? '';

        AboutUs::updateOrCreate(['id' => 1], $data);

        Toastr::success('About Us updates successfully!', ['title' => 'Success']);

        return redirect()->back();
    }
}
