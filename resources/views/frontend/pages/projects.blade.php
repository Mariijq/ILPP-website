@extends('frontend.layouts.main')
@section('content')

<div class="grid-wrapper">
    <header class="section-header">
        <h2>Ongoing Projects</h2>
    </header>

    <div class="grid-band">
        @foreach($ongoingProjects as $project)
        <div class="grid-item">
            <a href="{{ route('project-details', $project->id) }}" class="card">
                <div class="thumb" style="background-image: url('{{ asset('storage/'.$project->image) }}');"></div>
                <article>
                    <h1>{{ $project->title }}</h1>
                    @if($project->short_description)
                        <p>{{ $project->short_description }}</p>
                    @endif
                    @if($project->date)
                        <span>{{ \Carbon\Carbon::parse($project->date)->format('M d, Y') }}</span>
                    @endif
                </article>
            </a>
        </div>
        @endforeach
    </div>

    <header class="section-header mt-5">
        <h2>Finished Projects</h2>
    </header>

    <div class="grid-band">
        @foreach($finishedProjects as $project)
        <div class="grid-item">
            <a href="{{ route('project-details', $project->id) }}" class="card">
                <div class="thumb" style="background-image: url('{{ asset('storage/'.$project->image) }}');"></div>
                <article>
                    <h1>{{ $project->title }}</h1>
                    @if($project->short_description)
                        <p>{{ $project->short_description }}</p>
                    @endif
                    @if($project->date)
                        <span>{{ \Carbon\Carbon::parse($project->date)->format('M d, Y') }}</span>
                    @endif
                </article>
            </a>
        </div>
        @endforeach
    </div>
</div>

@endsection
