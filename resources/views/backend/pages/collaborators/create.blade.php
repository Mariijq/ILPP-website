@extends('backend.layouts.layout')
@section('title', 'Collaborators')
@section('content')

@php
    $languages = ['en' => 'English', 'mk' => 'Macedonian', 'al' => 'Albanian'];
@endphp

<div class="card mb-4">
    <div class="card-header">
        <h3>{{ isset($collaborators) ? 'Edit Collaborator' : 'Add Collaborator' }}</h3>
    </div>
    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form
            action="{{ isset($collaborators) ? route('backend.collaborators.update', $collaborators->id) : route('backend.collaborators.store') }}"
            method="POST" enctype="multipart/form-data">
            @csrf
            @if (isset($collaborators))
                @method('PUT')
            @endif

            {{-- Tabs for multilingual content --}}
            <ul class="nav nav-tabs" id="collaboratorTabs" role="tablist">
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

                        {{-- Name --}}
                        <div class="mb-3">
                            <label class="form-label">Name ({{ $label }}) *</label>
                            <input type="text" name="name_{{ $code }}" class="form-control"
                                   value="{{ old('name_' . $code, $collaborators->name[$code] ?? '') }}"
                                   @if ($code === 'en') required @endif>
                        </div>

                        {{-- Bio --}}
                        <div class="mb-3">
                            <label class="form-label">Bio ({{ $label }})</label>
                            <textarea name="bio_{{ $code }}" class="form-control" rows="4">{{ old('bio_' . $code, $collaborators->bio[$code] ?? '') }}</textarea>
                        </div>

                    </div>
                @endforeach
            </div>


            {{-- Image --}}
            <div class="mb-3 mt-3">
                <label class="form-label">Image</label>
                <input type="file" name="image" class="form-control">
                @if (isset($collaborators) && $collaborators->image)
                    <img src="{{ asset('storage/' . $collaborators->image) }}" alt="Image"
                         style="width:120px;margin-top:10px;">
                @endif
            </div>

            {{-- Form Actions --}}
            <div class="d-flex justify-content-end">
                <a href="{{ route('backend.collaborators.index') }}" class="btn btn-secondary me-2">Cancel</a>
                <button type="submit" class="btn btn-custom">{{ isset($collaborators) ? 'Update' : 'Save' }}</button>
            </div>

        </form>
    </div>
</div>

@endsection
