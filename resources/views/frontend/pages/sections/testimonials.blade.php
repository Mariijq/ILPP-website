
@php $locale = app()->getLocale(); @endphp

<section class="hometestimonials">
    <div class="container">
        <h2 class="section-title">{{ __('frontend.testimonials') }}</h2>

        <!-- Carousel -->
        <div id="customers-testimonials" class="owl-carousel testimonials-carousel">
            @foreach ($testimonials as $testimonial)
                <div class="testimonial-slide item">
                    <div class="shadow-effect">

                        <!-- Name + designation -->
                        <div class="testimonial-header">
                            <div class="testimonial-name">
                                {{ $testimonial->name[$locale] ?? $testimonial->name['en'] }}
                            </div>
                            @if ($testimonial->designation)
                                <div class="testimonial-designation">
                                    {{ $testimonial->designation[$locale] ?? $testimonial->designation['en'] }}
                                </div>
                            @endif
                        </div>

                        <!-- Image -->
                        @if ($testimonial->image)
                            <img class="img-circle" src="{{ asset('storage/' . $testimonial->image) }}"
                                alt="{{ $testimonial->name[$locale] ?? $testimonial->name['en'] }}">
                        @else
                            <img class="img-circle" src="https://via.placeholder.com/90" alt="{{ $testimonial->name }}">
                        @endif

                        <i class="bi bi-quote quote-icon"></i>
                        <p>{{ $testimonial->review[$locale] ?? $testimonial->review['en'] }}</p>

                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
