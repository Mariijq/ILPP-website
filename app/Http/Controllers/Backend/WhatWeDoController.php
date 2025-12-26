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
            'title' => ['en' => 'Our Programs', 'mk' => '', 'al' => ''],
            'leadership' => ['en' => '', 'mk' => '', 'al' => ''],
            'research' => ['en' => '', 'mk' => '', 'al' => ''],
            'public_policy' => ['en' => '', 'mk' => '', 'al' => ''],
        ]);

        return view('backend.pages.what-we-do.index', compact('whatWeDo'));
    }

    public function updateOrCreate(Request $request)
    {
        $languages = ['en', 'mk', 'al'];

        $fields = ['title', 'leadership', 'research', 'public_policy'];

        $data = [];

        foreach ($fields as $field) {
            $data[$field] = [];
            foreach ($languages as $lang) {
                $inputName = $field . '_' . $lang;
                $data[$field][$lang] = $request->input($inputName, '');
            }
        }

        WhatWeDo::updateOrCreate(['id' => 1], $data);

        Toastr::success('Content updated successfully!', ['title' => 'Success']);
        return redirect()->back();
    }
}
