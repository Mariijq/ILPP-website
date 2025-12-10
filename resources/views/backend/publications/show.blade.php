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

        <div class="mb-3">
            <label class="fw-bold">File:</label>
            <div>
                @if($publications->file && file_exists(storage_path('app/public/'.$publications->file)))
                    <div class="d-flex gap-2">
                        <a href="{{ route('publications.open', $publications->id) }}" target="_blank" class="btn btn-secondary">
                            <i class="bi bi-eye"></i> Open File
                        </a>
                        <a href="{{ route('publications.download', $publications->id) }}" class="btn btn-custom">
                            <i class="bi bi-download"></i> Download File
                        </a>
                    </div>
                @else
                    <span class="text-muted">No File</span>
                @endif
            </div>
        </div>

    </div>
</div>
@endsection
