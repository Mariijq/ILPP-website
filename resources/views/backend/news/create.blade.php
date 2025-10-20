@extends('backend.layout')

@section('content')
    <h4 class="mb-4">{{ isset($news) ? 'Edit News' : 'Add News' }}</h4>

    <div class="news-form">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ isset($news) ? route('news.update', $news->id) : route('news.store') }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @if (isset($news))
                @method('PUT')
            @endif

            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" id="title" class="form-control"
                    value="{{ old('title', $news->title ?? '') }}" required>
            </div>

            <div class="mb-3">
                <label for="subtitle" class="form-label">Subtitle</label>
                <input type="text" name="subtitle" id="subtitle" class="form-control"
                    value="{{ old('subtitle', $news->subtitle ?? '') }}">
            </div>

            <div class="mb-3">
                <label for="date" class="form-label">Date</label>
                <input type="date" name="date" id="date" class="form-control"
                    value="{{ old('date', isset($news) ? $news->date->format('Y-m-d') : '') }}" required>
            </div>

            <div class="mb-3">
                <label for="short_description" class="form-label">Short Description</label>
                <textarea name="short_description" id="short_description" class="form-control" rows="3">{{ old('short_description', $news->short_description ?? '') }}</textarea>
            </div>

            <div class="mb-3">
                <label for="detailed_description" class="form-label">Detailed Description</label>
                <textarea name="detailed_description" id="detailed_description" class="form-control" rows="6">{{ old('detailed_description', $news->detailed_description ?? '') }}</textarea>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" name="image" id="image" class="form-control">
                @if (isset($news) && $news->image)
                    <img src="{{ asset('storage/' . $news->image) }}" alt="News Image"
                        style="width:80px;height:80px;margin-top:10px;">
                @endif
            </div>

            <div class="d-flex justify-content-end">
                <a href="{{ route('news.index') }}" class="btn btn-secondary me-2">Cancel</a>
                <button type="submit" class="btn btn-custom">
                    {{ isset($news) ? 'Update' : 'Save' }}
                </button>
            </div>
        </form>
    </div>
@endsection
