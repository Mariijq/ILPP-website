<?php

namespace App\Http\Controllers\Backend;

use Toastr;
use App\Http\Controllers\Controller;
use App\Models\News;
use App\DataTables\NewsDataTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(NewsDataTable $dataTable)
    {
        return $dataTable->render('backend.news.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.news.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'date' => 'required|date',
            'short_description' => 'nullable|string|max:500',
            'detailed_description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ]);

        try {
            if ($request->hasFile('image')) {
                $path = $request->file('image')->store('news_images', 'public');
                $validated['image'] = $path;
            }

            News::create($validated);

            Toastr::success('News added successfully!', ['title'=>'Success']);
            return redirect()->route('news.index');

        } catch (\Exception $e) {
            Toastr::error('Something went wrong: '.$e->getMessage(), ['title'=>'success']);
            return back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $news = News::findOrFail($id);
        return view('backend.news.show', compact('news'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $news = News::findOrFail($id);
        return view('backend.news.edit', compact('news'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $news = News::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'date' => 'required|date',
            'short_description' => 'nullable|string|max:500',
            'detailed_description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ]);

        try {
            if ($request->hasFile('image')) {
                if ($news->image && Storage::disk('public')->exists($news->image)) {
                    Storage::disk('public')->delete($news->image);
                }
                $path = $request->file('image')->store('news_images', 'public');
                $validated['image'] = $path;
            }

            $news->update($validated);

            Toastr::success('News updated successfully!', ['title'=>'Success']);
            return redirect()->route('news.index');

        } catch (\Exception $e) {
            Toastr::error('Something went wrong: '.$e->getMessage(), ['title'=>'Error']);
            return back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $news = News::findOrFail($id);

        try {
            if ($news->image && Storage::disk('public')->exists($news->image)) {
                Storage::disk('public')->delete($news->image);
            }

            $news->delete();

            Toastr::success('News deleted successfully!', ['title'=>'Success']);
            return redirect()->route('news.index');

        } catch (\Exception $e) {
            Toastr::error('Something went wrong: '.$e->getMessage(), ['title'=>'Error']);
            return back();
        }
    }
}
