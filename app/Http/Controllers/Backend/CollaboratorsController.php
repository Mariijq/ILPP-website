<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Collaborator;
use Illuminate\Support\Facades\Storage;
use App\DataTables\CollaboratorsDataTable;
use Toastr;

class CollaboratorsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CollaboratorsDataTable $dataTable)
    {
        return $dataTable->render('backend.pages.collaborators.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.pages.collaborators.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name_en' => 'required|string|max:255',
                'name_mk' => 'nullable|string|max:255',
                'name_al' => 'nullable|string|max:255',
                'bio_en' => 'nullable|string',
                'bio_mk' => 'nullable|string',
                'bio_al' => 'nullable|string',
            ]);

            // Prepare JSON fields
            $collaboratorData = [
                'name' => [
                    'en' => $validated['name_en'],
                    'mk' => $validated['name_mk'] ?? '',
                    'al' => $validated['name_al'] ?? '',
                ],
                'bio' => [
                    'en' => $validated['bio_en'] ?? '',
                    'mk' => $validated['bio_mk'] ?? '',
                    'al' => $validated['bio_al'] ?? '',
                ],
            ];

            Collaborator::create($collaboratorData);

            Toastr::success('Collaborator created successfully.');
            return redirect()->route('backend.collaborators.index');
        } catch (\Exception $e) {
            Toastr::error('An error occurred while creating the collaborator: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $collaborators = Collaborator::findOrFail($id);
        return view('backend.pages.collaborators.show', compact('collaborators'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $collaborators = Collaborator::findOrFail($id);
        return view('backend.pages.collaborators.create', compact('collaborators'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $validated = $request->validate([
                'name_en' => 'required|string|max:255',
                'name_mk' => 'nullable|string|max:255',
                'name_al' => 'nullable|string|max:255',
                'bio_en' => 'nullable|string',
                'bio_mk' => 'nullable|string',
                'bio_al' => 'nullable|string',
            ]);

            $collaborators = Collaborator::findOrFail($id);

            // Prepare JSON fields
            $collaboratorData = [
                'name' => [
                    'en' => $validated['name_en'],
                    'mk' => $validated['name_mk'] ?? '',
                    'al' => $validated['name_al'] ?? '',
                ],
                'bio' => [
                    'en' => $validated['bio_en'] ?? '',
                    'mk' => $validated['bio_mk'] ?? '',
                    'al' => $validated['bio_al'] ?? '',
                ],
            ];

            $collaborators->update($collaboratorData);

            Toastr::success('Collaborator updated successfully.');
            return redirect()->route('backend.collaborators.index');
        } catch (\Exception $e) {
            Toastr::error('An error occurred while updating the collaborator: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $collaborators = Collaborator::findOrFail($id);
            $collaborators->delete();

            Toastr::success('Collaborator deleted successfully.');
            return redirect()->route('backend.collaborators.index');
        } catch (\Exception $e) {
            Toastr::error('An error occurred while deleting the collaborator: ' . $e->getMessage());
            return redirect()->back();
        }
    }
}
