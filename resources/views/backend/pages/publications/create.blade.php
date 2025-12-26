@extends('backend.layouts.layout')
@section('title', isset($publication) ? 'Edit Publication' : 'Add Publication')
@section('content')

@php
    $languages = ['en' => 'English', 'mk' => 'Macedonian', 'al' => 'Albanian'];
@endphp

<div class="card mb-4">
    <div class="card-header">
        <h3>{{ isset($publication) ? 'Edit Publication' : 'Add Publication' }}</h3>
    </div>

    <div class="card-body">
        <form action="{{ isset($publication) ? route('backend.publications.update', $publication->id) : route('backend.publications.store') }}"
              method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($publication))
                @method('PUT')
            @endif

            {{-- LANGUAGE TABS --}}
            <ul class="nav nav-tabs" role="tablist">
                @foreach($languages as $code => $label)
                    <li class="nav-item">
                        <button class="nav-link @if($loop->first) active @endif" data-bs-toggle="tab"
                                data-bs-target="#lang-{{ $code }}" type="button">{{ $label }}</button>
                    </li>
                @endforeach
            </ul>

            <div class="tab-content mt-3">
                @foreach($languages as $code => $label)
                    <div class="tab-pane fade @if($loop->first) show active @endif" id="lang-{{ $code }}">
                        {{-- TITLE --}}
                        <div class="mb-3">
                            <label class="form-label">Title ({{ $label }})</label>
                            <input type="text" name="title_{{ $code }}" class="form-control"
                                   value="{{ old('title_'.$code, $publication->title[$code] ?? '') }}"
                                   {{ $code === 'en' ? 'required' : '' }}>
                        </div>

                        {{-- SHORT DESCRIPTION --}}
                        <div class="mb-3">
                            <label class="form-label">Short Description ({{ $label }})</label>
                            <textarea name="short_description_{{ $code }}" class="form-control" rows="3">{{ old('short_description_'.$code, $publication->short_description[$code] ?? '') }}</textarea>
                        </div>

                        {{-- DETAILED DESCRIPTION --}}
                        <div class="mb-3">
                            <label class="form-label">Detailed Description ({{ $label }})</label>
                            <textarea name="detailed_description_{{ $code }}" class="form-control ckeditor" rows="6">{{ old('detailed_description_'.$code, $publication->detailed_description[$code] ?? '') }}</textarea>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- DATE --}}
            <div class="mb-3 mt-3">
                <label class="form-label">Date</label>
                <input type="date" name="date" class="form-control"
                       value="{{ old('date', isset($publication) ? $publication->date->format('Y-m-d') : '') }}" required>
            </div>

            {{-- IMAGE --}}
            <div class="mb-3 mt-3">
                <label class="form-label">Image</label>
                <input type="file" name="image" class="form-control" accept="image/*">
                @if(isset($publication) && $publication->image)
                    <img src="{{ asset('storage/' . $publication->image) }}" style="width:80px;height:80px;margin-top:10px;object-fit:cover;">
                @endif
            </div>

            {{-- PDF FILE --}}
            <div class="mb-3">
                <label class="form-label">File (PDF only)</label>
                <input type="file" name="file" class="form-control" accept="application/pdf">
                @if(isset($publication) && $publication->file)
                    <div class="mt-2">
                        <a href="{{ asset('storage/' . $publication->file) }}" target="_blank" class="btn btn-outline-primary btn-sm">View Current File</a>
                    </div>
                @endif
            </div>

            {{-- ACTIONS --}}
            <div class="d-flex justify-content-end">
                <a href="{{ route('backend.publications.index') }}" class="btn btn-secondary me-2">Cancel</a>
                <button type="submit" class="btn btn-custom">{{ isset($publication) ? 'Update' : 'Save' }}</button>
            </div>
        </form>
    </div>
</div>

@endsection
