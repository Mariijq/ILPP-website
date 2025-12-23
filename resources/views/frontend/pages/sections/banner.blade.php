@php
    $locale = app()->getLocale();
@endphp

<div class="swiper bannerSwiper">
    <div class="swiper-wrapper">
        @foreach ($slides as $slide)
            @php
                $title = is_array($slide['title'] ?? null) ? ($slide['title'][$locale] ?? $slide['title']['en'] ?? '') : ($slide['title'] ?? '');
                $subtitle = is_array($slide['subtitle'] ?? null) ? ($slide['subtitle'][$locale] ?? $slide['subtitle']['en'] ?? '') : ($slide['subtitle'] ?? '');
            @endphp

            <div class="swiper-slide">
                <div class="banner-item">
                    <div class="banner-content">
                        <h1>{{ $title }}</h1>
                        <p>{{ \Carbon\Carbon::parse($slide['date'])->format('d M Y') }}</p>
                        @if (!empty($slide['link']))
                            <a href="{{ $slide['link'] }}" class="btn btn-custom">{{ __('frontend.learn_more') }}</a>
                        @endif
                    </div>
                    @if (!empty($slide['image']))
                        <div class="banner-image">
                            <img src="{{ $slide['image'] }}" alt="{{ $title }}">
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
