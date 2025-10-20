<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use App\DataTables\TeamMemberDataTable;
use Illuminate\Http\Request;

class TeamMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(TeamMemberDataTable $dataTable)
    {
        return $dataTable->render('backend.team-members.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.team-members.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'order' => 'nullable|integer',
        ]);
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image'->store('team-members', 'public'));
        }

        TeamMember::create($data);

        return redirect->route('team-members.index')->with('success', 'Team Member added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(TeamMember $teamMember)
    {
        return view('backend.team-members.show', compact('teamMember'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('backend.team-members.create', compact('teamMember'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'order' => 'nullable|integer',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($teamMember->image) {
                Storage::disk('public')->delete($teamMember->image);
            }
            $data['image'] = $request->file('image')->store('team-members', 'public');
        }

        $teamMember->update($data);

        return redirect()->route('team-members.index')->with('success', 'Team member updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if ($teamMember->image) {
            Storage::disk('public')->delete($teamMember->image);
        }

        $teamMember->delete();

        return redirect()->route('team-members.index')->with('success', 'Team member deleted successfully.');
    }
}
