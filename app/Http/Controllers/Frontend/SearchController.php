<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use App\Models\ContactInfo;
use App\Models\ContactMessage;
use App\Models\Document;
use App\Models\GalleryImage;
use App\Models\History;
use App\Models\News;
use App\Models\Partner;
use App\Models\Project;
use App\Models\Publication;
use App\Models\WhatWeDo;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = trim($request->input('q'));

        if (! $query) {
            return redirect()->back()->with('error', 'Please enter a search term.');
        }

        // Optional shortcut redirects
        $lower = strtolower($query);
        if ($lower === 'news') return redirect()->route('news');
        if ($lower === 'projects') return redirect()->route('projects');
        if ($lower === 'publications') return redirect()->route('publications');

        // SEARCH ALL MODELS
        $allResults = [
            'About Us'         => AboutUs::search($query)->get(),
            'Contact Info'     => ContactInfo::search($query)->get(),
            'Contact Messages' => ContactMessage::search($query)->get(),
            'Documents'        => Document::search($query)->get(),
            'Gallery'          => GalleryImage::search($query)->get(),
            'History'          => History::search($query)->get(),
            'News'             => News::search($query)->get(),
            'Partners'         => Partner::search($query)->get(),
            'Projects'         => Project::search($query)->get(),
            'Publications'     => Publication::search($query)->get(),
            'What We Do'       => WhatWeDo::search($query)->get(),
        ];

        // FILTER OUT EMPTY RESULTS
        $results = collect($allResults)
            ->filter(fn($items) => $items->isNotEmpty());

        // ROUTE MAP for models with detail pages
        $routes = [
            'News'         => 'news-details',
            'Projects'     => 'project-details',
            'Publications' => 'publication-details',
        ];

        return view('frontend.pages.search.results', [
            'query'   => $query,
            'results' => $results,
            'routes'  => $routes,
        ]);
    }
}
