@extends('backend.layout')

@section('title', isset($news) ? 'Edit News' : 'Create News')

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ isset($news) ? route('news.update', $news->id) : route('news.store') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @if (isset($news))
                    @method('PUT')
                @endif

                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" name="title" class="form-control" id="title"
                        value="{{ old('title', $news->title ?? '') }}" required>
                </div>

                <div class="mb-3">
                    <label for="subtitle" class="form-label">Subtitle</label>
                    <input type="text" name="subtitle" class="form-control" id="subtitle"
                        value="{{ old('subtitle', $news->subtitle ?? '') }}">
                </div>

                <div class="mb-3">
                    <label for="date" class="form-label">Date</label>
                    <input type="date" name="date" class="form-control" id="date"
                        value="{{ old('date', isset($news) ? $news->date->format('Y-m-d') : '') }}" required>
                </div>

                <div class="mb-3">
                    <label for="short_description" class="form-label">Short Description</label>
                    <textarea name="short_description" class="form-control" id="short_description">{{ old('short_description', $news->short_description ?? '') }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="detailed_description" class="form-label">Detailed Description</label>
                    <textarea name="detailed_description" id="detailed_description" class="form-control">{{ old('detailed_description', $news->detailed_description ?? '') }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" name="image" class="form-control" id="image">
                    @if (isset($news) && $news->image)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $news->image) }}" alt="News Image" width="150">
                        </div>
                    @endif
                </div>

                <button type="submit" class="btn btn-success">
                    {{ isset($news) ? 'Update' : 'Create' }}
                </button>
                <a href="{{ route('news.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
@endsection
