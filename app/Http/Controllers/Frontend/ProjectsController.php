<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Project;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    /**
     * Display a paginated list of all projects.
     */
    public function index()
    {
        $locale = app()->getLocale();

        // Fetch all projects ordered by latest
        $projects = Project::latest()->paginate(8); // change 8 to whatever per-page limit you want

        return view('frontend.pages.projects', compact('projects', 'locale'));
    }

    /**
     * Single Project Details
     */
    public function show($id)
    {
        $project = Project::findOrFail($id);
        $recentProjects = Project::latest()->take(5)->get();

        return view('frontend.pages.project-details', compact('project', 'recentProjects'));
    }
}
