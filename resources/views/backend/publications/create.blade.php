@extends('backend.layout')

@section('content')
        <h4 class="mb-4">{{ isset($publications) ? 'Edit Publication' : 'Add Publication' }}</h4>

    <div class="publication-form">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ isset($publications) ? route('publications.update', $publications->id) : route('publications.store') }}" 
              method="POST" enctype="multipart/form-data">
            @csrf
            @if (isset($publications))
                @method('PUT')
            @endif

            <div class="mb-3">
                <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                <input type="text" name="title" id="title" class="form-control"
                    value="{{ old('title', $publications->title ?? '') }}" required>
            </div>

            <div class="mb-3">
                <label for="date" class="form-label">Date</label>
                <input type="date" name="date" id="date" class="form-control"
                    value="{{ old('date', isset($publications) && $publications->date ? $publications->date->format('Y-m-d') : '') }}" required>
            </div>

            <div class="mb-3">
                <label for="short_description" class="form-label">Short Description</label>
                <textarea name="short_description" id="short_description" class="form-control">{{ old('short_description', $publications->short_description ?? '') }}</textarea>
            </div>

            <div class="mb-3">
                <label for="detailed_description" class="form-label">Detailed Description</label>
                <textarea name="detailed_description" id="detailed_description" class="form-control">{{ old('detailed_description', $publications->detailed_description ?? '') }}</textarea>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" name="image" id="image" class="form-control">

                @if (isset($publications) && $publications->image)
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $publications->image) }}" alt="Publication Image" width="100" height="100" style="object-fit: cover;">
                    </div>
                @endif
            </div>

            <div class="d-flex justify-content-end">
                <a href="{{ route('publications.index') }}" class="btn btn-secondary me-2">Cancel</a>
                <button type="submit" class="btn btn-custom">
                    {{ isset($publications) ? 'Update' : 'Save' }}
                </button>
            </div>
        </form>
    </div>
@endsection
