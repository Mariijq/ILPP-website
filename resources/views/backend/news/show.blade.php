@extends('backend.layout')

@section('title', 'View News')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3>View News</h3>
        <a href="{{ route('news.index') }}" class="btn btn-secondary btn-sm">Back to List</a>
    </div>

    <div class="card-body show">
        <div class="mb-3">
            <label class="fw-bold">Title:</label>
            <p>{{ $news->title }}</p>
        </div>

        <div class="mb-3">
            <label class="fw-bold">Subtitle:</label>
            <p>{{ $news->subtitle ?? '-' }}</p>
        </div>

        <div class="mb-3">
            <label class="fw-bold">Date:</label>
            <p>{{ $news->date ? \Carbon\Carbon::parse($news->date)->format('d M Y') : '-' }}</p>
        </div>

        <div class="mb-3">
            <label class="fw-bold">Short Description:</label>
            <p>{{ $news->short_description ?? '-' }}</p>
        </div>

        <div class="mb-3">
            <label class="fw-bold">Detailed Description:</label>
            <div>{!! $news->detailed_description ?? '<em>No content</em>' !!}</div>
        </div>

        <div class="mb-3">
            <label class="fw-bold">Image:</label>
            <div>
                @if($news->image && file_exists(storage_path('app/public/'.$news->image)))
                    <img src="{{ asset('storage/'.$news->image) }}" class="show-img">
                @else
                    <span class="text-muted">No Image</span>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
