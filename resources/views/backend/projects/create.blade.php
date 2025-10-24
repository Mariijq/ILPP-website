@extends('backend.layout')

@section('content')
    <h4 class="mb-4">{{ isset($project) ? 'Edit Project' : 'Add Project' }}</h4>

    <div class="project-form">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ isset($project) ? route('projects.update', $project->id) : route('projects.store') }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @if (isset($project))
                @method('PUT')
            @endif

            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" id="title" class="form-control"
                    value="{{ old('title', $project->title ?? '') }}" required>
            </div>

            <div class="mb-3">
                <label for="date" class="form-label">Date</label>
                <input type="date" name="date" id="date" class="form-control"
                    value="{{ old('date', isset($project) && $project->date ? \Carbon\Carbon::parse($project->date)->format('Y-m-d') : '') }}"
                    required>
            </div>

            <div class="mb-3">
                <label for="short_description" class="form-label">Short Description</label>
                <textarea name="short_description" id="short_description" class="form-control" rows="3">{{ old('short_description', $project->short_description ?? '') }}</textarea>
            </div>

            <div class="mb-3">
                <label for="detailed_description" class="form-label">Detailed Description</label>
                <textarea name="detailed_description" id="detailed_description" class="form-control" rows="6">{{ old('detailed_description', $project->detailed_description ?? '') }}</textarea>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-select" required>
                    <option value="ongoing" {{ old('status', $project->status ?? '') == 'ongoing' ? 'selected' : '' }}>
                        Ongoing</option>
                    <option value="finished" {{ old('status', $project->status ?? '') == 'finished' ? 'selected' : '' }}>
                        Finished</option>
                </select>
            </div>


            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" name="image" id="image" class="form-control">
                @if (isset($project) && $project->image)
                    <img src="{{ asset('storage/' . $project->image) }}" alt="Project Image"
                        style="width:80px;height:80px;margin-top:10px;">
                @endif
            </div>

            <div class="d-flex justify-content-end">
                <a href="{{ route('projects.index') }}" class="btn btn-secondary me-2">Cancel</a>
                <button type="submit" class="btn btn-custom">
                    {{ isset($project) ? 'Update' : 'Save' }}
                </button>
            </div>
        </form>
    </div>
@endsection
