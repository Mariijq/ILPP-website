@extends('backend.layouts.layouts.layout')
@section('title', 'News')
@section('content')

@php
    $languages = ['en' => 'English', 'mk' => 'Macedonian', 'al' => 'Albanian'];
@endphp

<div class="card mb-4">
    <div class="card-header">
        <h3>{{ isset($news) ? 'Edit News' : 'Add News' }}</h3>
    </div>
    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ isset($news) ? route('backend.news.update', $news->id) : route('news.store') }}" 
              method="POST" enctype="multipart/form-data" novalidate>
            @csrf
            @if (isset($news))
                @method('PUT')
            @endif

            {{-- Tabs for multilingual content --}}
            <ul class="nav nav-tabs" id="newsTabs" role="tablist">
                @foreach ($languages as $code => $label)
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
                @foreach ($languages as $code => $label)
                    <div class="tab-pane fade @if($loop->first) show active @endif" id="tab-content-{{ $code }}" role="tabpanel">

                        {{-- Title --}}
                        <div class="mb-3">
                            <label class="form-label">Title ({{ $label }})</label>
                            <input type="text" name="title_{{ $code }}" class="form-control" 
                                   value="{{ old('title_'.$code, isset($news) ? $news->title[$code] ?? '' : '') }}"
                                   @if($loop->first) required @endif>
                        </div>

                        {{-- Subtitle --}}
                        <div class="mb-3">
                            <label class="form-label">Subtitle ({{ $label }})</label>
                            <input type="text" name="subtitle_{{ $code }}" class="form-control" 
                                   value="{{ old('subtitle_'.$code, isset($news) ? $news->subtitle[$code] ?? '' : '') }}">
                        </div>

                        {{-- Short Description --}}
                        <div class="mb-3">
                            <label class="form-label">Short Description ({{ $label }})</label>
                            <textarea name="short_description_{{ $code }}" class="form-control" rows="3">{{ old('short_description_'.$code, isset($news) ? $news->short_description[$code] ?? '' : '') }}</textarea>
                        </div>

                        {{-- Detailed Description --}}
                        <div class="mb-3">
                            <label class="form-label">Detailed Description ({{ $label }})</label>
                            <textarea name="detailed_description_{{ $code }}" class="form-control ckeditor" rows="6">{{ old('detailed_description_'.$code, isset($news) ? $news->detailed_description[$code] ?? '' : '') }}</textarea>
                        </div>

                    </div>
                @endforeach
            </div>

            {{-- Date --}}
            <div class="mb-3 mt-3">
                <label for="date" class="form-label">Date</label>
                <input type="date" name="date" id="date" class="form-control"
                    value="{{ old('date', isset($news) && $news->date ? \Carbon\Carbon::parse($news->date)->format('Y-m-d') : '') }}" required>
            </div>

            {{-- Main Image --}}
            <div class="mb-3">
                <label for="image" class="form-label">Main Image</label>
                <input type="file" name="image" id="image" class="form-control">
                @if (isset($news) && $news->image)
                    <img src="{{ asset('storage/' . $news->image) }}" alt="News Image"
                         style="width:80px;height:80px;margin-top:10px;">
                @endif
            </div>

            {{-- Additional Media --}}
            <div class="mb-3">
                <label for="media" class="form-label">Additional Photos/Videos</label>
                <input type="file" name="media[]" id="media" class="form-control" multiple accept="image/*,video/*">
                @if (isset($news) && $news->media->count())
                    <div class="mt-2 d-flex flex-wrap">
                        @foreach ($news->media as $item)
                            @if ($item->type === 'image')
                                <img src="{{ asset('storage/' . $item->path) }}" 
                                     style="width:100px;height:100px;margin:5px;" alt="Media Image">
                            @else
                                <video width="100" height="100" controls style="margin:5px;">
                                    <source src="{{ asset('storage/' . $item->path) }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            @endif
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- Form Actions --}}
            <div class="d-flex justify-content-end">
                <a href="{{ route('backend.news.index') }}" class="btn btn-secondary me-2">Cancel</a>
                <button type="submit" class="btn btn-custom">{{ isset($news) ? 'Update' : 'Save' }}</button>
            </div>
        </form>
    </div>
</div>

@endsection
