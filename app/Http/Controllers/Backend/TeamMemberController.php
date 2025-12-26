<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\TeamMemberDataTable;
use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Toastr;

class TeamMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(TeamMemberDataTable $dataTable)
    {
        return $dataTable->render('backend.pages.team-members.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.pages.team-members.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name_en' => 'required|string|max:255',
            'name_mk' => 'nullable|string|max:255',
            'name_al' => 'nullable|string|max:255',
            'position_en' => 'nullable|string|max:255',
            'position_mk' => 'nullable|string|max:255',
            'position_al' => 'nullable|string|max:255',
            'bio_en' => 'nullable|string',
            'bio_mk' => 'nullable|string',
            'bio_al' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'order' => 'nullable|integer',
            'facebook' => 'nullable|url|max:255',
            'linkedin' => 'nullable|url|max:255',

        ]);

        // Convert multilingual inputs into JSON array
        $data['name'] = [
            'en' => $data['name_en'],
            'mk' => $data['name_mk'] ?? '',
            'al' => $data['name_al'] ?? '',
        ];
        unset($data['name_en'], $data['name_mk'], $data['name_al']);

        $data['position'] = [
            'en' => $data['position_en'] ?? '',
            'mk' => $data['position_mk'] ?? '',
            'al' => $data['position_al'] ?? '',
        ];
        unset($data['position_en'], $data['position_mk'], $data['position_al']);

        $data['bio'] = [
            'en' => $data['bio_en'] ?? '',
            'mk' => $data['bio_mk'] ?? '',
            'al' => $data['bio_al'] ?? '',
        ];
        unset($data['bio_en'], $data['bio_mk'], $data['bio_al']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('team-members', 'public');
        }

        TeamMember::create($data);

        Toastr::success('Team Member added successfully!', ['title' => 'Success']);

        return redirect()->route('backend.team-members.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(TeamMember $teamMember)
    {
        return view('backend.pages.team-members.show', compact('teamMember'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Fetch the team member by ID
        $teamMember = TeamMember::findOrFail($id);

        // Pass it to the view
        return view('backend.pages.team-members.create', compact('teamMember'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TeamMember $teamMember)
    {
        $data = $request->validate([
            'name_en' => 'required|string|max:255',
            'name_mk' => 'nullable|string|max:255',
            'name_al' => 'nullable|string|max:255',
            'position_en' => 'nullable|string|max:255',
            'position_mk' => 'nullable|string|max:255',
            'position_al' => 'nullable|string|max:255',
            'bio_en' => 'nullable|string',
            'bio_mk' => 'nullable|string',
            'bio_al' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'order' => 'nullable|integer',
            'facebook' => 'nullable|url|max:255',
            'linkedin' => 'nullable|url|max:255',

        ]);

        $data['name'] = [
            'en' => $data['name_en'],
            'mk' => $data['name_mk'] ?? '',
            'al' => $data['name_al'] ?? '',
        ];
        unset($data['name_en'], $data['name_mk'], $data['name_al']);

        $data['position'] = [
            'en' => $data['position_en'] ?? '',
            'mk' => $data['position_mk'] ?? '',
            'al' => $data['position_al'] ?? '',
        ];
        unset($data['position_en'], $data['position_mk'], $data['position_al']);

        $data['bio'] = [
            'en' => $data['bio_en'] ?? '',
            'mk' => $data['bio_mk'] ?? '',
            'al' => $data['bio_al'] ?? '',
        ];
        unset($data['bio_en'], $data['bio_mk'], $data['bio_al']);

        if ($request->hasFile('image')) {
            if ($teamMember->image) {
                Storage::disk('public')->delete($teamMember->image);
            }
            $data['image'] = $request->file('image')->store('team-members', 'public');
        }

        $teamMember->update($data);

        Toastr::success('Team Member updated successfully!', ['title' => 'Success']);

        return redirect()->route('backend.team-members.index');
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

            return redirect()->route('backend.team-members.index');

        } catch (\Exception $e) {
            Toastr::error('Something went wrong: '.$e->getMessage(), ['title' => 'Error']);

            return back();
        }
    }
}
