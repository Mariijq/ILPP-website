<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;

use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('frontend.pages.contact');
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
            'Name' => 'required|string|max:255',
            'Email' => 'required|email|max:255',
            'Phone' => 'nullable|string|max:50',
            'Message' => 'required|string',
        ]);

        ContactMessage::create([
            'name' => $request->Name,
            'email' => $request->Email,
            'phone' => $request->Phone,
            'message' => $request->Message,
        ]);

        return redirect()->back()->with('success', 'Your message has been sent!');

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
        //
    }
}
