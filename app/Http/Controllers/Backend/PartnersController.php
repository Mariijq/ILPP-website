<?php

namespace App\Http\Controllers\Backend;

use Toastr;
use App\DataTables\PartnerDataTable;
use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PartnersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PartnerDataTable $dataTable)
    {
        return $dataTable->render('backend.partners.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.partners.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|max:2048',
            'type' => 'required|in:person,organization',
            'website' => 'nullable|url|max:255',
            'order' => 'nullable|integer',
        ]);

        try {
            if ($request->hasFile('logo')) {
                $data['logo'] = $request->file('logo')->store('partners', 'public');
            }

            Partner::create($data);
            Toastr::success('Partner added successfully', ['title'=>'Success']);

            return redirect()->route('partners.index');

        } catch (\Exception $e) {
            Toastr::error('Something went wrong: '.$e->getMessage(), ['title'=>'Error']);

            return back()->withInput();
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $partners = Partner::findOrFail($id);

        return view('backend.partners.show', compact('partners'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $partners = Partner::findOrFail($id);

        return view('backend.partners.create', compact('partners'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:person,organization',
            'website' => 'nullable|url|max:255',
            'order' => 'nullable|integer',
            'logo' => 'nullable|image|max:2048',
        ]);

        try {
            if ($request->hasFile('logo')) {
                // Delete old logo if exists
                if ($partners->logo && Storage::disk('public')->exists($partners->logo)) {
                    Storage::disk('public')->delete($partners->logo);
                }
                $data['logo'] = $request->file('logo')->store('partners', 'public');
            }

            $partners->update($data);
            Toastr::success('Partner updated successfully', ['title'=>'Success']);

            return redirect()->route('partners.index');

        } catch (\Exception $e) {
            Toastr::error('Something went wrong: '.$e->getMessage(), ['title'=>'Error']);

            return back()->withInput();
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {

            if ($partners->logo && Storage::disk('public')->exists($partner->logo)) {
                Storage::disk('public')->delete($partners->logo);
            }

            $partners->delete();
            Toastr::success('Partner deleted successfully!', ['title'=>'Success']);

            return redirect()->route('partners.index');

        } catch (\Exception $e) {
            Toastr::error('Something went wrong: '.$e->getMessage(), ['title'=>'Error']);

            return back()->withInput();
        }

    }
}
