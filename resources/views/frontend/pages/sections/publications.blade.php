<div class="publications-section">
    <h2 class="section-title">{{ __('frontend.publications') }}</h2>

    <div class="publications-grid">
        @foreach ($publications->take(3) as $pub)
            <a href="{{ route('publication-details', $pub->id) }}" class="publication-card">

                <img src="{{ asset('storage/' . $pub->image) }}" alt="{{ $pub->title }}" class="publication-img">

                <div class="publication-overlay"></div>

                <div class="publication-info">
                    <h3>{{ $pub->title }}</h3>
                </div>

            </a>
        @endforeach
    </div>
</div>
