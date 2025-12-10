<div class="projects-section">
    <h2 class="section-title">Projects</h2>

    <div class="projects-grid">
        @foreach ($projects->take(3) as $project)
            <a href="{{ route('project-details', $project->id) }}" class="project-card">

                <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}" class="project-img">

                <div class="project-overlay"></div>

                <div class="project-info">
                    <h3>{{ $project->title }}</h3>
                </div>

            </a>
        @endforeach
    </div>
</div>
