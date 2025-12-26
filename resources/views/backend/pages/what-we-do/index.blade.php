@extends('backend.layouts.layout')
@section('title', 'What We Do')

@section('content')
@php
    $languages = ['en' => 'English', 'mk' => 'Macedonian', 'al' => 'Albanian'];
@endphp

<div class="what-we-do-form">
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('backend.what-we-do.update') }}" method="POST">
        @csrf

        {{-- Multilingual Tabs --}}
        <ul class="nav nav-tabs" id="whatWeDoTabs" role="tablist">
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
                        <label class="form-label">Title ({{ $label }})</label>
                        <input type="text" name="title_{{ $code }}" class="form-control"
                               value="{{ old('title_'.$code, $whatWeDo->title[$code] ?? '') }}">
                    </div>

                    {{-- Leadership --}}
                    <div class="mb-3">
                        <label class="form-label">Leadership ({{ $label }})</label>
                        <textarea name="leadership_{{ $code }}" class="form-control ckeditor" rows="6">{{ old('leadership_'.$code, $whatWeDo->leadership[$code] ?? '') }}</textarea>
                    </div>

                    {{-- Research --}}
                    <div class="mb-3">
                        <label class="form-label">Research ({{ $label }})</label>
                        <textarea name="research_{{ $code }}" class="form-control ckeditor" rows="6">{{ old('research_'.$code, $whatWeDo->research[$code] ?? '') }}</textarea>
                    </div>

                    {{-- Public Policy --}}
                    <div class="mb-3">
                        <label class="form-label">Public Policy ({{ $label }})</label>
                        <textarea name="public_policy_{{ $code }}" class="form-control ckeditor" rows="6">{{ old('public_policy_'.$code, $whatWeDo->public_policy[$code] ?? '') }}</textarea>
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
