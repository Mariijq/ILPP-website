<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Project;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    // Current Projects
    public function current()
    {
        $locale = app()->getLocale();
        $currentProjects = Project::where('status', 'Current')
            ->latest()
            ->paginate(8, ['*'], 'currentPage');

        return view('frontend.pages.projects-current', compact('currentProjects', 'locale'));
    }

    // Completed Projects
    public function completed()
    {
        $locale = app()->getLocale();
        $completedProjects = Project::where('status', 'Completed')
            ->latest()
            ->paginate(8, ['*'], 'completedPage');

        return view('frontend.pages.projects-completed', compact('completedProjects', 'locale'));
    }

    // Single Project Details
    public function show($id)
    {
        $project = Project::findOrFail($id);
        $recentProjects = Project::latest()->take(5)->get();

        return view('frontend.pages.project-details', compact('project', 'recentProjects'));
    }
}
