<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Publication;
use Illuminate\Support\Facades\Storage;

class PublicationsController extends Controller
{
    public function index()
    {

        $publications = Publication::paginate(8);

        return view('frontend.pages.publications', compact('publications'));
    }

    public function show($id)
    {

        $publications = Publication::findOrFail($id);

        return view('frontend.pages.publication-details', compact('publications'));
    }

    public function download($id)
    {
        $publication = Publication::findOrFail($id);

        if ($publication->file && Storage::disk('public')->exists($publication->file)) {
            // Return file as download
            return Storage::disk('public')->download($publication->file);
        }

        // File does not exist
        Toastr::error('File not found!', ['title' => 'Error']);

        return back();
    }

    public function open($id)
    {
        $publication = Publication::findOrFail($id);

        if ($publication->file && Storage::disk('public')->exists($publication->file)) {
            $filePath = Storage::disk('public')->path($publication->file);
            $mimeType = Storage::disk('public')->mimeType($publication->file);

            return response()->file($filePath, [
                'Content-Type' => $mimeType,
            ]);
        }

        Toastr::error('File not found!', ['title' => 'Error']);

        return back();
    }
}
