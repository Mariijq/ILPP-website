<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\GalleryImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Toastr;

class GalleryBackendController extends Controller
{
    public function index()
    {
        $images = GalleryImage::latest()->get();

        return view('backend.pages.gallery.index', compact('images'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'nullable|array',
            'title.*' => 'nullable|string|max:255',
            'description' => 'nullable|array',
            'description.*' => 'nullable|string',
            'images' => 'required',
            'images.*' => 'required|file|mimes:jpeg,jpg,png,gif,webp,heic,bmp,tiff',
        ]);

        try {
            $titles = $request->title ?? ['en' => ''];
            $descriptions = $request->description ?? ['en' => ''];

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $file) {
                    $path = $file->store('gallery_images', 'public');

                    GalleryImage::create([
                        'image_path' => $path,
                        'title' => $titles,
                        'description' => $descriptions,
                    ]);
                }
            }

            Toastr::success('Images uploaded successfully!', ['title' => 'Success']);

            return redirect()->route('backend.gallery.index');

        } catch (\Exception $e) {
            Toastr::error('Something went wrong: ' . $e->getMessage(), ['title' => 'Error']);

            return back();
        }
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'nullable|array',
            'title.*' => 'nullable|string|max:255',
            'description' => 'nullable|array',
            'description.*' => 'nullable|string',
        ]);

        try {
            $image = GalleryImage::findOrFail($id);

            if ($request->has('title')) {
                $image->title = $request->title; // now stores all languages
            }

            if ($request->has('description')) {
                $image->description = $request->description; // now stores all languages
            }

            $image->save();

            Toastr::success('Image updated successfully!', ['title' => 'Success']);

            return back();

        } catch (\Exception $e) {
            Toastr::error('Something went wrong: ' . $e->getMessage(), ['title' => 'Error']);

            return back();
        }
    }

    public function destroy(string $id)
    {
        $image = GalleryImage::findOrFail($id);

        try {
            if ($image->image_path && Storage::disk('public')->exists($image->image_path)) {
                Storage::disk('public')->delete($image->image_path);
            }

            $image->delete();
            Toastr::success('Image deleted successfully!', ['title' => 'Success']);

            return redirect()->route('backend.gallery.index');

        } catch (\Exception $e) {
            Toastr::error('Something went wrong: ' . $e->getMessage(), ['title' => 'Error']);

            return back();
        }
    }
}
