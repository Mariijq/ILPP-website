@extends('frontend.layouts.layout')
@section('content')
@php $locale = app()->getLocale(); @endphp

<section class="partners-section">
    <div class="section-header">
        <h2>{{ __('frontend.Funding_&_Support') }}</h2>
    </div>

    <div class="partners-grid">
        @foreach ($supporters as $supporter)
            <div class="partner-item">
                {{-- Partner Logo --}}
                @if ($supporter->logo)
                    <div class="partner-logo">
                        <img src="{{ asset('storage/' . $supporter->logo) }}"
                             alt="{{ $supporter->name[$locale] ?? ($supporter->name['en'] ?? '') }}">
                    </div>
                @else
                    <div class="partner-logo no-logo">
                        No Logo
                    </div>
                @endif

                <div class="partner-name">
                    <h3>{{ $supporter->name[$locale] ?? ($supporter->name['en'] ?? '') }}</h3>
                </div>

                @if($supporter->website)
                    <a href="{{ $supporter->website }}" target="_blank" class="partner-link">Visit Website</a>
                @endif
            </div>
        @endforeach
    </div>
</section>
@endsection
