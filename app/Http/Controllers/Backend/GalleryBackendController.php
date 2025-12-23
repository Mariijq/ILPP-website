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
        return view('backend.gallery.index', compact('images'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'images' => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:8192',
        ]);

        try {
            $title = $request->title ? ['en' => $request->title] : ['en' => ''];
            $description = $request->description ? ['en' => $request->description] : ['en' => ''];

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $file) {
                    $path = $file->store('gallery_images', 'public');

                    GalleryImage::create([
                        'image_path' => $path,
                        'title' => $title,
                        'description' => $description,
                    ]);
                }
            }

            Toastr::success('Images uploaded successfully!', ['title' => 'Success']);
            return redirect()->route('gallery.index');

        } catch (\Exception $e) {
            Toastr::error('Something went wrong: '.$e->getMessage(), ['title' => 'Error']);
            return back();
        }
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        try {
            $image = GalleryImage::findOrFail($id);

            if ($request->has('title')) {
                $current = $image->title ?? [];
                $current['en'] = $request->title;
                $image->title = $current;
            }

            if ($request->has('description')) {
                $current = $image->description ?? [];
                $current['en'] = $request->description;
                $image->description = $current;
            }

            $image->save();

            Toastr::success('Image updated successfully!', ['title' => 'Success']);
            return back();

        } catch (\Exception $e) {
            Toastr::error('Something went wrong: '.$e->getMessage(), ['title' => 'Error']);
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
            return redirect()->route('gallery.index');

        } catch (\Exception $e) {
            Toastr::error('Something went wrong: '.$e->getMessage(), ['title' => 'Error']);
            return back();
        }
    }
}
