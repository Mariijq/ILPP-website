@extends('backend.layouts.layout')

@section('title', 'News Details')

@section('content')
<div class="card">
    <div class="card-header d-flex">
        <a href="{{ route('backedn.news.index') }}" class="btn btn-secondary ms-auto">Back to List</a>
    </div>

    <div class="card-body show">

        {{-- TITLE --}}
        <div class="mb-3">
            <label class="fw-bold">Title:</label>
            <p>{{ $news->title }}</p>
        </div>

        {{-- SUBTITLE --}}
        <div class="mb-3">
            <label class="fw-bold">Subtitle:</label>
            <p>{{ $news->subtitle ?? '-' }}</p>
        </div>

        {{-- DATE --}}
        <div class="mb-3">
            <label class="fw-bold">Date:</label>
            <p>{{ $news->date ? \Carbon\Carbon::parse($news->date)->format('d M Y') : '-' }}</p>
        </div>

        {{-- SHORT DESCRIPTION --}}
        <div class="mb-3">
            <label class="fw-bold">Short Description:</label>
            <p>{{ $news->short_description ?? '-' }}</p>
        </div>

        {{-- DETAILED DESCRIPTION --}}
        <div class="mb-3">
            <label class="fw-bold">Detailed Description:</label>
            <div>{!! $news->detailed_description ?? '<em>No content</em>' !!}</div>
        </div>

        {{-- MAIN IMAGE --}}
        <div class="mb-3">
            <label class="fw-bold">Main Image:</label>
            <div>
                @if($news->image && file_exists(storage_path('app/public/'.$news->image)))
                    <img src="{{ asset('storage/'.$news->image) }}"
                         class="show-img"
                         style="width:150px;height:150px;object-fit:cover;border-radius:6px;">
                @else
                    <span class="text-muted">No Image</span>
                @endif
            </div>
        </div>

        {{-- ADDITIONAL MEDIA --}}
        <div class="mb-3">
            <label class="fw-bold">Additional Images / Files:</label>

            @if($news->media->count() > 0)
                <div class="d-flex flex-wrap gap-3">
                    @foreach($news->media as $media)
                        <div class="border p-2 rounded" style="width:160px;text-align:center;">

                            @php
                                $path = 'storage/' . $media->path;
                                $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
                                $isImage = in_array($ext, ['jpg','jpeg','png','gif','webp']);
                            @endphp

                            @if($isImage)
                                <img src="{{ asset($path) }}"
                                    style="width:150px;height:150px;object-fit:cover;border-radius:6px;">
                            @else
                                <div class="p-3 bg-light rounded" style="height:150px;display:flex;align-items:center;justify-content:center;">
                                    <i class="fas fa-file fa-3x text-secondary"></i>
                                </div>
                            @endif

                            <div class="mt-2">
                                <a href="{{ asset($path) }}" download class="btn btn-sm btn-primary w-100">
                                    Download
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-muted">No additional files uploaded.</p>
            @endif
        </div>

    </div>
</div>
@endsection
