@extends('frontend.layouts.main')
@php $locale = app()->getLocale(); @endphp

@section('content')
    <div class="details-wrapper">

        <!-- Main Content -->
        <div class="details-main">
            <header class="details">
                <h1 class="details-title">{{ $project->title[$locale] ?? $project->title['en'] }}</h1>

                @if ($project->image)
                    <img src="{{ asset('storage/' . $project->image) }}" 
                         alt="{{ $project->localized_title }}" 
                         class="details-image">
                @endif

                @if ($project->date)
                    <p class="details-date">{{ \Carbon\Carbon::parse($project->date)->format('M d, Y') }}</p>
                @endif

                @if ($project->subtitle)
                    <h3 class="details-subtitle">{{ $project->subtitle[$locale] ?? $project->subtitle['en'] }}</h3>
                @endif

                @if ($project->status)
                    <p class="details-status">Status: {{ ucfirst($project->status) }}</p>
                @endif
            </header>

            @if ($project->short_description)
                <p class="details-short-description">{{ $project->short_description[$locale] ?? $project->short_description['en'] }}</p>
            @endif

            <div class="details-content">
                {!! $project->detailed_description[$locale] ?? $project->detailed_description['en'] !!}
            </div>
        </div>

    </div>
@endsection
