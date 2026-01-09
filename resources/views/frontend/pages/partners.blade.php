@extends('frontend.layouts.layout')
@section('content')
@php $locale = app()->getLocale(); @endphp

<section class="partners-section">
    <div class="section-header">
        <h2>{{ __('frontend.Funding_&_Support') }}</h2>
    </div>

    <div class="partners-grid">
        @foreach ($partners as $partner)
            <div class="partner-item">
                {{-- Partner Logo --}}
                @if ($partner->logo)
                    <div class="partner-logo">
                        <img src="{{ asset('storage/' . $partner->logo) }}"
                             alt="{{ $partner->name[$locale] ?? ($partner->name['en'] ?? '') }}">
                    </div>
                @else
                    <div class="partner-logo no-logo">
                        No Logo
                    </div>
                @endif

                <div class="partner-name">
                    <h3>{{ $partner->name[$locale] ?? ($partner->name['en'] ?? '') }}</h3>
                </div>

                @if($partner->website)
                    <a href="{{ $partner->website }}" target="_blank" class="partner-link">Visit Website</a>
                @endif
            </div>
        @endforeach
    </div>
</section>
@endsection
