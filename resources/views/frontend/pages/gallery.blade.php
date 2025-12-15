@extends('frontend.layouts.main')
@section('content')
    <div class="grid-wrapper">
        <header class="section-header">
            <h2>{{ __('frontend.gallery') }}</h2>
        </header>

        <div class="grid-band">
            @foreach ($images as $image)
                <div class="grid-item">
                    <div class="card lightbox-trigger" data-title="{{ $image->title }}"
                        data-description="{{ Str::limit(strip_tags($image->description), 120, '...') }}"
                        data-src="{{ asset('storage/' . $image->image_path) }}">
                        <div class="thumb" style="background-image: url('{{ asset('storage/' . $image->image_path) }}');">
                        </div>
                        <article>
                            @if ($image->title)
                                <h1>{{ $image->title }}</h1>
                            @endif
                            @if ($image->description)
                                <p>{{ Str::limit(strip_tags($image->description), 120, '...') }}</p>
                            @endif
                        </article>
                    </div>
                </div>
            @endforeach
        </div>

        @if ($images->isEmpty())
            <p class="text-muted text-center mt-4">No images available yet.</p>
        @endif

        {{-- Pagination --}}
        <div class="pagination-wrapper" style="margin-top: 30px; display:flex; justify-content:center;">
            {{ $images->links('pagination::bootstrap-5') }}
        </div>
    </div>


    <!-- Lightbox Modal -->
    <div id="lightbox-modal">
        <span id="lightbox-close">&times;</span>
        <img id="lightbox-content" src="">
        <div id="lightbox-caption"></div>
        <a id="lightbox-prev">&#10094;</a>
        <a id="lightbox-next">&#10095;</a>
    </div>

    <script src="{{ asset('js/gallery.js') }}"></script>
@endsection
