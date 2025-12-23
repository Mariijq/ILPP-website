<?php

namespace App\Http\Controllers\Backend;

use Toastr;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\History;

class HistoryController extends Controller
{
    protected $languages = ['en' => 'English', 'mk' => 'Macedonian', 'al' => 'Albanian'];

    public function edit()
    {
        // Auto-create a history record if none exists
        $history = History::first() ?? History::create([
            'title' => json_encode(array_fill_keys(array_keys($this->languages), 'Default Title')),
            'description' => json_encode(array_fill_keys(array_keys($this->languages), 'Default description...')),
        ]);

        return view('backend.history.index', compact('history'))->with('languages', $this->languages);
    }

    public function updateOrCreate(Request $request)
    {
        $rules = [];
        foreach ($this->languages as $code => $label) {
            $rules["title_$code"] = 'nullable|string|max:255';
            $rules["description_$code"] = 'nullable|string';
        }

        $validated = $request->validate($rules);

        $data = [
            'title' => [],
            'description' => [],
        ];

        foreach ($this->languages as $code => $label) {
            $data['title'][$code] = $validated["title_$code"] ?? '';
            $data['description'][$code] = $validated["description_$code"] ?? '';
        }

        // Update or create the history record (first record)
        History::updateOrCreate(['id' => 1], $data);

        Toastr::success('History updated successfully!', ['title'=>'Success']);
        return redirect()->back();
    }
}
