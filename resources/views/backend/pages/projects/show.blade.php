@extends('backend.layouts.layout')

@section('title', 'Project Details')

@php $locale = app()->getLocale(); @endphp

@section('content')

<div class="card">
    <div class="card-header d-flex align-items-center">
        <h5 class="mb-0">Project Details</h5>
        <a href="{{ route('backend.projects.index') }}" class="btn btn-secondary ms-auto">
            Back to List
        </a>
    </div>

    <div class="card-body show">

        {{-- TITLE --}}
        <div class="mb-3">
            <label class="fw-bold">Title:</label>
            <p>{{ $projects->title[$locale] ?? $projects->title['en'] ?? '-' }}</p>
        </div>

        {{-- DATE --}}
        <div class="mb-3">
            <label class="fw-bold">Date:</label>
            <p>{{ $projects->date ? \Carbon\Carbon::parse($projects->date)->format('d M Y') : '-' }}</p>
        </div>

        {{-- SHORT DESCRIPTION --}}
        <div class="mb-3">
            <label class="fw-bold">Short Description:</label>
            <p>{{ $projects->short_description[$locale] ?? $projects->short_description['en'] ?? '-' }}</p>
        </div>

        {{-- DETAILED DESCRIPTION --}}
        <div class="mb-3">
            <label class="fw-bold">Detailed Description:</label>
            <div class="border rounded p-3 bg-light">
                {!! $projects->detailed_description[$locale] ?? $projects->detailed_description['en'] ?? '<em>No content</em>' !!}
            </div>
        </div>

        {{-- MAIN IMAGE --}}
        <div class="mb-3">
            <label class="fw-bold">Image:</label>
            <div class="mt-2">
                @if($projects->image && file_exists(storage_path('app/public/'.$projects->image)))
                    <img src="{{ asset('storage/'.$projects->image) }}"
                         style="width:150px;height:150px;object-fit:cover;border-radius:6px;">
                @else
                    <span class="text-muted">No Image</span>
                @endif
            </div>
        </div>

    </div>
</div>

@endsection
