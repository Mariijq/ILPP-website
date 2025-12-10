<div class="swiper bannerSwiper">
    <div class="swiper-wrapper">
        @foreach ($slides as $slide)
            <div class="swiper-slide">
                <div class="banner-item">
                    <div class="banner-content">
                        <h1>{{ $slide['title'] ?? '' }}</h1>
                        <p>{{ \Carbon\Carbon::parse($slide['date'])->format('d M Y') }}</p>
                        @if (!empty($slide['link']))
                            <a href="{{ $slide['link'] }}" class="btn btn-primary">Learn More</a>
                        @endif
                    </div>
                    @if (!empty($slide['image']))
                        <div class="banner-image">
                            <img src="{{ $slide['image'] }}" alt="{{ $slide['title'] }}">
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="swiper-pagination"></div>

    <!-- Navigation -->
    <div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div>
</div>
