<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CareerCouncil;
use Illuminate\Support\Facades\Storage;
use Toastr;
use App\DataTables\CareerCouncilDataTable;

class CareerCouncilController extends Controller
{
    public function index(CareerCouncilDataTable $dataTable)
    {
        return $dataTable->render('backend.pages.career-councils.index');
    }

    public function create()
    {
        return view('backend.pages.career-councils.create');
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'title' => 'required|array',
                'title.en' => 'required|string|max:255',
                'title.mk' => 'nullable|string|max:255',
                'title.al' => 'nullable|string|max:255',
                'short_description' => 'nullable|array',
                'short_description.en' => 'nullable|string',
                'short_description.mk' => 'nullable|string',
                'short_description.al' => 'nullable|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
            ]);

            $careerCouncilData = [
                'title' => $validated['title'],
                'short_description' => $validated['short_description'] ?? ['en'=>'','mk'=>'','al'=>''],
            ];

            if ($request->hasFile('image')) {
                $careerCouncilData['image'] = $request->file('image')->store('career_councils','public');
            }

            CareerCouncil::create($careerCouncilData);

            Toastr::success('Career Council added successfully!', ['title'=>'Success']);
            return redirect()->route('backend.career-councils.index');

        } catch (\Exception $e) {
            Toastr::error('Something went wrong: '.$e->getMessage(), ['title'=>'Error']);
            return back()->withInput();
        }
    }

    public function edit(CareerCouncil $careerCouncil)
    {
        return view('backend.pages.career-councils.create', compact('careerCouncil'));
    }

    public function update(Request $request, CareerCouncil $careerCouncil)
    {
        try {
            $validated = $request->validate([
                'title' => 'required|array',
                'title.en' => 'required|string|max:255',
                'title.mk' => 'nullable|string|max:255',
                'title.al' => 'nullable|string|max:255',
                'short_description' => 'nullable|array',
                'short_description.en' => 'nullable|string',
                'short_description.mk' => 'nullable|string',
                'short_description.al' => 'nullable|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
            ]);

            $careerCouncilData = [
                'title' => $validated['title'],
                'short_description' => $validated['short_description'] ?? ['en'=>'','mk'=>'','al'=>''],
            ];

            if ($request->hasFile('image')) {
                if ($careerCouncil->image) {
                    Storage::disk('public')->delete($careerCouncil->image);
                }
                $careerCouncilData['image'] = $request->file('image')->store('career_councils','public');
            }

            $careerCouncil->update($careerCouncilData);

            Toastr::success('Career Council updated successfully!', ['title'=>'Success']);
            return redirect()->route('backend.career-councils.index');

        } catch (\Exception $e) {
            Toastr::error('Something went wrong: '.$e->getMessage(), ['title'=>'Error']);
            return back()->withInput();
        }
    }

    public function destroy(CareerCouncil $careerCouncil)
    {
        if ($careerCouncil->image) {
            Storage::disk('public')->delete($careerCouncil->image);
        }

        $careerCouncil->delete();

        Toastr::success('Career Council deleted successfully!', ['title'=>'Success']);
        return redirect()->route('backend.career-councils.index');
    }
}
