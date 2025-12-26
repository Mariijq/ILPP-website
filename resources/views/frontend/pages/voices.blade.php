@extends('frontend.layouts.layout')
@section('content')
    @php $locale = app()->getLocale(); @endphp

    <section class="voices-section">
        <div class="container">
            <header class="voices-header">
                <h2>{{ __('frontend.voices') }}</h2>
                <p class="voices-subtitle">
                    {{ __('frontend.voices_subtitle') ?? 'Real stories and perspectives from our community' }}
                </p>
            </header>

            <div class="voices-grid">
                @foreach ($voices as $voice)
                    <div class="voice-card">

                        {{-- Header: Name + Designation --}}
                        <div class="voice-header">
                            <div class="voice-name">
                                {{ $voice->name[$locale] ?? $voice->name['en'] }}
                            </div>

                            @if (!empty($voice->designation[$locale] ?? $voice->designation['en']))
                                <div class="voice-role">
                                    {{ $voice->designation[$locale] ?? $voice->designation['en'] }}
                                </div>
                            @endif
                        </div>

                        {{-- Image --}}
                        <div class="voice-avatar">
                            <img src="{{ $voice->image ? asset('storage/' . $voice->image) : asset('images/avatar-placeholder.png') }}"
                                alt="{{ $voice->name[$locale] ?? $voice->name['en'] }}">
                        </div>

                        {{-- Quote --}}
                        <div class="voice-content">
                            <p class="voice-quote">
                                “{{ $voice->review[$locale] ?? $voice->review['en'] }}”
                            </p>
                        </div>

                    </div>
                @endforeach
            </div>

            <div class="pagination-wrapper">
                {{ $voices->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </section>
@endsection
