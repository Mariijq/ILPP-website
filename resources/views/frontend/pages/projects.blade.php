@extends('frontend.layouts.main')
@section('content')

<div class="grid-wrapper">

    {{-- Ongoing Projects --}}
    <header class="section-header">
        <h2>{{ __('frontend.ongoing_projects') }}</h2>
    </header>

    <div class="grid-band">
        @foreach($ongoingProjects as $project)
            <div class="grid-item">
                <a href="{{ route('project-details', $project->id) }}" class="card">
                    <div class="thumb" style="background-image: url('{{ asset('storage/'.$project->image) }}');"></div>
                    <article>
                        <h1>{{ $project->title }}</h1>
                        @if($project->date)
                            <span>{{ \Carbon\Carbon::parse($project->date)->translatedFormat(__('frontend.project_date_format')) }}</span>
                        @endif
                    </article>
                </a>
            </div>
        @endforeach
    </div>

    {{-- Ongoing Projects Pagination --}}
    <div class="pagination-wrapper" style="margin-top: 20px;">
        {{ $ongoingProjects->links('pagination::bootstrap-5') }}
    </div>

    {{-- Finished Projects --}}
    <header class="section-header mt-5">
        <h2>{{ __('frontend.finished_projects') }}</h2>
    </header>

    <div class="grid-band">
        @foreach($finishedProjects as $project)
            <div class="grid-item">
                <a href="{{ route('project-details', $project->id) }}" class="card">
                    <div class="thumb" style="background-image: url('{{ asset('storage/'.$project->image) }}');"></div>
                    <article>
                        <h1>{{ $project->title }}</h1>
                        @if($project->date)
                            <span>{{ \Carbon\Carbon::parse($project->date)->translatedFormat(__('frontend.project_date_format')) }}</span>
                        @endif
                    </article>
                </a>
            </div>
        @endforeach
    </div>

    {{-- Finished Projects Pagination --}}
    <div class="pagination-wrapper" style="margin-top: 20px;">
        {{ $finishedProjects->links('pagination::bootstrap-5') }}
    </div>

</div>

@endsection
