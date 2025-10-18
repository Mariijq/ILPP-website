<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Project;
use App\Models\TeamMember;
use App\Models\GalleryImage;



class AdminController extends Controller
{
      public function index()
    {
        $newsCount = News::count();
        $projectsCount = Project::count();
        $teamMembersCount = TeamMember::count();
        $galleryCount = GalleryImage::count();

        return view('backend.dashboard', compact('newsCount', 'projectsCount', 'teamMembersCount', 'galleryCount'));
    }


}
