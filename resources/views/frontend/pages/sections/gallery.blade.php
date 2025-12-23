@php $locale = app()->getLocale(); @endphp

<section class="homegallery">
    <div class="container">
        <h2 class="section-title">{{ __('frontend.gallery') }}</h2>

        <!-- Owl Carousel Gallery -->
        <div id="gallery-slider" class="owl-carousel gallery-carousel">
            @foreach ($galleryImages as $image)
                <div class="gallery-slide item">
                    <div class="shadow-effect">
                        <img src="{{ asset('storage/' . $image->image_path) }}" 
                             alt="{{ $image->title[$locale] ?? $image->title['en'] ?? 'Gallery Image' }}">
                        @if($image->title)
                            <div class="publication-info">
                                <h3>{{ $image->title[$locale] ?? $image->title['en'] }}</h3>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
