@extends('backend.layout')
@section('title', 'About Us')

@section('content')
@php
    $languages = ['en' => 'English', 'mk' => 'Macedonian', 'al' => 'Albanian'];
@endphp

<div class="container py-4">
    <form action="{{ route('about.update') }}" method="POST">
        @csrf

        <ul class="nav nav-tabs mb-3">
            @foreach ($languages as $code => $label)
                <li class="nav-item">
                    <button class="nav-link {{ $loop->first ? 'active' : '' }}"
                            data-bs-toggle="tab"
                            data-bs-target="#lang-{{ $code }}"
                            type="button">
                        {{ $label }}
                    </button>
                </li>
            @endforeach
        </ul>

        <div class="tab-content">
            @foreach ($languages as $code => $label)
                <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                     id="lang-{{ $code }}">

                    <div class="mb-3">
                        <label class="form-label">Vision</label>
                        <textarea
                            name="vision_{{ $code }}"
                            id="vision_{{ $code }}"
                            class="form-control ckeditor"
                            rows="4"
                        >{{ old("vision_$code", $about->vision[$code] ?? '') }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Mission</label>
                        <textarea
                            name="mision_{{ $code }}"
                            id="mision_{{ $code }}"
                            class="form-control ckeditor"
                            rows="4"
                        >{{ old("mision_$code", $about->mision[$code] ?? '') }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Purpose</label>
                        <textarea
                            name="goals_{{ $code }}"
                            id="goals_{{ $code }}"
                            class="form-control ckeditor"
                            rows="4"
                        >{{ old("goals_$code", $about->goals[$code] ?? '') }}</textarea>
                    </div>

                </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-end mt-3">
            <button type="submit" class="btn btn-custom">Save</button>
        </div>
    </form>
</div>
@endsection
