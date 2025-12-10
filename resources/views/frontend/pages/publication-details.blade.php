@extends('frontend.layouts.main')

@section('content')
    <div class="details-wrapper has-sidebar">

        <!-- Main Content -->
        <div class="details-main">
            <header class="details">
                <h1 class="details-title">{{ $publications->title }}</h1>

                @if ($publications->image)
                    <img src="{{ asset('storage/' . $publications->image) }}" alt="{{ $publications->title }}"
                        class="details-image">
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
                @if ($publications->file)
                    <div class="publication-file mt-3 d-flex gap-2">
                        <!-- Open file in browser -->
                        <a href="{{ route('publications.open', $publications->id) }}" target="_blank"
                            class="btn btn-secondary">
                            <i class="bi bi-eye"></i> Open File
                        </a>

                        <!-- Download file -->
                        <a href="{{ route('publications.download', $publications->id) }}" class="btn btn-custom">
                            <i class="bi bi-download"></i> Download File
                        </a>
                    </div>
                @endif

            </div>
        </div>
    </div>
@endsection
