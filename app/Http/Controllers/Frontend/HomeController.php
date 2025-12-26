<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\GalleryImage;
use App\Models\Project;
use App\Models\Publication;
use App\Models\Slide;
use App\Models\Testimonials;

class HomeController extends Controller
{
    public function index()
    {
        // Get latest testimonials
        $testimonials = Testimonials::get();

        // Get latest slides with news and map data for frontend
        $slides = Slide::with('news')
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($slide) {
                return [
                    'title' => $slide->title,
                    'subtitle' => $slide->subtitle,
                    'date' => $slide->date
                        ? \Carbon\Carbon::parse($slide->date)->format('F d, Y')
                        : ($slide->news?->date ? \Carbon\Carbon::parse($slide->news->date)->format('F d, Y') : $slide->created_at->format('F d, Y')),
                    'image' => $slide->image ? asset('storage/'.$slide->image) : 'https://via.placeholder.com/1200x400',
                    'link' => $slide->news ? route('news-details', $slide->news->id) : '#',
                ];
            });
        // Get latest 6 projects
        $projects = Project::latest()->take(3)->get();
        $publications = Publication::latest()->take(3)->get();
        $galleryImages = GalleryImage::latest()->get(); // fetch all gallery images

        return view('frontend.pages.home', compact('testimonials', 'slides', 'projects', 'publications', 'galleryImages'));
    }
}
