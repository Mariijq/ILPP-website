<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\NewsDataTable;
use App\Http\Controllers\Controller;
use App\Models\News;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
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
                'title' => 'required|string|max:255',
                'subtitle' => 'nullable|string|max:255',
                'date' => 'required|date',
                'short_description' => 'nullable|string|max:500',
                'detailed_description' => 'nullable|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
                'media.*' => 'nullable|file|mimes:jpeg,png,jpg,gif,webp,mp4,mov,avi|max:51200',
            ]);

            // Format date properly
            $validated['date'] = Carbon::parse($validated['date'])->format('Y-m-d');

            // Store main image
            if ($request->hasFile('image')) {
                $validated['image'] = $request->file('image')->store('news_images', 'public');
            }

            $news = News::create($validated);

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

        } catch (ValidationException $e) {
            foreach ($e->errors() as $errors) {
                foreach ($errors as $error) {
                    Toastr::error($error, ['title' => 'Validation Error']);
                }
            }

            return back()->withInput();
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
                'title' => 'required|string|max:255',
                'subtitle' => 'nullable|string|max:255',
                'date' => 'required|date',
                'short_description' => 'nullable|string|max:500',
                'detailed_description' => 'nullable|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
                'media.*' => 'nullable|file|mimes:jpeg,png,jpg,gif,webp,mp4,mov,avi|max:51200',
            ]);

            // Format date properly
            $validated['date'] = Carbon::parse($validated['date'])->format('Y-m-d');

            // Update main image if uploaded
            if ($request->hasFile('image')) {
                if ($news->image && Storage::disk('public')->exists($news->image)) {
                    Storage::disk('public')->delete($news->image);
                }
                $validated['image'] = $request->file('image')->store('news_images', 'public');
            }

            // Remove 'media' key to prevent mass assignment error
            unset($validated['media']);

            $news->update($validated);

            // Add new additional media
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

        } catch (ValidationException $e) {
            foreach ($e->errors() as $errors) {
                foreach ($errors as $error) {
                    Toastr::error($error, ['title' => 'Validation Error']);
                }
            }

            return back()->withInput();
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
