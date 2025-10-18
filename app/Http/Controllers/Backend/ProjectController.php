<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\DataTables\ProjectsDataTable;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ProjectsDataTable $dataTable)
    {
        return $dataTable->render('backend.projects.index');

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.projects.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'short_description' => 'nullable|string|max:500',
            'detailed_description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('projects_images', 'public');
            $validated['image'] = $path;
        }

        // Create projects
        Project::create($validated);

        return redirect()->route('projects.index')->with('success', 'projects created successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $projects = Project::findOrFail($id);

        return view('backend.projects.show', compact('projects'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $projects = Project::findOrFail($id);

        return view('backend.projects.edit', compact('projects'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $projects = Project::findOrFail($id);

        // Validate input
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'short_description' => 'nullable|string|max:500',
            'detailed_description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($projects->image && Storage::disk('public')->exists($projects->image)) {
                Storage::disk('public')->delete($projects->image);
            }
            $path = $request->file('image')->store('projects_images', 'public');
            $validated['image'] = $path;
        }

        // Update projects
        $projects->update($validated);

        return redirect()->route('projects.index')->with('success', 'projects updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $projects = Project::findOrFail($id);
        $projects->delete();

        return redirect()->route('projects.index')->with('success', 'projects deleted successfully.');

    }
}
