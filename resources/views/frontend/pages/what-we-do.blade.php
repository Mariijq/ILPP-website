@extends('frontend.layouts.layout')
@section('content')
@php
    $locale = app()->getLocale();
@endphp

<div class="details-wrapper">
    <div class="details-main">
        @foreach ($pillars as $pillar)
            {{-- Leadership --}}
            <div class="details">
                <h1 style="color: var(--cyan-color)">{{ __('frontend.leadership') }}</h1>
                {!! $pillar->leadership[$locale] ?? $pillar->leadership['en'] ?? '' !!}
            </div>
            <hr>

            {{-- Research --}}
            <div class="details">
                <h1 style="color: var(--cyan-color)">{{ __('frontend.research') }}</h1>
                {!! $pillar->research[$locale] ?? $pillar->research['en'] ?? '' !!}
            </div>
            <hr>

            {{-- Public Policy --}}
            <div class="details">
                <h1 style="color: var(--cyan-color)">{{ __('frontend.public_policy') }}</h1>
                {!! $pillar->public_policy[$locale] ?? $pillar->public_policy['en'] ?? '' !!}
            </div>
        @endforeach
    </div>
</div>
@endsection
