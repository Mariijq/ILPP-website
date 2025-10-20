<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\History;

class HistoryController extends Controller
{
    public function edit()
    {
        // Auto-create a history record if none exists
        $history = History::first() ?? History::create([
            'title' => 'Default Title',
            'description' => 'Default description...',
        ]);

        return view('backend.history.index', compact('history'));
    }

    public function updateOrCreate(Request $request)
    {
        $data = $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        // Always update record with ID 1 (or first record)
        History::updateOrCreate(['id' => 1], $data);

        return redirect()->back()->with('success', 'History updated successfully.');
    }
}
