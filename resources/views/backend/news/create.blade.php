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

            <!-- Title -->
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" id="title" class="form-control"
                    value="{{ old('title', $news->title ?? '') }}" required>
            </div>

            <!-- Subtitle -->
            <div class="mb-3">
                <label for="subtitle" class="form-label">Subtitle</label>
                <input type="text" name="subtitle" id="subtitle" class="form-control"
                    value="{{ old('subtitle', $news->subtitle ?? '') }}">
            </div>

            <!-- Date -->
            <div class="mb-3">
                <label for="date" class="form-label">Date</label>
                <input type="date" name="date" id="date" class="form-control"
                    value="{{ old('date', isset($project) && $project->date ? \Carbon\Carbon::parse($project->date)->format('Y-m-d') : '') }}"
                    required>
                <div class="mb-3">
                    <label for="short_description" class="form-label">Short Description</label>
                    <textarea name="short_description" id="short_description" class="form-control" rows="3">{{ old('short_description', $news->short_description ?? '') }}</textarea>
                </div>

                <!-- Detailed Description -->
                <div class="mb-3">
                    <label for="detailed_description" class="form-label">Detailed Description</label>
                    <textarea name="detailed_description" id="detailed_description" class="form-control" rows="6">{{ old('detailed_description', $news->detailed_description ?? '') }}</textarea>
                </div>

                <!-- Main Image -->
                <div class="mb-3">
                    <label for="image" class="form-label">Main Image</label>
                    <input type="file" name="image" id="image" class="form-control">
                    @if (isset($news) && $news->image)
                        <img src="{{ asset('storage/' . $news->image) }}" alt="News Image"
                            style="width:80px;height:80px;margin-top:10px;">
                    @endif
                </div>

                <!-- Additional Media -->
                <div class="mb-3">
                    <label for="media" class="form-label">Additional Photos/Videos</label>
                    <input type="file" name="media[]" id="media" class="form-control" multiple
                        accept="image/*,video/*">

                    <!-- Show existing media if editing -->
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

                <!-- Form Actions -->
                <div class="d-flex justify-content-end">
                    <a href="{{ route('news.index') }}" class="btn btn-secondary me-2">Cancel</a>
                    <button type="submit" class="btn btn-custom">
                        {{ isset($news) ? 'Update' : 'Save' }}
                    </button>
                </div>

        </form>
    </div>
@endsection
