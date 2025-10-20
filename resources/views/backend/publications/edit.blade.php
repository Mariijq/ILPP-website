@extends('backend.layout')

@section('title', isset($publications) ? 'Edit publications' : 'Create publications')

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ isset($publications) ? route('publications.update', $publications->id) : route('publications.store') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @if (isset($publications))
                    @method('PUT')
                @endif

                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" name="title" class="form-control" id="title"
                        value="{{ old('title', $publications->title ?? '') }}" required>
                </div>

                <div class="mb-3">
                    <label for="date" class="form-label">Date</label>
                    <input type="date" name="date" class="form-control" id="date"
                        value="{{ old('date', isset($publications) ? $publications->date->format('Y-m-d') : '') }}" required>
                </div>

                <div class="mb-3">
                    <label for="short_description" class="form-label">Short Description</label>
                    <textarea name="short_description" class="form-control" id="short_description">{{ old('short_description', $publications->short_description ?? '') }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="detailed_description" class="form-label">Detailed Description</label>
                    <textarea name="detailed_description" id="detailed_description" class="form-control">{{ old('detailed_description', $publications->detailed_description ?? '') }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" name="image" class="form-control" id="image">
                    @if (isset($publications) && $publications->image)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $publications->image) }}" alt="publications Image" width="150">
                        </div>
                    @endif
                </div>

                <button type="submit" class="btn btn-custom">
                    {{ isset($publications) ? 'Update' : 'Save' }}
                </button>
                <a href="{{ route('publications.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
@endsection
