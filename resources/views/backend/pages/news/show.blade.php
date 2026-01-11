@extends('backend.layouts.layout')

@section('title', 'News Details')

@php $locale = app()->getLocale(); @endphp

@section('content')

<div class="card">
    <div class="card-header d-flex align-items-center">
        <h5 class="mb-0">News Details</h5>
        <a href="{{ route('backend.news.index') }}" class="btn btn-secondary ms-auto">
            Back to List
        </a>
    </div>

    <div class="card-body">

        {{-- TITLE --}}
        <div class="mb-3">
            <label class="fw-bold">Title:</label>
            <p>
                {{ $news->title[$locale] ?? $news->title['en'] ?? '-' }}
            </p>
        </div>

        {{-- SUBTITLE --}}
        <div class="mb-3">
            <label class="fw-bold">Subtitle:</label>
            <p>
                {{ $news->subtitle[$locale] ?? $news->subtitle['en'] ?? '-' }}
            </p>
        </div>

        {{-- DATE --}}
        <div class="mb-3">
            <label class="fw-bold">Date:</label>
            <p>
                {{ $news->date ? \Carbon\Carbon::parse($news->date)->format('d M Y') : '-' }}
            </p>
        </div>

        {{-- SHORT DESCRIPTION --}}
        <div class="mb-3">
            <label class="fw-bold">Short Description:</label>
            <p>
                {{ $news->short_description[$locale] ?? $news->short_description['en'] ?? '-' }}
            </p>
        </div>

        {{-- DETAILED DESCRIPTION --}}
        <div class="mb-3">
            <label class="fw-bold">Detailed Description:</label>
            <div class="border rounded p-3 bg-light">
                {!! $news->detailed_description[$locale]
                    ?? $news->detailed_description['en']
                    ?? '<em>No content</em>' !!}
            </div>
        </div>

        {{-- MAIN IMAGE --}}
        <div class="mb-4">
            <label class="fw-bold">Main Image:</label>
            <div class="mt-2">
                @if($news->image && file_exists(storage_path('app/public/'.$news->image)))
                    <img src="{{ asset('storage/'.$news->image) }}"
                         style="width:150px;height:150px;object-fit:cover;border-radius:6px;">
                @else
                    <span class="text-muted">No Image</span>
                @endif
            </div>
        </div>

        {{-- ADDITIONAL MEDIA --}}
        <div class="mb-3">
            <label class="fw-bold">Additional Images / Files:</label>

            @if($news->media && $news->media->count())
                <div class="d-flex flex-wrap gap-3 mt-2">
                    @foreach($news->media as $media)

                        @php
                            $path = 'storage/' . $media->path;
                            $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
                            $isImage = in_array($ext, ['jpg','jpeg','png','gif','webp']);
                        @endphp

                        <div class="border p-2 rounded" style="width:160px;text-align:center;">

                            @if($isImage)
                                <img src="{{ asset($path) }}"
                                     style="width:150px;height:150px;object-fit:cover;border-radius:6px;">
                            @else
                                <div class="bg-light rounded d-flex align-items-center justify-content-center"
                                     style="height:150px;">
                                    <i class="bi bi-file-earmark fs-1 text-secondary"></i>
                                </div>
                            @endif

                            <a href="{{ asset($path) }}"
                               download
                               class="btn btn-sm btn-primary w-100 mt-2">
                                Download
                            </a>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-muted mt-2">No additional files uploaded.</p>
            @endif
        </div>

    </div>
</div>

@endsection
