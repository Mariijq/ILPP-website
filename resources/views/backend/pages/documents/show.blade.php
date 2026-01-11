@extends('backend.layouts.layout')

@section('title', 'Document Details')

@section('content')
@php $locale = app()->getLocale(); @endphp

<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-light">
            <h4 class="mb-0">{{ $document->title[$locale] ?? $document->title ?? 'Untitled Document' }}</h4>
        </div>

        <div class="card-body">
            <p><strong>Description:</strong></p>
            <p>{{ $document->description[$locale] ?? $document->description ?? 'No description available.' }}</p>

            <p><strong>File:</strong></p>
            @if(!empty($document->file_path) && file_exists(storage_path('app/public/'.$document->file_path)))
                <a href="{{ asset('storage/'.$document->file_path) }}" class="btn btn-custom" target="_blank">
                    <i class="bi bi-file-earmark-text"></i> View / Download File
                </a>
            @else
                <span class="text-muted">No file uploaded.</span>
            @endif
        </div>

        <div class="card-footer text-end">
            <a href="{{ route('backend.documents.index') }}" class="btn btn-secondary">Back</a>
            <a href="{{ route('backend.documents.edit', $document->id) }}" class="btn btn-custom">Edit</a>
        </div>
    </div>
</div>
@endsection
