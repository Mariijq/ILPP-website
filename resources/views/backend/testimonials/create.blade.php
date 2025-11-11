@extends('backend.layout')

@section('content')
    <h4 class="mb-4">{{ isset($testimonial) ? 'Edit Testimonial' : 'Add Testimonial' }}</h4>

    <div class="testimonial-form">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form
            action="{{ isset($testimonial) ? route('testimonials.update', $testimonial->id) : route('testimonials.store') }}"
            method="POST" enctype="multipart/form-data">
            @csrf
            @if (isset($testimonial))
                @method('PUT')
            @endif

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" id="name" class="form-control"
                    value="{{ old('name', $testimonial->name ?? '') }}" required>
            </div>

            <div class="mb-3">
                <label for="designation" class="form-label">Designation</label>
                <input type="text" name="designation" id="designation" class="form-control"
                    value="{{ old('designation', $testimonial->designation ?? '') }}">
            </div>

            <div class="mb-3">
                <label for="review" class="form-label">Review</label>
                <textarea name="review" id="review" class="form-control" rows="4">{{ old('review', $testimonial->review ?? '') }}</textarea>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" name="image" id="image" class="form-control">
                @if (isset($testimonial) && $testimonial->image)
                    <img src="{{ asset('storage/' . $testimonial->image) }}" alt="Testimonial Image"
                        style="width:80px;height:80px;margin-top:10px;object-fit:cover;border-radius:50%;">
                @endif
            </div>

            <div class="d-flex justify-content-end">
                <a href="{{ route('testimonials.index') }}" class="btn btn-secondary me-2">Cancel</a>
                <button type="submit" class="btn btn-custom">{{ isset($testimonial) ? 'Update' : 'Save' }}</button>
            </div>
        </form>
    </div>
@endsection
