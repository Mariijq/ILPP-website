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
        return $dataTable->render('backend.pages.testimonials.index');
    }

    public function create()
    {
        return view('backend.pages.testimonials.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name_en'        => 'required|string|max:255',
            'designation_en' => 'nullable|string|max:255',
            'review_en'      => 'nullable|string',
            'name_mk'        => 'nullable|string|max:255',
            'designation_mk' => 'nullable|string|max:255',
            'review_mk'      => 'nullable|string',
            'name_al'        => 'nullable|string|max:255',
            'designation_al' => 'nullable|string|max:255',
            'review_al'      => 'nullable|string',
            'image'          => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
        ]);

        $data = [
            'name' => [
                'en' => $validated['name_en'],
                'mk' => $validated['name_mk'] ?? '',
                'al' => $validated['name_al'] ?? '',
            ],
            'designation' => [
                'en' => $validated['designation_en'] ?? '',
                'mk' => $validated['designation_mk'] ?? '',
                'al' => $validated['designation_al'] ?? '',
            ],
            'review' => [
                'en' => $validated['review_en'] ?? '',
                'mk' => $validated['review_mk'] ?? '',
                'al' => $validated['review_al'] ?? '',
            ],
        ];

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('testimonials', 'public');
        }

        try {
            Testimonials::create($data);
            Toastr::success('Testimonial added successfully!', ['title' => 'Success']);
            return redirect()->route('backend.testimonials.index');
        } catch (\Exception $e) {
            Toastr::error('Something went wrong: ' . $e->getMessage(), ['title' => 'Error']);
            return back()->withInput();
        }
    }

    public function edit(Testimonials $testimonial)
    {
        return view('backend.pages.testimonials.create', compact('testimonial'));
    }

    public function update(Request $request, Testimonials $testimonial)
    {
        $validated = $request->validate([
            'name_en'        => 'required|string|max:255',
            'designation_en' => 'nullable|string|max:255',
            'review_en'      => 'nullable|string',
            'name_mk'        => 'nullable|string|max:255',
            'designation_mk' => 'nullable|string|max:255',
            'review_mk'      => 'nullable|string',
            'name_al'        => 'nullable|string|max:255',
            'designation_al' => 'nullable|string|max:255',
            'review_al'      => 'nullable|string',
            'image'          => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
        ]);

        $data = [
            'name' => [
                'en' => $validated['name_en'],
                'mk' => $validated['name_mk'] ?? '',
                'al' => $validated['name_al'] ?? '',
            ],
            'designation' => [
                'en' => $validated['designation_en'] ?? '',
                'mk' => $validated['designation_mk'] ?? '',
                'al' => $validated['designation_al'] ?? '',
            ],
            'review' => [
                'en' => $validated['review_en'] ?? '',
                'mk' => $validated['review_mk'] ?? '',
                'al' => $validated['review_al'] ?? '',
            ],
        ];

        try {
            if ($request->hasFile('image')) {
                if ($testimonial->image && Storage::disk('public')->exists($testimonial->image)) {
                    Storage::disk('public')->delete($testimonial->image);
                }
                $data['image'] = $request->file('image')->store('testimonials', 'public');
            }

            $testimonial->update($data);

            Toastr::success('Testimonial updated successfully!', ['title' => 'Success']);
            return redirect()->route('backend.testimonials.index');
        } catch (\Exception $e) {
            Toastr::error('Something went wrong: ' . $e->getMessage(), ['title' => 'Error']);
            return back()->withInput();
        }
    }

    public function destroy(Testimonials $testimonial)
    {
        try {
            if ($testimonial->image && Storage::disk('public')->exists($testimonial->image)) {
                Storage::disk('public')->delete($testimonial->image);
            }

            $testimonial->delete();

            Toastr::success('Testimonial deleted successfully!', ['title' => 'Success']);
            return redirect()->route('backend.testimonials.index');
        } catch (\Exception $e) {
            Toastr::error('Something went wrong: ' . $e->getMessage(), ['title' => 'Error']);
            return back();
        }
    }
}
