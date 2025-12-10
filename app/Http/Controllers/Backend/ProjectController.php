<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ProjectsDataTable;
use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
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
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'date' => 'required|date',
                'short_description' => 'nullable|string|max:500',
                'detailed_description' => 'nullable|string',
                'status' => 'required|in:ongoing,finished',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
            ]);

            if ($request->hasFile('image')) {
                $validated['image'] = $request->file('image')->store('projects_images', 'public');
            }

            Project::create($validated);
            Toastr::success('Project added successfully!', ['title' => 'Success']);

            return redirect()->route('projects.index');

        } catch (ValidationException $e) {
            foreach ($e->errors() as $errors) {
                foreach ($errors as $error) {
                    Toastr::error($error, ['title' => 'Validation Error']);
                }
            }
            return back()->withInput();

        } catch (\Exception $e) {
            Toastr::error('Unable to add project: ' . $e->getMessage(), ['title' => 'Error']);
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
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'date' => 'required|date',
                'short_description' => 'nullable|string|max:500',
                'detailed_description' => 'nullable|string',
                'status' => 'required|in:ongoing,finished',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
            ]);

            if ($request->hasFile('image')) {
                if ($project->image && Storage::disk('public')->exists($project->image)) {
                    Storage::disk('public')->delete($project->image);
                }
                $validated['image'] = $request->file('image')->store('projects_images', 'public');
            }

            $project->update($validated);
            Toastr::success('Project updated successfully!', ['title' => 'Success']);

            return redirect()->route('projects.index');

        } catch (ValidationException $e) {
            foreach ($e->errors() as $errors) {
                foreach ($errors as $error) {
                    Toastr::error($error, ['title' => 'Validation Error']);
                }
            }
            return back()->withInput();

        } catch (\Exception $e) {
            Toastr::error('Unable to update project: ' . $e->getMessage(), ['title' => 'Error']);
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
            Toastr::error('Something went wrong: ' . $e->getMessage(), ['title' => 'Error']);
            return back();
        }
    }
}
