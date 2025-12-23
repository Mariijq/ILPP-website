<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\DocumentsDataTable;
use App\Http\Controllers\Controller;
use App\Models\Document;
use Illuminate\Http\Request;
use Toastr;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(DocumentsDataTable $dataTable)
    {
        return $dataTable->render('backend.documents.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.documents.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [];
        foreach (['en', 'mk', 'al'] as $lang) {
            $rules["title_$lang"] = 'required|string|max:255';
            $rules["description_$lang"] = 'nullable|string';
        }

        $rules['file_path'] = 'required|file|mimes:pdf,doc,docx,ppt,pptx,xls,xlsx,jpg,jpeg,png|max:20480';

        $validated = $request->validate($rules);

        $data = [
            'title' => [],
            'description' => [],
        ];

        foreach (['en', 'mk', 'al'] as $lang) {
            $data['title'][$lang] = $validated["title_$lang"];
            $data['description'][$lang] = $validated["description_$lang"] ?? '';
        }

        $data['file_path'] = $request->file('file_path')->store('documents', 'public');

        Document::create($data);

        Toastr::success('Document added successfully!', ['title' => 'Success']);

        return redirect()->route('documents.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Document $document)
    {
        return view('backend.documents.show', compact('document'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Document $document)
    {
        return view('backend.documents.create', compact('document'));
    }

    /**
     * Update the specified resource in storage.
     */
public function update(Request $request, Document $document)
{
    $rules = [];
    foreach (['en', 'mk', 'al'] as $lang) {
        $rules["title_$lang"] = 'required|string|max:255';
        $rules["description_$lang"] = 'nullable|string';
    }

    $rules['file_path'] = 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,xls,xlsx,jpg,jpeg,png|max:20480';

    $validated = $request->validate($rules);

    $data = [
        'title' => [],
        'description' => [],
    ];

    foreach (['en', 'mk', 'al'] as $lang) {
        $data['title'][$lang] = $validated["title_$lang"];
        $data['description'][$lang] = $validated["description_$lang"] ?? '';
    }

    if ($request->hasFile('file_path')) {
        Storage::disk('public')->delete($document->file_path);
        $data['file_path'] = $request->file('file_path')->store('documents', 'public');
    }

    $document->update($data);

    Toastr::success('Document updated successfully!', ['title' => 'Success']);

    return redirect()->route('documents.index');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Document $document)
    {
        try {
            if ($document->file_path && Storage::disk('public')->exists($document->file_path)) {
                Storage::disk('public')->delete($document->file_path);
            }

            $document->delete();
            Toastr::success('Document deleted successfully!', ['title' => 'Success']);

            return redirect()->route('documents.index');

        } catch (\Exception $e) {
            Toastr::error('Something went wrong: '.$e->getMessage(), ['title' => 'Error']);

            return back();
        }
    }
}
