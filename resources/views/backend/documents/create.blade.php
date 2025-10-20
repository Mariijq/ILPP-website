@extends('backend.layout')

@section('content')
    <h4 class="mb-4">{{ isset($document) ? 'Edit Document' : 'Add Document' }}</h4>

    <div class="document-form">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ isset($document) ? route('documents.update', $document->id) : route('documents.store') }}"
            method="POST" enctype="multipart/form-data">
            @csrf
            @if (isset($document))
                @method('PUT')
            @endif

            <div class="mb-3">
                <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                <input type="text" name="title" id="title" class="form-control"
                    value="{{ old('title', $document->title ?? '') }}" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" class="form-control" rows="4">{{ old('description', $document->description ?? '') }}</textarea>
            </div>

            <div class="mb-3">
                <label for="file_path" class="form-label">Upload File</label>
                <input type="file" name="file_path" id="file_path" class="form-control">

                @if (isset($document) && $document->file_path)
                    <div class="mt-2">
                        <small class="text-muted">
                            Current file: <a href="{{ asset('storage/' . $document->file_path) }}" target="_blank">View
                                File</a>
                        </small>
                    </div>
                @endif
            </div>

            <div class="d-flex justify-content-end">
                <a href="{{ route('documents.index') }}" class="btn btn-secondary me-2">Cancel</a>
                <button type="submit" class="btn btn-custom">
                    {{ isset($document) ? 'Update' : 'Save' }}
                </button>
            </div>
        </form>
    </div>
@endsection
