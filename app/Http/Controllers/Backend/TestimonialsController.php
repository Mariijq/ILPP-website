<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\TestimonialsDataTable;
use App\Http\Controllers\Controller;
use App\Models\Testimonials;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Toastr;

class TestimonialsController extends Controller
{
    public function index(TestimonialsDataTable $dataTable)
    {
        return $dataTable->render('backend.testimonials.index');
    }

    public function create()
    {
        return view('backend.testimonials.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'nullable|string|max:255',
            'review' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
        ]);

        $data = $request->only(['name', 'designation', 'review']);

        try {
            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image')->store('testimonials', 'public');
            }

            Testimonials::create($data);

            Toastr::success('Testimonial added successfully!', ['title' => 'Success']);

            return redirect()->route('testimonials.index');

        } catch (\Exception $e) {
            Toastr::error('Something went wrong: '.$e->getMessage(), ['title' => 'Error']);

            return back()->withInput();
        }
    }

    public function edit(Testimonials $testimonial)
    {
        return view('backend.testimonials.create', compact('testimonial'));
    }

    public function update(Request $request, Testimonials $testimonial)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'nullable|string|max:255',
            'review' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
        ]);

        $data = $request->only(['name', 'designation', 'review']);

        try {
            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($testimonial->image && Storage::disk('public')->exists($testimonial->image)) {
                    Storage::disk('public')->delete($testimonial->image);
                }
                $data['image'] = $request->file('image')->store('testimonials', 'public');
            }

            $testimonial->update($data);

            Toastr::success('Testimonial updated successfully!', ['title' => 'Success']);

            return redirect()->route('testimonials.index');

        } catch (\Exception $e) {
            Toastr::error('Something went wrong: '.$e->getMessage(), ['title' => 'Error']);

            return back()->withInput();
        }
    }

    public function destroy(Testimonials $testimonial)
    {
        try {
            // Delete image if exists
            if ($testimonial->image && Storage::disk('public')->exists($testimonial->image)) {
                Storage::disk('public')->delete($testimonial->image);
            }

            $testimonial->delete();

            Toastr::success('Testimonial deleted successfully!', ['title' => 'Success']);

            return redirect()->route('testimonials.index');

        } catch (\Exception $e) {
            Toastr::error('Something went wrong: '.$e->getMessage(), ['title' => 'Error']);

            return back();
        }
    }
}
