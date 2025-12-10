<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\TeamMemberDataTable;
use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use Illuminate\Http\Request;
use Toastr;
use Illuminate\Support\Facades\Storage;

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

        try {
            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image')->store('team-members', 'public');
            }

            TeamMember::create($data);

            Toastr::success('Team Member added successfully!', ['title' => 'Success']);

            return redirect()->route('team-members.index');
        } catch (\Exception $e) {
            Toastr::error('Something went wrong: '.$e->getMessage(), ['title' => 'Error']);

            return back()->withInput();
        }
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

        try {
            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($teamMember->image) {
                    Storage::disk('public')->delete($teamMember->image);
                }
                $data['image'] = $request->file('image')->store('team-members', 'public');
            }

            $teamMember->update($data);
            Toastr::success('Team member updated successfully', ['title' => 'Succes']);

            return redirect()->route('team-members.index');
        } catch (\Exception $e) {
            Toastr::error('Something went wrong: '.$e->getMessage(), ['title' => 'Error']);

            return back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            if ($teamMember->image) {
                Storage::disk('public')->delete($teamMember->image);
            }

            $teamMember->delete();
            Toastr::success('Team member deleted successfully', ['title' => 'Success']);

            return redirect()->route('team-members.index');

        } catch (\Exception $e) {
            Toastr::error('Something went wrong: '.$e->getMessage(), ['title' => 'Error']);

            return back();
        }
    }
}
