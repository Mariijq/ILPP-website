<?php

namespace App\Http\Controllers\Backend;

use Toastr;
use App\Models\Document;
use App\DataTables\DocumentsDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file_path' => 'required|file|mimes:pdf,doc,docx,ppt,pptx,xls,xlsx,jpg,jpeg,png|max:20480', // 20MB limit
        ]);

        try {
            // Store uploaded file
            $filePath = $request->file('file_path')->store('documents', 'public');
            $validated['file_path'] = $filePath;

            Document::create($validated);

            Toastr::success('Document added successfully', ['title'=>'Success']);

            return redirect()->route('backend.documents.index');

        } catch (\Exception $e) {
            Toastr::error('Something went wrong: '.$e->getMessage(), ['title'=>'Error']);

            return back()->withInput();
        }
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
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file_path' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,xls,xlsx,jpg,jpeg,png|max:20480',
        ]);

        try {
            // Handle file replacement

            if ($request->hasFile('file_path')) {
                if ($document->file_path && Storage::disk('public')->exists($document->file_path)) {
                    Storage::disk('public')->delete($document->file_path);
                }
                $validated['file_path'] = $request->file('file_path')->store('documents', 'public');
            }

            $document->update($validated);
            Toastr::success('Document updated successfully!', ['title'=>'Success']);

            return redirect()->route('backend.documents.index');

        } catch (\Exception $e) {
            Toastr::error('Something went wrong: '.$e->getMessage(), ['title'=>'Error']);

            return back()->withOnput();
        }
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
            Toastr::success('Document deleted successfully!', ['title'=>'Success']);

            return redirect()->route('backend.documents.index');

        } catch (\Exception) {
            Toastr::error('Something went wrong: '.$e->getMessage(), ['title'=>'Error']);

            return back();
        }
    }
}
