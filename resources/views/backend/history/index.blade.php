@extends('backend.layout')
@section('title', 'History')
    @php
        $languages = ['en' => 'English', 'mk' => 'Macedonian', 'al' => 'Albanian'];
    @endphp

@section('content')

    <div class="history-form">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('history.update') }}" method="POST">
            @csrf

            {{-- Multilingual Tabs --}}
            <ul class="nav nav-tabs" id="historyTabs" role="tablist">
                @foreach ($languages as $code => $label)
                    <li class="nav-item" role="presentation">
                        <button class="nav-link @if ($loop->first) active @endif" id="tab-{{ $code }}"
                            data-bs-toggle="tab" data-bs-target="#tab-content-{{ $code }}" type="button"
                            role="tab">
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
                                value="{{ old('title_' . $code, $history->title[$code] ?? '') }}">
                        </div>

                        {{-- Description --}}
                        <div class="mb-3">
                            <label class="form-label">Description ({{ $label }})</label>
                            <textarea name="description_{{ $code }}" class="ckeditor form-control" rows="6">{{ old('description_' . $code, $history->description[$code] ?? '') }}</textarea>
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
