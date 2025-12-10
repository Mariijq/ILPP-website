@extends('backend.layout')

@section('content')
<h2>Slide Details</h2>

<div class="card" style="max-width: 700px;">
    <img src="{{ asset('storage/' . $slide->image) }}" class="card-img-top" alt="Slide Image">

    <div class="card-body">
        <h3>{{ $slide->title }}</h3>
        <h5 class="text-muted">{{ $slide->subtitle }}</h5>

        <p>{{ $slide->description }}</p>

        <p><strong>Type:</strong> {{ ucfirst($slide->type) }}</p>
        <p><strong>Slug:</strong> {{ $slide->slug ?? 'N/A' }}</p>
        <p><strong>Order:</strong> {{ $slide->order }}</p>

        <a href="{{ route('slides.edit', $slide->id) }}" class="btn btn-warning">Edit</a>
        <a href="{{ route('slides.index') }}" class="btn btn-secondary">Back</a>
    </div>
</div>
@endsection
