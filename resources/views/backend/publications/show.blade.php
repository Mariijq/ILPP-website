@extends('backend.layout')

@section('title', 'Publications')

@section('content')
<div class="card">
    <div class="card-header d-flex ">
        <a href="{{ route('publications.index') }}" class="btn btn-secondary ms-auto">Back to List</a>
    </div>

    <div class="card-body show">
        <div class="mb-3">
            <label class="fw-bold">Title:</label>
            <p>{{ $publications->title }}</p>
        </div>


        <div class="mb-3">
            <label class="fw-bold">Date:</label>
            <p>{{ $publications->date ? \Carbon\Carbon::parse($publications->date)->format('d M Y') : '-' }}</p>
        </div>

        <div class="mb-3">
            <label class="fw-bold">Short Description:</label>
            <p>{{ $publications->short_description ?? '-' }}</p>
        </div>

        <div class="mb-3">
            <label class="fw-bold">Detailed Description:</label>
            <div>{!! $publications->detailed_description ?? '<em>No content</em>' !!}</div>
        </div>

        <div class="mb-3">
            <label class="fw-bold">Image:</label>
            <div>
                @if($publications->image && file_exists(storage_path('app/public/'.$publications->image)))
                    <img src="{{ asset('storage/'.$publications->image) }}" class="show-img">
                @else
                    <span class="text-muted">No Image</span>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
