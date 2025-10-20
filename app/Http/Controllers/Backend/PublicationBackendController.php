<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;

use App\DataTables\PublicationsDataTable;
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'file' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,txt|max:5120',

        ]);

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

        return redirect()->route('publications.index')->with('success', 'publications created successfully.');

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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'file' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,txt|max:5120',
        ]);

        // Handle image upload
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

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $publications = Publication::findOrFail($id);
        $publications->delete();

        return redirect()->route('publications.index')->with('success', 'publications deleted successfully.');

    }
}
