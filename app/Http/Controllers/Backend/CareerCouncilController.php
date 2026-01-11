<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CareerCouncil;
use Illuminate\Support\Facades\Storage;
use Toastr;
use App\DataTables\CareerCouncilDataTable;

class CareerCouncilController extends Controller
{
    public function index(CareerCouncilDataTable $dataTable)
    {
        return $dataTable->render('backend.pages.career-councils.index');
    }

    public function create()
    {
        return view('backend.pages.career-councils.create');
    }

public function store(Request $request)
{
    try {
        $validated = $request->validate([
            'title' => 'required|array',
            'title.en' => 'required|string|max:255',
            'title.mk' => 'nullable|string|max:255',
            'title.al' => 'nullable|string|max:255',
            'short_description' => 'nullable|array',
            'short_description.en' => 'nullable|string',
            'short_description.mk' => 'nullable|string',
            'short_description.al' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
            'files.*' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,zip|max:10240', // validate each file
        ]);

        $careerCouncilData = [
            'title' => $validated['title'],
            'short_description' => $validated['short_description'] ?? ['en'=>'','mk'=>'','al'=>''],
        ];

        // Single image
        if ($request->hasFile('image')) {
            $careerCouncilData['image'] = $request->file('image')->store('career_councils', 'public');
        }

        // Multiple files
        if ($request->hasFile('files')) {
            $files = [];
            foreach ($request->file('files') as $file) {
                $files[] = $file->store('career_councils/files', 'public');
            }
            $careerCouncilData['files'] = $files;
        }

        CareerCouncil::create($careerCouncilData);

        Toastr::success('Career Council added successfully!', ['title'=>'Success']);
        return redirect()->route('backend.career-councils.index');

    } catch (\Exception $e) {
        Toastr::error('Something went wrong: '.$e->getMessage(), ['title'=>'Error']);
        return back()->withInput();
    }
}

    public function edit(CareerCouncil $careerCouncil)
    {
        return view('backend.pages.career-councils.create', compact('careerCouncil'));
    }

public function update(Request $request, CareerCouncil $careerCouncil)
{
    try {
        // Validation
        $validated = $request->validate([
            'title' => 'required|array',
            'title.en' => 'required|string|max:255',
            'title.mk' => 'nullable|string|max:255',
            'title.al' => 'nullable|string|max:255',
            'short_description' => 'nullable|array',
            'short_description.en' => 'nullable|string',
            'short_description.mk' => 'nullable|string',
            'short_description.al' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
            'files.*' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,zip|max:10240',
            'remove_files' => 'nullable|array',
        ]);

        $careerCouncilData = [
            'title' => $validated['title'],
            'short_description' => $validated['short_description'] ?? ['en' => '', 'mk' => '', 'al' => ''],
        ];

        // Replace main image if uploaded
        if ($request->hasFile('image')) {
            if ($careerCouncil->image) {
                Storage::disk('public')->delete($careerCouncil->image);
            }
            $careerCouncilData['image'] = $request->file('image')->store('career_councils', 'public');
        }

        // Handle existing files
        $existingFiles = $careerCouncil->files ?? [];

        // Remove files that were checked for deletion
        if ($request->has('remove_files')) {
            foreach ($request->remove_files as $index) {
                if (isset($existingFiles[$index])) {
                    Storage::disk('public')->delete($existingFiles[$index]); // delete from storage
                    unset($existingFiles[$index]); // remove from array
                }
            }
            $existingFiles = array_values($existingFiles); // reindex array
        }

        // Upload new files
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $originalName = $file->getClientOriginalName();
                $path = $file->storeAs('career_councils/files', $originalName, 'public');
                $existingFiles[] = $path;
            }
        }

        // Save updated files array
        $careerCouncilData['files'] = $existingFiles;

        // Update Career Council
        $careerCouncil->update($careerCouncilData);

        Toastr::success('Career Council updated successfully!', ['title' => 'Success']);
        return redirect()->route('backend.career-councils.index');

    } catch (\Exception $e) {
        Toastr::error('Something went wrong: '.$e->getMessage(), ['title' => 'Error']);
        return back()->withInput();
    }
}

    public function destroy(CareerCouncil $careerCouncil)
    {
        if ($careerCouncil->image) {
            Storage::disk('public')->delete($careerCouncil->image);
        }

        $careerCouncil->delete();

        Toastr::success('Career Council deleted successfully!', ['title'=>'Success']);
        return redirect()->route('backend.career-councils.index');
    }
}
