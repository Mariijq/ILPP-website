<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Project;
use App\Models\Publication;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = trim($request->input('q'));

        if (! $query) {
            return redirect()->back()->with('error', 'Please enter a search term.');
        }

        $locale = app()->getLocale();

        // Models that SHOULD appear in frontend search
        $searchMap = [
            'News' => [
                'model' => News::class,
                'route' => 'news-details',
                'image' => 'image',
            ],
            'Projects' => [
                'model' => Project::class,
                'route' => 'project-details',
                'image' => 'image',
            ],
            'Publications' => [
                'model' => Publication::class,
                'route' => 'publication-details',
                'image' => 'image',
            ],
        ];

        $results = collect();

        foreach ($searchMap as $group => $config) {
            $items = $config['model']::search($query)->get();

            if ($items->isEmpty()) {
                continue;
            }

            $normalized = $items->map(function ($item) use ($config, $locale) {
                // Normalize title
                $rawTitle = $item->title ?? $item->name ?? null;

                if (is_array($rawTitle)) {
                    $title = $rawTitle[$locale] ?? $rawTitle['en'] ?? null;
                } else {
                    $title = $rawTitle;
                }

                if (! $title) {
                    return null;
                }

                // Normalize image
                $imageField = $config['image'];
                $imagePath = $item->{$imageField} ?? null;

                return [
                    'title' => $title,
                    'image' => $imagePath
                        ? asset('storage/'.$imagePath)
                        : asset(''),
                    'link' => $config['route']
                        ? route($config['route'], $item->id)
                        : '#',
                ];
            })->filter();

            if ($normalized->isNotEmpty()) {
                $results->put($group, $normalized);
            }
        }

        return view('frontend.pages.search.results', [
            'query' => $query,
            'results' => $results,
        ]);
    }
}
