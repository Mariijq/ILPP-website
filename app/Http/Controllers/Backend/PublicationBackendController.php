<?php

namespace App\Http\Controllers\Backend;

use Toastr;
use App\DataTables\PublicationsDataTable;
use App\Http\Controllers\Controller;
use App\Models\Publication;
use Illuminate\Http\Request;

class PublicationBackendController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PublicationsDataTable $dataTable)
    {
        return $dataTable->render('backend.publications.index');

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.publications.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'short_description' => 'nullable|string|max:500',
            'detailed_description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'file' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,txt|max:5120',

        ]);
        try {
            // Handle image upload
            if ($request->hasFile('image')) {
                $path = $request->file('image')->store('publications_images', 'public');
                $validated['image'] = $path;
            }

            // Handle file upload
            if ($request->hasFile('file')) {
                $path = $request->file('file')->store('publications_files', 'public');
                $validated['file'] = $path;
            }

            // Create publications
            Publication::create($validated);
            Toastr::success('Publication added successfully!', ['title'=>'Success']);

            return redirect()->route('publications.index');

        } catch (\Exception $e) {
            Toastr::error('Something went wrong: '.$e->getMessage(), ['title'=>'Error']);

            return back()->withInput();
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $publications = Publication::findOrFail($id);

        return view('backend.publications.show', compact('publications'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $publications = Publication::findOrFail($id);

        return view('backend.publications.edit', compact('publications'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $publications = Publication::findOrFail($id);

        // Validate input
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'short_description' => 'nullable|string|max:500',
            'detailed_description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240',

            'file' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,txt|max:5120',
        ]);

        try {
            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($publications->image && Storage::disk('public')->exists($publications->image)) {
                    Storage::disk('public')->delete($publications->image);
                }
                $path = $request->file('image')->store('publications_images', 'public');
                $validated['image'] = $path;
            }

            // Handle file upload
            if ($request->hasFile('file')) {
                if ($publications->file && Storage::disk('public')->exists($publications->file)) {
                    Storage::disk('public')->delete($publications->file);
                }
                $path = $request->file('file')->store('publications_files', 'public');
                $validated['file'] = $path;
            }
            $publication->update($validated);

            Toastr::success('Publication updated successfully!', ['title'=>'Success']);

            return redirect()->route('publications.index');
        } catch (\Exception $e) {
            Toastr::error('Something went wrong: '.$e->getMessage(), ['title'=>'Error']);

            return back()->withInput();
        }
        // Handle image upload

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $publication = Publication::findOrFail($id);

        try {
            if ($publication->image && Storage::disk('public')->exists($publication->image)) {
                Storage::disk('public')->delete($publication->image);
            }

            if ($publication->file && Storage::disk('public')->exists($publication->file)) {
                Storage::disk('public')->delete($publication->file);
            }

            $publication->delete();

            Toastr::success('Publication deleted successfully!', ['title'=>'Success']);

            return redirect()->route('publications.index');

        } catch (\Exception $e) {
            Toastr::error('Something went wrong: '.$e->getMessage(), ['title'=>'Error']);

            return back();
        }
    }
}
