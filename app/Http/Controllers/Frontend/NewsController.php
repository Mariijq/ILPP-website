<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\News;

class NewsController extends Controller
{
    public function index()
    {
        // Get all news, ordered by date descending
        $news = News::orderBy('date', 'desc')->paginate(9);

        return view('frontend.pages.news', compact('news'));
    }

    public function show($id)
    {
        $newsItem = News::findOrFail($id);

        $recentNews = News::where('id', '!=', $id)
            ->orderBy('date', 'desc')
            ->take(5)
            ->get();

        return view('frontend.pages.news-details', compact('newsItem', 'recentNews'));
    }
}
