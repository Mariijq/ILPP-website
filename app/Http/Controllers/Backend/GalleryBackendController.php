<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\GalleryImage;
use Illuminate\Http\Request;

class GalleryBackendController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $images = GalleryImage::latest()->get();

        return view('backend.gallery.index', compact('images'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
        ]);

        try {
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $file) {
                    $path = $file->store('gallery_images', 'public');
                    GalleryImage::create(['path' => $path]);
                }
            }
            Toastr::success('Image uploaded successfully!', ['title'=>'success']);

            return redirect()->route('gallery.index');
        } catch (\Exception $e) {
            Toastr::error('Unable to add project: '.$e->getMessage(), ['title'=>'Error']);

            return back();
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $image = GalleryImage::findOrFail($id);

        try {
            // Delete image file from storage
            if ($image->path && Storage::disk('public')->exists($image->path)) {
                Storage::disk('public')->delete($image->path);
            }

            $image->delete();
            Toastr::success('Image deleted successfully!', ['title'=>'Success']);

            return redirect()->route('gallery.index');
        } catch (\Exception $e) {
            Toastr::error('Something went wrong: '.$e->getMessage(), ['title'=>'Error']);

            return back();
        }
    }
}
