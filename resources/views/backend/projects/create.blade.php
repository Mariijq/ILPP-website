@extends('backend.layout')

@section('title', isset($projects) ? 'Edit Projects' : 'Create Projects')

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ isset($projects) ? route('projects.update', $projects->id) : route('projects.store') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @if (isset($projects))
                    @method('PUT')
                @endif

                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" name="title" class="form-control" id="title"
                        value="{{ old('title', $projects->title ?? '') }}" required>
                </div>

                <div class="mb-3">
                    <label for="date" class="form-label">Date</label>
                    <input type="date" name="date" class="form-control" id="date"
                        value="{{ old('date', isset($projects) ? $projects->date->format('Y-m-d') : '') }}" required>
                </div>

                <div class="mb-3">
                    <label for="short_description" class="form-label">Short Description</label>
                    <textarea name="short_description" class="form-control" id="short_description">{{ old('short_description', $projects->short_description ?? '') }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="detailed_description" class="form-label">Detailed Description</label>
                    <textarea name="detailed_description" id="detailed_description" class="form-control">{{ old('detailed_description', $projects->detailed_description ?? '') }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" name="image" class="form-control" id="image">
                    @if (isset($projects) && $projects->image)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $projects->image) }}" alt="projects Image" width="150">
                        </div>
                    @endif
                </div>

                <button type="submit" class="btn btn-success">
                    {{ isset($projects) ? 'Update' : 'Create' }}
                </button>
                <a href="{{ route('projects.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
@endsection
