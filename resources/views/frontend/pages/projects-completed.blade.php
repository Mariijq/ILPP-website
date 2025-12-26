@extends('frontend.layouts.layout')
@section('content')

<div class="grid-wrapper">

    {{-- Completed Projects --}}
    <header class="section-header">
        <h2>{{ __('frontend.completed_projects') }}</h2>
    </header>

    <div class="grid-band">
        @foreach ($completedProjects as $project)
            <div class="grid-item">
                <a href="{{ route('project-details', $project->id) }}" class="card">
                    <div class="thumb" style="background-image: url('{{ asset('storage/' . $project->image) }}');"></div>
                    <article>
                        <h1>{{ $project->title[$locale] ?? $project->title['en'] }}</h1>
                        @if ($project->date)
                            <span>{{ $project->date->format('d/m/Y') }}</span>
                        @endif
                    </article>
                </a>
            </div>
        @endforeach
    </div>

    {{-- Pagination --}}
    <div class="pagination-wrapper" style="margin-top: 20px;">
        {{ $completedProjects->links('pagination::bootstrap-5') }}
    </div>

</div>
@endsection
