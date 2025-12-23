<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\PartnerDataTable;
use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Toastr;

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
        $validated = $request->validate([
            'name_en' => 'required|string|max:255',
            'name_mk' => 'nullable|string|max:255',
            'name_al' => 'nullable|string|max:255',
            'website' => 'nullable|url|max:255',
            'order' => 'nullable|integer',
            'logo' => 'nullable|image|max:2048',
            'type' => 'required|in:Funding & Support,Strategic Partners',
        ]);

        $data = [
            'name' => json_encode([
                'en' => $validated['name_en'],
                'mk' => $validated['name_mk'] ?? '',
                'al' => $validated['name_al'] ?? '',
            ], JSON_UNESCAPED_UNICODE),
            'type' => $validated['type'],
            'website' => $validated['website'] ?? null,
            'order' => $validated['order'] ?? 0,
        ];

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('partners', 'public');
        }

        Partner::create($data);

        Toastr::success('Partner added successfully');

        return redirect()->route('partners.index');
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
    public function update(Request $request, $id)
    {
        $partner = Partner::findOrFail($id);

        $validated = $request->validate([
            'name_en' => 'required|string|max:255',
            'name_mk' => 'nullable|string|max:255',
            'name_al' => 'nullable|string|max:255',
            'website' => 'nullable|url|max:255',
            'order' => 'nullable|integer',
            'logo' => 'nullable|image|max:2048',
            'type' => 'required|in:Funding & Support,Strategic Partners',
        ]);

        $data = [
            'name' => json_encode([
                'en' => $validated['name_en'],
                'mk' => $validated['name_mk'] ?? '',
                'al' => $validated['name_al'] ?? '',
            ], JSON_UNESCAPED_UNICODE),
            'type' => $validated['type'],
            'website' => $validated['website'] ?? null,
            'order' => $validated['order'] ?? 0,
        ];

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('partners', 'public');
        }

        $partner->update($data);

        Toastr::success('Partner updated successfully');

        return redirect()->route('partners.index');
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
            Toastr::success('Partner deleted successfully!', ['title' => 'Success']);

            return redirect()->route('partners.index');

        } catch (\Exception $e) {
            Toastr::error('Something went wrong: '.$e->getMessage(), ['title' => 'Error']);

            return back()->withInput();
        }

    }
}
