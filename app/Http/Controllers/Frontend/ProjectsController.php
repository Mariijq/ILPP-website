<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Project;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
public function index() {
    $ongoingProjects = Project::where('status', 'ongoing')
        ->latest()
        ->paginate(8, ['*'], 'ongoingPage'); // custom query parameter

    $finishedProjects = Project::where('status', 'finished')
        ->latest()
        ->paginate(8, ['*'], 'finishedPage'); // custom query parameter

    return view('frontend.pages.projects', compact('ongoingProjects', 'finishedProjects'));
}
    public function show($id)
{
    $project = Project::findOrFail($id);
    $recentProjects = Project::latest()->take(5)->get();

    return view('frontend.pages.project-details', compact('project', 'recentProjects'));
}

}
