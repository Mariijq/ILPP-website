@extends('backend.layout')
@section('title', 'Gallery')
@section('content')

<div class="card mb-4">
    <div class="card-header">
        <h3>Upload Images</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('gallery.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Image Title</label>
                <input type="text" name="title" id="title" class="form-control" placeholder="Enter image title">
            </div>
            <div class="mb-3">
                <label for="images" class="form-label">Select Images</label>
                <input type="file" name="images[]" multiple class="form-control">
            </div>
            <button type="submit" class="btn btn-custom">
                <i class="bi bi-upload"></i> Upload
            </button>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h3>Gallery Images</h3>
    </div>
    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="row g-3">
            @foreach ($images as $image)
                <div class="col-6 col-md-3">
                    <div class="card">
                        <img src="{{ asset('storage/' . $image->image_path) }}" class="card-img-top"
                            alt="{{ $image->title ?? 'Gallery Image' }}">
                        <div class="card-body text-center">

                            {{-- Display / edit title --}}
                            <form action="{{ route('gallery.update', $image->id) }}" method="POST" class="mb-2">
                                @csrf
                                @method('PUT')
                                <input type="text" name="title" class="form-control mb-2" 
                                       value="{{ $image->title ?? '' }}" placeholder="Enter title">
                                <button type="submit" class="btn btn-custom">Save</button>
                            </form>

                            {{-- Delete image --}}
                            <form action="{{ route('gallery.destroy', $image->id) }}" method="POST"
                                onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="bi bi-trash"></i> Delete
                                </button>
                            </form>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @if ($images->isEmpty())
            <p class="text-muted mt-3">No images uploaded yet.</p>
        @endif
    </div>
</div>

@endsection
