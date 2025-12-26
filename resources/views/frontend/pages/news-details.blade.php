@extends('frontend.layouts.layout')

@section('content')

@php $locale = app()->getLocale(); @endphp

<div class="details-wrapper has-sidebar">

    <!-- Main Content -->
    <div class="details-main">
        <header class="details">
            <h1 class="details-title">{{ $newsItem->title[$locale] ?? $newsItem->title['en'] }}</h1>

            @if ($newsItem->image)
                <img src="{{ asset('storage/' . $newsItem->image) }}" alt="{{ $newsItem->title[$locale] ?? $newsItem->title['en'] }}" class="details-image">
            @endif

            @if ($newsItem->date)
                <p class="details-date">{{ \Carbon\Carbon::parse($newsItem->date)->format('M d, Y') }}</p>
            @endif

            @if ($newsItem->subtitle)
                <h3 class="details-subtitle">{{ $newsItem->subtitle[$locale] ?? $newsItem->subtitle['en'] }}</h3>
            @endif
        </header>

        @if ($newsItem->short_description)
            <p class="details-short-description">{{ $newsItem->short_description[$locale] ?? $newsItem->short_description['en'] }}</p>
        @endif

        <div class="details-content">
            {!! $newsItem->detailed_description[$locale] ?? $newsItem->detailed_description['en'] !!}
        </div>

        <!-- Media Gallery -->
        @if($newsItem->media && $newsItem->media->count())
            <div class="media-gallery">
                <h3 class="sidebar-title">Gallery</h3>
                <div class="grid-band">
                    @foreach($newsItem->media as $media)
                        @if($media->type === 'image')
                            <a href="{{ asset('storage/' . $media->path) }}" target="_blank" class="card">
                                <div class="thumb" style="background-image: url('{{ asset('storage/' . $media->path) }}');"></div>
                            </a>
                        @elseif($media->type === 'video')
                            <div class="card">
                                <video controls style="width:100%; max-height:300px;">
                                    <source src="{{ asset('storage/' . $media->path) }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        @endif
    </div>

</div>

@endsection
