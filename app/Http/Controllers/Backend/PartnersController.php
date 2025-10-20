<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\PartnerDataTable;
use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;

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
        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('partners', 'public');
        }

        Partner::create($data);

        return redirect()->route('partners.index')->with('success', 'Partner created successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('backend.partners.show', compact('partner'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('backend.partners.create', compact('partner'));

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

        if ($request->hasFile('logo')) {
            // Delete old logo if exists
            if ($partner->logo && Storage::disk('public')->exists($partner->logo)) {
                Storage::disk('public')->delete($partner->logo);
            }
            $data['logo'] = $request->file('logo')->store('partners', 'public');
        }

        $partner->update($data);

        return redirect()->route('partners.index')->with('success', 'Partner updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if ($partner->logo && Storage::disk('public')->exists($partner->logo)) {
            Storage::disk('public')->delete($partner->logo);
        }

        $partner->delete();

        return redirect()->route('partners.index')->with('success', 'Partner deleted successfully.');

    }
}
