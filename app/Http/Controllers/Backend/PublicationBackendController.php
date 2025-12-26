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
    public function index(PublicationsDataTable $dataTable)
    {
        return $dataTable->render('backend.pages.publications.index');
    }

    public function create()
    {
        return view('backend.pages.publications.create');
    }

    public function store(Request $request)
    {
        $languages = ['en', 'mk', 'al'];

        // Validate input
        $request->validate([
            'date' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'file' => 'nullable|file|mimes:pdf|max:10240', // PDF only
            'title_en' => 'required|string|max:255',
            'short_description_en' => 'nullable|string',
            'detailed_description_en' => 'nullable|string',
        ]);

        // Prepare data
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

        // Handle image upload
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('publications_images', 'public');
        }

        // Handle PDF file upload
        if ($request->hasFile('file')) {
            $file = $request->file('file');

            // Debug - check if file exists and error
            if (! $file->isValid()) {
                return back()->withInput()->withErrors(['file' => 'File upload failed.']);
            }

            $data['file'] = $file->store('publications_files', 'public');
        }

        // Save publication
        $publication = \App\Models\Publication::create($data);

        \Toastr::success('Publication added successfully!');

        return redirect()->route('backend.publications.index');
    }

    public function edit($id)
    {
        $publication = Publication::findOrFail($id);

        return view('backend.pages.publications.create', compact('publication'));
    }

    public function update(Request $request, $id)
    {
        $publication = Publication::findOrFail($id);

        try {
            // Validate inputs
            $validated = $request->validate([
                'title_en' => 'required|string|max:255',
                'title_mk' => 'nullable|string|max:255',
                'title_al' => 'nullable|string|max:255',
                'short_description_en' => 'nullable|string|max:500',
                'short_description_mk' => 'nullable|string|max:500',
                'short_description_al' => 'nullable|string|max:500',
                'detailed_description_en' => 'nullable|string',
                'detailed_description_mk' => 'nullable|string',
                'detailed_description_al' => 'nullable|string',
                'date' => 'required|date',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
                'file' => 'nullable|mimes:pdf|max:5120',
            ]);

            $data = [
                'title' => [
                    'en' => $validated['title_en'],
                    'mk' => $validated['title_mk'] ?? '',
                    'al' => $validated['title_al'] ?? '',
                ],
                'short_description' => [
                    'en' => $validated['short_description_en'] ?? '',
                    'mk' => $validated['short_description_mk'] ?? '',
                    'al' => $validated['short_description_al'] ?? '',
                ],
                'detailed_description' => [
                    'en' => $validated['detailed_description_en'] ?? '',
                    'mk' => $validated['detailed_description_mk'] ?? '',
                    'al' => $validated['detailed_description_al'] ?? '',
                ],
                'date' => $validated['date'],
            ];

            // Handle image
            if ($request->hasFile('image')) {
                if ($publication->image && Storage::disk('public')->exists($publication->image)) {
                    Storage::disk('public')->delete($publication->image);
                }
                $data['image'] = $request->file('image')->store('publications_images', 'public');
            } else {
                $data['image'] = $publication->image;
            }

            // Handle PDF file
            if ($request->hasFile('file')) {
                if ($publication->file && Storage::disk('public')->exists($publication->file)) {
                    Storage::disk('public')->delete($publication->file);
                }
                $data['file'] = $request->file('file')->store('publications_files', 'public');
            } else {
                $data['file'] = $publication->file;
            }

            $publication->update($data);

            Toastr::success('Publication updated successfully!', ['title' => 'Success']);

            return redirect()->route('backend.publications.index');

        } catch (\Illuminate\Validation\ValidationException $e) {
            foreach ($e->errors() as $errors) {
                foreach ($errors as $error) {
                    Toastr::error($error, ['title' => 'Validation Error']);
                }
            }

            return back()->withInput();
        } catch (\Exception $e) {
            Toastr::error('Unable to update publication: '.$e->getMessage(), ['title' => 'Error']);

            return back()->withInput();
        }
    }

    public function destroy($id)
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

            return redirect()->route('backend.publications.index');

        } catch (\Exception $e) {
            Toastr::error('Something went wrong: '.$e->getMessage(), ['title' => 'Error']);

            return back();
        }
    }
}
