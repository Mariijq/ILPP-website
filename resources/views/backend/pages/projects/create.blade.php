@extends('backend.layouts.layout')
@section('title', 'Projects')
@section('content')

    @php
        $languages = ['en' => 'English', 'mk' => 'Macedonian', 'al' => 'Albanian'];
    @endphp

    <div class="card mb-4">
        <div class="card-header">
            <h3>{{ isset($project) ? 'Edit Project' : 'Add Project' }}</h3>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ isset($project) ? route('backend.projects.update', $project->id) : route('backend.projects.store') }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                @if (isset($project))
                    @method('PUT')
                @endif

                {{-- Tabs for multilingual content --}}
                <ul class="nav nav-tabs" id="projectTabs" role="tablist">
                    @foreach ($languages as $code => $label)
                        <li class="nav-item" role="presentation">
                            <button class="nav-link @if ($loop->first) active @endif"
                                id="tab-{{ $code }}" data-bs-toggle="tab"
                                data-bs-target="#tab-content-{{ $code }}" type="button" role="tab">
                                {{ $label }}
                            </button>
                        </li>
                    @endforeach
                </ul>

                <div class="tab-content mt-3">
                    @foreach ($languages as $code => $label)
                        <div class="tab-pane fade @if ($loop->first) show active @endif"
                            id="tab-content-{{ $code }}" role="tabpanel">

                            {{-- Title --}}
                            <div class="mb-3">
                                <label class="form-label">Title ({{ $label }})</label>
                                <input type="text" name="title_{{ $code }}" class="form-control"
                                    value="{{ old('title_' . $code, $project->title[$code] ?? '') }}">
                            </div>

                            {{-- Short Description --}}
                            <div class="mb-3">
                                <label class="form-label">Short Description ({{ $label }})</label>
                                <textarea name="short_description_{{ $code }}" class="form-control" rows="3">{{ old('short_description_' . $code, $project->short_description[$code] ?? '') }}</textarea>
                            </div>

                            {{-- Detailed Description --}}
                            <div class="mb-3">
                                <label class="form-label">Detailed Description ({{ $label }})</label>
                                <textarea name="detailed_description_{{ $code }}" class="form-control ckeditor" rows="6">{{ old('detailed_description_' . $code, $project->detailed_description[$code] ?? '') }}</textarea>
                            </div>

                        </div>
                    @endforeach
                </div>

                {{-- Date --}}
                <div class="mb-3 mt-3">
                    <label for="date" class="form-label">Date</label>
                    <input type="date" name="date" id="date" class="form-control"
                        value="{{ old('date', isset($project) && $project->date ? \Carbon\Carbon::parse($project->date)->format('Y-m-d') : '') }}">
                </div>

                {{-- Status --}}
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-select">
                        <option value="Current" {{ old('status', $project->status ?? '') == 'Current' ? 'selected' : '' }}>
                            Current
                        </option>
                        <option value="Completed"
                            {{ old('status', $project->status ?? '') == 'Completed' ? 'selected' : '' }}>
                            Completed
                        </option>
                    </select>
                </div>

                {{-- Image --}}
                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" name="image" id="image" class="form-control">
                    @if (isset($project) && $project->image)
                        <img src="{{ asset('storage/' . $project->image) }}" alt="Project Image"
                            style="width:80px;height:80px;margin-top:10px;">
                    @endif
                </div>

                {{-- Form Actions --}}
                <div class="d-flex justify-content-end">
                    <a href="{{ route('backend.projects.index') }}" class="btn btn-secondary me-2">Cancel</a>
                    <button type="submit" class="btn btn-custom">{{ isset($project) ? 'Update' : 'Save' }}</button>
                </div>
            </form>
        </div>
    </div>

@endsection
