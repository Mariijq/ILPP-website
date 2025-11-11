@extends('frontend.layouts.main')

@section('content')
    <div class="details-wrapper has-sidebar">

        <!-- Main Content -->
        <div class="details-main">
            <header class="details">
                <h1 class="details-title">{{ $publications->title }}</h1>

                @if ($publications->image)
                    <img src="{{ asset('storage/' . $publications->image) }}" alt="{{ $publications->title }}" class="details-image">
                @endif

                @if ($publications->date)
                    <p class="details-date">{{ \Carbon\Carbon::parse($publications->date)->format('M d, Y') }}</p>
                @endif

            </header>

            @if ($publications->short_description)
                <p class="details-short-description">{{ $publications->short_description }}</p>
            @endif

            <div class="details-content">
                {!! $publications->detailed_description !!}
            </div>
        </div>
    </div>
@endsection
