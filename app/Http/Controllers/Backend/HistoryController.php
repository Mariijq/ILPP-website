<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\History;

class HistoryController extends Controller
{
    public function edit()
    {
        $history = History::first();
        return view('backend.history.index', compact('history'));
    }

    public function updateOrCreate(Request $request)
    {
        $data = $request->validate([
            'content' => 'nullable|string',
        ]);

        History::updateOrCreate(['id' => 1], $data);

        return redirect()->back()->with('success', 'History updated successfully.');
    }
}
