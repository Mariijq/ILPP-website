<?php

namespace App\Http\Controllers\Frontend;

use App\Models\News;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index(){

        $news = News::orderBy('date', 'desc')->get();
        return view('frontend.pages.news', compact('news'));

    }

    public function show($id)
{
    $newsItem = News::findOrFail($id);
    return view('frontend.pages.news-details', compact('newsItem'));
}

}
