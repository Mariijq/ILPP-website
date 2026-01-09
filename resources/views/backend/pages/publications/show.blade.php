@extends('backend.layouts.layout')

@section('title', 'Publication Details')

@section('content')
<div class="card">
    <div class="card-header d-flex">
        <a href="{{ route('backend.publications.index') }}" class="btn btn-secondary ms-auto">Back to List</a>
    </div>

    <div class="card-body show">

        {{-- TITLE --}}
        <div class="mb-3">
            <label class="fw-bold">Title:</label>
            <p>{{ $publication->title[app()->getLocale()] ?? $publication->title['en'] }}</p>
        </div>

        {{-- DATE --}}
        <div class="mb-3">
            <label class="fw-bold">Date:</label>
            <p>{{ $publication->date ? \Carbon\Carbon::parse($publication->date)->format('d M Y') : '-' }}</p>
        </div>

        {{-- SHORT DESCRIPTION --}}
        <div class="mb-3">
            <label class="fw-bold">Short Description:</label>
            <p>{{ $publication->short_description[app()->getLocale()] ?? $publication->short_description['en'] ?? '-' }}</p>
        </div>

        {{-- DETAILED DESCRIPTION --}}
        <div class="mb-3">
            <label class="fw-bold">Detailed Description:</label>
            <div>{!! $publication->detailed_description[app()->getLocale()] ?? $publication->detailed_description['en'] ?? '<em>No content</em>' !!}</div>
        </div>

        {{-- MAIN IMAGE --}}
        <div class="mb-3">
            <label class="fw-bold">Main Image:</label>
            <div>
                @if($publication->image && file_exists(storage_path('app/public/'.$publication->image)))
                    <img src="{{ asset('storage/'.$publication->image) }}"
                         class="show-img"
                         style="width:150px;height:150px;object-fit:cover;border-radius:6px;">
                @else
                    <span class="text-muted">No Image</span>
                @endif
            </div>
        </div>

        {{-- PDF FILE --}}
        <div class="mb-3">
            <label class="fw-bold">PDF File:</label>
            <div>
                @if($publication->file && file_exists(storage_path('app/public/'.$publication->file)))
                    <a href="{{ asset('storage/'.$publication->file) }}" class="btn btn-primary" target="_blank">Download PDF</a>
                @else
                    <span class="text-muted">No File</span>
                @endif
            </div>
        </div>

    </div>
</div>
@endsection
