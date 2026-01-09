@extends('backend.layouts.layout')
@section('title', isset($careerCouncil) ? 'Edit Career Council' : 'Add Career Council')
@section('content')

@php
    $languages = ['en' => 'English', 'mk' => 'Macedonian', 'al' => 'Albanian'];
@endphp

<div class="card mb-4">
    <div class="card-header">
        <h3>{{ isset($careerCouncil) ? 'Edit Career Council' : 'Add Career Council' }}</h3>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form 
            action="{{ isset($careerCouncil) ? route('backend.career-councils.update', $careerCouncil->id) : route('backend.career-councils.store') }}" 
            method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($careerCouncil))
                @method('PUT')
            @endif

            {{-- Tabs for multilingual input --}}
            <ul class="nav nav-tabs" role="tablist">
                @foreach($languages as $code => $label)
                    <li class="nav-item" role="presentation">
                        <button class="nav-link @if($loop->first) active @endif"
                                id="tab-{{ $code }}" data-bs-toggle="tab"
                                data-bs-target="#tab-content-{{ $code }}" type="button" role="tab">
                            {{ $label }}
                        </button>
                    </li>
                @endforeach
            </ul>

            <div class="tab-content mt-3">
                @foreach($languages as $code => $label)
                    <div class="tab-pane fade @if($loop->first) show active @endif" 
                         id="tab-content-{{ $code }}" role="tabpanel">

                        {{-- Title --}}
                        <div class="mb-3">
                            <label class="form-label">Title ({{ $label }}) *</label>
                            <input type="text" name="title[{{ $code }}]" class="form-control"
                                   value="{{ old('title.'.$code, $careerCouncil->title[$code] ?? '') }}"
                                   @if($code==='en') required @endif>
                        </div>

                        {{-- Short Description --}}
                        <div class="mb-3">
                            <label class="form-label">Short Description ({{ $label }})</label>
                            <textarea name="short_description[{{ $code }}]" class="form-control" rows="4">{{ old('short_description.'.$code, $careerCouncil->short_description[$code] ?? '') }}</textarea>
                        </div>

                    </div>
                @endforeach
            </div>

            {{-- Actions --}}
            <div class="d-flex justify-content-end">
                <a href="{{ route('backend.career-councils.index') }}" class="btn btn-secondary me-2">Cancel</a>
                <button type="submit" class="btn btn-custom">{{ isset($careerCouncil) ? 'Update' : 'Save' }}</button>
            </div>

        </form>
    </div>
</div>

@endsection
