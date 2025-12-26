@extends('backend.layouts.layout')

@section('title', 'Testimonial Details')

@section('content')
<div class="card">
    <div class="card-header d-flex">
        <a href="{{ route('backend.testimonials.index') }}" class="btn btn-secondary ms-auto">Back to List</a>
    </div>

    <div class="card-body show">
        <div class="mb-3">
            <label class="fw-bold">Name:</label>
            <p>{{ $testimonial->name }}</p>
        </div>

        <div class="mb-3">
            <label class="fw-bold">Designation:</label>
            <p>{{ $testimonial->designation ?? '-' }}</p>
        </div>

        <div class="mb-3">
            <label class="fw-bold">Review:</label>
            <p>{{ $testimonial->review ?? '-' }}</p>
        </div>

        <div class="mb-3">
            <label class="fw-bold">Image:</label>
            <div>
                @if($testimonial->image && file_exists(storage_path('app/public/'.$testimonial->image)))
                    <img src="{{ asset('storage/'.$testimonial->image) }}" 
                         style="width:150px;height:150px;object-fit:cover;border-radius:50%;">
                @else
                    <span class="text-muted">No Image</span>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
