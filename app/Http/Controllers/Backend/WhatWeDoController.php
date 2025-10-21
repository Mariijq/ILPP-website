<?php

namespace App\Http\Controllers\Backend;

use Toastr;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WhatWeDo;

class WhatWeDoController extends Controller
{
    public function edit()
    {
        // Auto-create record if none exists
        $whatWeDo = WhatWeDo::first() ?? WhatWeDo::create([
            'title' => 'Our Programs',
            'leadership' => '',
            'research' => '',
            'public_policy' => '',
        ]);

        return view('backend.what-we-do.index', compact('whatWeDo'));
    }

    public function updateOrCreate(Request $request)
    {
        $data = $request->validate([
            'title' => 'nullable|string|max:255',
            'leadership' => 'nullable|string',
            'research' => 'nullable|string',
            'public_policy' => 'nullable|string',
        ]);

        WhatWeDo::updateOrCreate(['id' => 1], $data);

        Toastr::success('Content updated successfully!', ['title'=>'Success']);
        return redirect()->back();
    }
}
