<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\NewsDataTable;
use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Toastr;

class NewsController extends Controller
{
    public function index(NewsDataTable $dataTable)
    {
        return $dataTable->render('backend.news.index');
    }

    public function create()
    {
        return view('backend.news.create'); // Form for creating news
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'title_en' => 'required|string|max:255',
                'title_mk' => 'nullable|string|max:255',
                'title_al' => 'nullable|string|max:255',
                'subtitle_en' => 'nullable|string|max:255',
                'subtitle_mk' => 'nullable|string|max:255',
                'subtitle_al' => 'nullable|string|max:255',
                'date' => 'required|date',
                'short_description_en' => 'nullable|string|max:500',
                'short_description_mk' => 'nullable|string|max:500',
                'short_description_al' => 'nullable|string|max:500',
                'detailed_description_en' => 'nullable|string',
                'detailed_description_mk' => 'nullable|string',
                'detailed_description_al' => 'nullable|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
                'media.*' => 'nullable|file|mimes:jpeg,png,jpg,gif,webp,mp4,mov,avi|max:51200',
            ]);

            // Format date
            $validated['date'] = \Carbon\Carbon::parse($validated['date'])->format('Y-m-d');

            // Prepare JSON fields
            $newsData = [
                'title' => [
                    'en' => $validated['title_en'],
                    'mk' => $validated['title_mk'] ?? '',
                    'al' => $validated['title_al'] ?? '',
                ],
                'subtitle' => [
                    'en' => $validated['subtitle_en'] ?? '',
                    'mk' => $validated['subtitle_mk'] ?? '',
                    'al' => $validated['subtitle_al'] ?? '',
                ],
                'short_description' => [
                    'en' => $validated['short_description_en'] ?? '',
                    'mk' => $validated['short_description_mk'] ?? '',
                    'al' => $validated['short_description_al'] ?? '',
                ],
                'detailed_description' => [
                    'en' => $validated['detailed_description_en'] ?? '',
                    'mk' => $validated['detailed_description_mk'] ?? '',
                    'al' => $validated['detailed_description_al'] ?? '',
                ],
                'date' => $validated['date'],
            ];

            // Store main image
            if ($request->hasFile('image')) {
                $newsData['image'] = $request->file('image')->store('news_images', 'public');
            }

            $news = News::create($newsData);

            // Additional media
            if ($request->hasFile('media')) {
                foreach ($request->file('media') as $file) {
                    $type = strpos($file->getMimeType(), 'video') !== false ? 'video' : 'image';
                    $news->media()->create([
                        'type' => $type,
                        'path' => $file->store('news_media', 'public'),
                    ]);
                }
            }

            Toastr::success('News added successfully!', ['title' => 'Success']);

            return redirect()->route('news.index');

        } catch (\Exception $e) {
            Toastr::error('Something went wrong: '.$e->getMessage(), ['title' => 'Error']);

            return back()->withInput();
        }
    }

    public function show($id)
    {
        $news = News::findOrFail($id);

        return view('backend.news.show', compact('news'));
    }

    public function edit(string $id)
    {
        $news = News::with('media')->findOrFail($id);

        return view('backend.news.create', compact('news')); // same form for create/edit
    }

    public function update(Request $request, string $id)
    {
        $news = News::with('media')->findOrFail($id);

        try {
            $validated = $request->validate([
                'title_en' => 'required|string|max:255',
                'title_mk' => 'nullable|string|max:255',
                'title_al' => 'nullable|string|max:255',
                'subtitle_en' => 'nullable|string|max:255',
                'subtitle_mk' => 'nullable|string|max:255',
                'subtitle_al' => 'nullable|string|max:255',
                'date' => 'required|date',
                'short_description_en' => 'nullable|string|max:500',
                'short_description_mk' => 'nullable|string|max:500',
                'short_description_al' => 'nullable|string|max:500',
                'detailed_description_en' => 'nullable|string',
                'detailed_description_mk' => 'nullable|string',
                'detailed_description_al' => 'nullable|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
                'media.*' => 'nullable|file|mimes:jpeg,png,jpg,gif,webp,mp4,mov,avi|max:51200',
            ]);

            $validated['date'] = \Carbon\Carbon::parse($validated['date'])->format('Y-m-d');

            $newsData = [
                'title' => [
                    'en' => $validated['title_en'],
                    'mk' => $validated['title_mk'] ?? '',
                    'al' => $validated['title_al'] ?? '',
                ],
                'subtitle' => [
                    'en' => $validated['subtitle_en'] ?? '',
                    'mk' => $validated['subtitle_mk'] ?? '',
                    'al' => $validated['subtitle_al'] ?? '',
                ],
                'short_description' => [
                    'en' => $validated['short_description_en'] ?? '',
                    'mk' => $validated['short_description_mk'] ?? '',
                    'al' => $validated['short_description_al'] ?? '',
                ],
                'detailed_description' => [
                    'en' => $validated['detailed_description_en'] ?? '',
                    'mk' => $validated['detailed_description_mk'] ?? '',
                    'al' => $validated['detailed_description_al'] ?? '',
                ],
                'date' => $validated['date'],
            ];

            // Update main image
            if ($request->hasFile('image')) {
                if ($news->image && \Storage::disk('public')->exists($news->image)) {
                    \Storage::disk('public')->delete($news->image);
                }
                $newsData['image'] = $request->file('image')->store('news_images', 'public');
            }

            $news->update($newsData);

            // Add new media
            if ($request->hasFile('media')) {
                foreach ($request->file('media') as $file) {
                    $type = strpos($file->getMimeType(), 'video') !== false ? 'video' : 'image';
                    $news->media()->create([
                        'type' => $type,
                        'path' => $file->store('news_media', 'public'),
                    ]);
                }
            }

            Toastr::success('News updated successfully!', ['title' => 'Success']);

            return redirect()->route('news.index');

        } catch (\Exception $e) {
            Toastr::error('Something went wrong: '.$e->getMessage(), ['title' => 'Error']);

            return back()->withInput();
        }
    }

    public function destroy(string $id)
    {
        $news = News::with('media')->findOrFail($id);

        try {
            // Delete main image
            if ($news->image && Storage::disk('public')->exists($news->image)) {
                Storage::disk('public')->delete($news->image);
            }

            // Delete all media
            foreach ($news->media as $media) {
                if (Storage::disk('public')->exists($media->path)) {
                    Storage::disk('public')->delete($media->path);
                }
            }

            $news->delete();
            Toastr::success('News deleted successfully!', ['title' => 'Success']);

            return redirect()->route('news.index');

        } catch (\Exception $e) {
            Toastr::error('Something went wrong: '.$e->getMessage(), ['title' => 'Error']);

            return back();
        }
    }
}
