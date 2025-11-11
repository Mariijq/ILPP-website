<section class="hometestimonials">
    <div class="container">
        <h2 class="testimonial-title">Testimonials</h2>

        <!-- Carousel -->
        <div id="customers-testimonials" class="owl-carousel testimonials-carousel">
            @foreach($testimonials as $testimonial)
                <div class="testimonial-slide item">
                    <div class="shadow-effect">
                        @if($testimonial->image)
                            <img class="img-circle" src="{{ asset('storage/' . $testimonial->image) }}" alt="{{ $testimonial->name }}">
                        @else
                            <img class="img-circle" src="https://via.placeholder.com/90" alt="{{ $testimonial->name }}">
                        @endif
                        <i class="bi bi-quote quote-icon"></i>
                        <p>{{ $testimonial->review }}</p>
                    </div>
                    <div class="testimonial-name">
                        {{ $testimonial->name }}
                        @if($testimonial->designation)
                            <small> - {{ $testimonial->designation }}</small>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
