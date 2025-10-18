@extends('backend.layout')

@section('title', 'View News')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3>View Projects</h3>
        <a href="{{ route('projects.index') }}" class="btn btn-secondary btn-sm">Back to List</a>
    </div>

    <div class="card-body show">
        <div class="mb-3">
            <label class="fw-bold">Title:</label>
            <p>{{ $projects->title }}</p>
        </div>


        <div class="mb-3">
            <label class="fw-bold">Date:</label>
            <p>{{ $projects->date ? \Carbon\Carbon::parse($projects->date)->format('d M Y') : '-' }}</p>
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
                    <img src="{{ asset('storage/'.$projects->image) }}" class="show-img">
                @else
                    <span class="text-muted">No Image</span>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
