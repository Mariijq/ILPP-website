<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ContactInfo;
use Illuminate\Http\Request;

class ContactInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contact = ContactInfo::first();

        return view('backend.contact-info.index', compact('contact'));

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
        //
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
    public function update(Request $request)
    {
    $contact = ContactInfo::first() ?? new ContactInfo();

    $request->validate([
        'address' => 'nullable|string',
        'email' => 'nullable|email',
        'phone' => 'nullable|string',
        'facebook' => 'nullable|url',
        'instagram' => 'nullable|url',
        'linkedin' => 'nullable|url',
        'map_embed' => 'nullable|string',
    ]);

    $contact->fill($request->all());
    $contact->save();

    return redirect()->route('contact-info.index')->with('success', 'Contact info saved successfully!');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
