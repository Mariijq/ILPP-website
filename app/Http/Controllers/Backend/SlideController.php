<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Slide;
use App\DataTables\SlideDataTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Toastr;

class SlideController extends Controller
{
    // Show all slides
    public function index(SlideDataTable $dataTable)
    {
        return $dataTable->render('backend.slides.index');
    }

    // Create slide (select news)
    public function create()
    {
        $news = News::latest()->get(); // get all news
        $languages = ['en' => 'English', 'mk' => 'Macedonian', 'al' => 'Albanian'];
        return view('backend.slides.create', compact('news', 'languages'));
    }

    // Store new slide
    public function store(Request $request)
    {
        $languages = ['en', 'mk', 'al'];

        $request->validate([
            'news_id' => 'required|exists:news,id',
            'order' => 'nullable|integer',
        ]);

        $news = News::findOrFail($request->news_id);

        $title = [];
        $subtitle = [];

        foreach ($languages as $lang) {
            $title[$lang] = $news->title[$lang] ?? ($lang === 'en' ? $news->title['en'] : '');
            $subtitle[$lang] = $news->subtitle[$lang] ?? ($lang === 'en' ? $news->subtitle['en'] : '');
        }

        Slide::create([
            'news_id'  => $news->id,
            'title'    => $title,
            'subtitle' => $subtitle,
            'date'     => $news->date ?? $news->created_at->format('Y-m-d'),
            'image'    => $news->image,
            'order'    => $request->order ?? 0,
        ]);

        Toastr::success('Slide created successfully!');
        return redirect()->route('slides.index');
    }

    // Edit slide
    public function edit(Slide $slide)
    {
        $news = News::latest()->get();
        $languages = ['en' => 'English', 'mk' => 'Macedonian', 'al' => 'Albanian'];
        return view('backend.slides.create', compact('slide', 'news', 'languages'));
    }

    // Update slide
    public function update(Request $request, Slide $slide)
    {
        $languages = ['en', 'mk', 'al'];

        $request->validate([
            'news_id' => 'required|exists:news,id',
            'order' => 'nullable|integer',
        ]);

        $news = News::findOrFail($request->news_id);

        $title = [];
        $subtitle = [];

        foreach ($languages as $lang) {
            $title[$lang] = $news->title[$lang] ?? ($lang === 'en' ? $news->title['en'] : '');
            $subtitle[$lang] = $news->subtitle[$lang] ?? ($lang === 'en' ? $news->subtitle['en'] : '');
        }

        $slide->update([
            'news_id'  => $news->id,
            'title'    => $title,
            'subtitle' => $subtitle,
            'date'     => $news->date ?? $news->created_at->format('Y-m-d'),
            'image'    => $news->image,
            'order'    => $request->order ?? 0,
        ]);

        Toastr::success('Slide updated successfully!');
        return redirect()->route('slides.index');
    }

    // Delete slide
    public function destroy(Slide $slide)
    {
        if ($slide->image && Storage::disk('public')->exists($slide->image)) {
            Storage::disk('public')->delete($slide->image);
        }

        $slide->delete();

        Toastr::success('Slide deleted successfully!');
        return redirect()->route('slides.index');
    }
}
