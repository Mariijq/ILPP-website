@extends('frontend.layouts.main')
@section('content')

<div class="grid-wrapper">
    <header class="section-header">
        <h2>Gallery</h2>
    </header>

    <div class="grid-band">
        @foreach($images as $image)
        <div class="grid-item">
            <div class="card">
                <div class="thumb" style="background-image: url('{{ asset('storage/' . $image->image_path) }}');"></div>
                <article>
                    @if($image->title)
                        <h1>{{ $image->title }}</h1>
                    @endif
                    @if($image->description)
                        <p>{{ Str::limit(strip_tags($image->description), 120, '...') }}</p>
                    @endif
                </article>
            </div>
        </div>
        @endforeach
    </div>

    @if($images->isEmpty())
        <p class="text-muted text-center mt-4">No images available yet.</p>
    @endif
</div>

@endsection
