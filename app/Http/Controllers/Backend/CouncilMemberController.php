<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CouncilMember;
use Illuminate\Support\Facades\Storage;
use Toastr;
use App\DataTables\CouncilMemberDataTable;

class CouncilMemberController extends Controller
{
    private $locales = ['en', 'mk', 'al'];

    /**
     * Display a listing of council members.
     */
    public function index(CouncilMemberDataTable $dataTable)
    {
        return $dataTable->render('backend.pages.council-members.index');
    }

    /**
     * Show the form for creating a new council member.
     */
    public function create()
    {
        return view('backend.pages.council-members.create');
    }

    /**
     * Store a newly created council member.
     */
    public function store(Request $request)
    {
        $rules = [];
        foreach ($this->locales as $locale) {
            $rules["name.$locale"] = 'required|string|max:255';
            $rules["bio.$locale"] = 'nullable|string';
        }
        $rules['image'] = 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240';

        $validated = $request->validate($rules);

        $data = [
            'name' => $validated['name'],
            'bio'  => $validated['bio'],
        ];

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('council_members', 'public');
        }

        CouncilMember::create($data);

        Toastr::success('Council Member added successfully!');
        return redirect()->route('backend.council-members.index');
    }

    /**
     * Show the form for editing a council member.
     */
    public function edit(CouncilMember $councilMember)
    {
        return view('backend.pages.council-members.create', compact('councilMember'));
    }

    /**
     * Update a council member.
     */
    public function update(Request $request, CouncilMember $councilMember)
    {
        $rules = [];
        foreach ($this->locales as $locale) {
            $rules["name.$locale"] = 'required|string|max:255';
            $rules["bio.$locale"] = 'nullable|string';
        }
        $rules['image'] = 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240';

        $validated = $request->validate($rules);

        $data = [
            'name' => $validated['name'],
            'bio'  => $validated['bio'],
        ];

        if ($request->hasFile('image')) {
            if ($councilMember->image) {
                Storage::disk('public')->delete($councilMember->image);
            }
            $data['image'] = $request->file('image')->store('council_members', 'public');
        }

        $councilMember->update($data);

        Toastr::success('Council Member updated successfully!');
        return redirect()->route('backend.council-members.index');
    }

    /**
     * Delete a council member.
     */
    public function destroy(CouncilMember $councilMember)
    {
        if ($councilMember->image) {
            Storage::disk('public')->delete($councilMember->image);
        }

        $councilMember->delete();

        Toastr::success('Council Member deleted successfully!');
        return redirect()->route('backend.council-members.index');
    }
}
