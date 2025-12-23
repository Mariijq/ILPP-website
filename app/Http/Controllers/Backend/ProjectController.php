<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ProjectsDataTable;
use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Toastr;

class ProjectController extends Controller
{
    public function index(ProjectsDataTable $dataTable)
    {
        return $dataTable->render('backend.projects.index');
    }

    public function create()
    {
        return view('backend.projects.create');
    }

    public function store(Request $request)
    {
        try {
            // Multilingual validation
            $validated = $request->validate([
                'title_en' => 'required|string|max:255',
                'title_mk' => 'nullable|string|max:255',
                'title_al' => 'nullable|string|max:255',
                'short_description_en' => 'nullable|string|max:500',
                'short_description_mk' => 'nullable|string|max:500',
                'short_description_al' => 'nullable|string|max:500',
                'detailed_description_en' => 'nullable|string',
                'detailed_description_mk' => 'nullable|string',
                'detailed_description_al' => 'nullable|string',
                'date' => 'required|date',
                'status' => 'required|in:Current,Completed',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
            ]);

            // Handle image upload
            if ($request->hasFile('image')) {
                $validated['image'] = $request->file('image')->store('projects_images', 'public');
            }

            // Create project
            Project::create([
                'title' => [
                    'en' => $validated['title_en'],
                    'mk' => $validated['title_mk'] ?? '',
                    'al' => $validated['title_al'] ?? '',
                ],
                'short_description' => [
                    'en' => $validated['short_description_en'] ?? '',
                    'mk' => $validated['short_description_mk'] ?? '',
                    'al' => $validated['short_description_al'] ?? '',
                ],
                'detailed_description' => [
                    'en' => $validated['detailed_description_en'] ?? '',
                    'mk' => $validated['detailed_description_mk'] ?? '',
                    'al' => $validated['detailed_description_al'] ?? '',
                ],
                'date' => $validated['date'],
                'status' => $validated['status'],
                'image' => $validated['image'] ?? null,
            ]);

            Toastr::success('Project added successfully!', ['title' => 'Success']);

            return redirect()->route('projects.index');

        } catch (\Illuminate\Validation\ValidationException $e) {
            foreach ($e->errors() as $errors) {
                foreach ($errors as $error) {
                    Toastr::error($error, ['title' => 'Validation Error']);
                }
            }

            return back()->withInput();

        } catch (\Exception $e) {
            Toastr::error('Unable to add project: '.$e->getMessage(), ['title' => 'Error']);

            return back()->withInput();
        }
    }

    public function show(string $id)
    {
        $projects = Project::findOrFail($id);

        return view('backend.projects.show', compact('projects'));
    }

    public function edit($id)
    {
        $project = Project::findOrFail($id);

        return view('backend.projects.create', compact('project'));
    }

    public function update(Request $request, $id)
    {
        $project = Project::findOrFail($id);

        try {
            // Multilingual validation
            $validated = $request->validate([
                'title_en' => 'required|string|max:255',
                'title_mk' => 'nullable|string|max:255',
                'title_al' => 'nullable|string|max:255',
                'short_description_en' => 'nullable|string|max:500',
                'short_description_mk' => 'nullable|string|max:500',
                'short_description_al' => 'nullable|string|max:500',
                'detailed_description_en' => 'nullable|string',
                'detailed_description_mk' => 'nullable|string',
                'detailed_description_al' => 'nullable|string',
                'date' => 'required|date',
                'status' => 'required|in:Current,Completed',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
            ]);

            // Handle image upload
            if ($request->hasFile('image')) {
                if ($project->image && Storage::disk('public')->exists($project->image)) {
                    Storage::disk('public')->delete($project->image);
                }
                $validated['image'] = $request->file('image')->store('projects_images', 'public');
            }

            // Update project
            $project->update([
                'title' => [
                    'en' => $validated['title_en'],
                    'mk' => $validated['title_mk'] ?? '',
                    'al' => $validated['title_al'] ?? '',
                ],
                'short_description' => [
                    'en' => $validated['short_description_en'] ?? '',
                    'mk' => $validated['short_description_mk'] ?? '',
                    'al' => $validated['short_description_al'] ?? '',
                ],
                'detailed_description' => [
                    'en' => $validated['detailed_description_en'] ?? '',
                    'mk' => $validated['detailed_description_mk'] ?? '',
                    'al' => $validated['detailed_description_al'] ?? '',
                ],
                'date' => $validated['date'],
                'status' => $validated['status'],
                'image' => $validated['image'] ?? $project->image,
            ]);

            Toastr::success('Project updated successfully!', ['title' => 'Success']);

            return redirect()->route('projects.index');

        } catch (\Illuminate\Validation\ValidationException $e) {
            foreach ($e->errors() as $errors) {
                foreach ($errors as $error) {
                    Toastr::error($error, ['title' => 'Validation Error']);
                }
            }

            return back()->withInput();

        } catch (\Exception $e) {
            Toastr::error('Unable to update project: '.$e->getMessage(), ['title' => 'Error']);

            return back()->withInput();
        }
    }

    public function destroy($id)
    {
        $project = Project::findOrFail($id);

        try {
            if ($project->image && Storage::disk('public')->exists($project->image)) {
                Storage::disk('public')->delete($project->image);
            }

            $project->delete();
            Toastr::success('Project deleted successfully!', ['title' => 'Success']);

            return redirect()->route('projects.index');

        } catch (\Exception $e) {
            Toastr::error('Something went wrong: '.$e->getMessage(), ['title' => 'Error']);

            return back();
        }
    }
}
