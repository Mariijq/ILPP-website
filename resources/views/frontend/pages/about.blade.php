@extends('frontend.layouts.main')
@section('content')
@php $locale = app()->getLocale(); @endphp

    <div class="details-wrapper">
        <div class="details-main">
            @foreach ($about as $item)
                <div class="section-header">
                    <h2>{{ __('frontend.vision') }}</h2>
                </div>
                <div class="details">
                    <p> {!! $item->vision[$locale] ?? $item->vision['en'] !!}
                    </p>
                </div>
                <hr>
                <div class="section-header">
                    <h2>{{ __('frontend.mission') }}</h2>
                </div>
                <div class="details">
                    <p> {!! $item->mision[$locale] ?? $item->mision['en'] !!}
                    </p>
                </div>
                <hr>
                <div class="section-header">
                    <h2>{{ __('frontend.purpose') }}</h2>
                </div>
                <div class="details">
                    <p> {!! $item->goals[$locale] ?? $item->goals['en'] !!}
                    </p>
                </div>
            @endforeach
        </div>
    </div>
@endsection
