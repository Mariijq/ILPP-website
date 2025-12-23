@extends('backend.layout')

@section('title', 'Project Details')

@section('content')
<div class="card">
    <div class="card-header d-flex">
        <a href="{{ route('projects.index') }}" class="btn btn-secondary ms-auto">Back to List</a>
    </div>

    <div class="card-body show">
        <div class="mb-3">
            <label class="fw-bold">Title:</label>
            <p>{{ $projects->title }}</p>
        </div>

        <div class="mb-3">
            <label class="fw-bold">Subtitle:</label>
            <p>{{ $projects->subtitle ?? '-' }}</p>
        </div>

        <div class="mb-3">
            <label class="fw-bold">Date:</label>
            <p>{{ $projects->date ? \Carbon\Carbon::parse($projects->date)->format('d M Y') : '-' }}</p>
        </div>

        <div class="mb-3">
            <label class="fw-bold">Status:</label>
            <p>{{ $projects->status ?? '-' }}</p>
        </div>

        <div class="mb-3">
            <label class="fw-bold">Short Description:</label>
            <p>{{ $projects->short_description ?? '-' }}</p>
        </div>

        <div class="mb-3">
            <label class="fw-bold">Detailed Description:</label>
            <div>{!! $projects->detailed_description ?? '<em>No content</em>' !!}</div>
        </div>

        <div class="mb-3">
            <label class="fw-bold">Image:</label>
            <div>
                @if($projects->image && file_exists(storage_path('app/public/'.$projects->image)))
                    <img src="{{ asset('storage/'.$projects->image) }}" class="show-img" style="width:150px;height:150px;object-fit:cover;border-radius:6px;">
                @else
                    <span class="text-muted">No Image</span>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
