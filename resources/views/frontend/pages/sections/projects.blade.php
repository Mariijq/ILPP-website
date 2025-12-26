<div class="projects-section">
    <h2 class="section-title">{{ __('frontend.projects') }}</h2>

    <div class="projects-grid">
        @foreach ($projects as $project)
            <a href="{{ route('project-details', $project->id) }}" class="project-card">

                <img src="{{ asset('storage/' . $project->image) }}" 
                     alt="{{ $project->title[app()->getLocale()] ?? $project->title['en'] }}" 
                     class="project-img">

                <div class="project-overlay"></div>

                <div class="project-info">
                    <h3>{{ $project->title[app()->getLocale()] ?? $project->title['en'] }}</h3>
                </div>

            </a>
        @endforeach
    </div>
</div>
