<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Project;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function index(){
        $ongoingProjects = Project::where('status', 'ongoing')->latest()->get();
        $finishedProjects = Project::where('status', 'finished')->latest()->get();

        return view('frontend.pages.projects', compact('ongoingProjects', 'finishedProjects'));
    }

    public function show($id)
{
    $project = Project::findOrFail($id);
    $recentProjects = Project::latest()->take(5)->get();

    return view('frontend.pages.project-details', compact('project', 'recentProjects'));
}

}
