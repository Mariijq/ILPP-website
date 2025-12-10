@extends('frontend.layouts.main')

@section('content')
    <div class="details-wrapper">

        <!-- Main Content -->
        <div class="details-main">
            <header class="details">
                <h1 class="details-title">{{ $project->title }}</h1>

                @if ($project->image)
                    <img src="{{ asset('storage/' . $project->image) }}" 
                         alt="{{ $project->title }}" 
                         class="details-image">
                @endif

                @if ($project->date)
                    <p class="details-date">{{ \Carbon\Carbon::parse($project->date)->format('M d, Y') }}</p>
                @endif

                @if ($project->subtitle)
                    <h3 class="details-subtitle">{{ $project->subtitle }}</h3>
                @endif

                @if ($project->status)
                    <p class="details-status">Status: {{ ucfirst($project->status) }}</p>
                @endif
            </header>

            @if ($project->short_description)
                <p class="details-short-description">{{ $project->short_description }}</p>
            @endif

            <div class="details-content">
                {!! $project->detailed_description !!}
            </div>
        </div>

    </div>
@endsection
