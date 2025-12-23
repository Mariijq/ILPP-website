<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\PublicationsDataTable;
use App\Http\Controllers\Controller;
use App\Models\Publication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Toastr;

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
    $languages = ['en', 'mk', 'al'];

    $request->validate([
        'date' => 'required|date',
        'image' => 'nullable|image|max:5120',
        'file' => 'nullable|file|max:5120',
    ]);

    $data = [
        'title' => [],
        'short_description' => [],
        'detailed_description' => [],
        'date' => $request->date,
    ];

    foreach ($languages as $lang) {
        $data['title'][$lang] = $request->input("title_$lang");
        $data['short_description'][$lang] = $request->input("short_description_$lang");
        $data['detailed_description'][$lang] = $request->input("detailed_description_$lang");
    }

    if ($request->hasFile('image')) {
        $data['image'] = $request->file('image')->store('publications_images', 'public');
    }

    if ($request->hasFile('file')) {
        $data['file'] = $request->file('file')->store('publications_files', 'public');
    }

    Publication::create($data);

    Toastr::success('Publication added successfully!');
    return redirect()->route('publications.index');
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
    $publication = Publication::findOrFail($id);
    $languages = ['en', 'mk', 'al'];

    $data = [
        'title' => [],
        'short_description' => [],
        'detailed_description' => [],
        'date' => $request->date,
    ];

    foreach ($languages as $lang) {
        $data['title'][$lang] = $request->input("title_$lang");
        $data['short_description'][$lang] = $request->input("short_description_$lang");
        $data['detailed_description'][$lang] = $request->input("detailed_description_$lang");
    }

    if ($request->hasFile('image')) {
        if ($publication->image) {
            Storage::disk('public')->delete($publication->image);
        }
        $data['image'] = $request->file('image')->store('publications_images', 'public');
    }

    if ($request->hasFile('file')) {
        if ($publication->file) {
            Storage::disk('public')->delete($publication->file);
        }
        $data['file'] = $request->file('file')->store('publications_files', 'public');
    }

    $publication->update($data);

    Toastr::success('Publication updated successfully!');
    return redirect()->route('publications.index');
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

            Toastr::success('Publication deleted successfully!', ['title' => 'Success']);

            return redirect()->route('publications.index');

        } catch (\Exception $e) {
            Toastr::error('Something went wrong: '.$e->getMessage(), ['title' => 'Error']);

            return back();
        }
    }
}
