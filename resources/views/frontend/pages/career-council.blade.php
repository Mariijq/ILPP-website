@extends('frontend.layouts.layout')

@section('content')

@php $locale = app()->getLocale(); @endphp

<!-- Career Council Hero Section -->
<section class="career-council-hero">
    <div class="container">
        <h1 class="career-title">
            {{ $careerCouncil->title[$locale] ?? $careerCouncil->title['en'] ?? 'Career Council' }}
        </h1>
        <p class="career-description">
            {{ $careerCouncil->short_description[$locale] ?? $careerCouncil->short_description['en'] ?? '' }}
        </p>
    </div>
</section>

<!-- Career Council Members Section -->
<section class="team-section">
    <div class="container">
        <div class="section-header">
            <h2>{{ __('frontend.career_members') }}</h2>
        </div>

        <div class="team-grid">
            @forelse($members as $member)
                <div class="team-card">
                    <!-- Member Image -->
                    <div class="team-image-wrapper"
                         style="background-image: url('{{ $member->image ? asset('storage/' . $member->image) : asset('images/no-image.png') }}');">
                    </div>

                    <!-- Member Info -->
                    <div class="team-info">
                        <h3>{{ $member->name[$locale] ?? $member->name['en'] ?? '' }}</h3>
                        @if(!empty($member->position))
                            <span class="position">{{ $member->position[$locale] ?? $member->position['en'] ?? '' }}</span>
                        @endif
                    </div>

                    <!-- Hover Overlay with Bio -->
                    <div class="hover-overlay">
                        <p class="bio">{{ $member->bio[$locale] ?? $member->bio['en'] ?? '' }}</p>
                    </div>
                </div>
            @empty
                <p>{{ __('frontend.no_members_found') }}</p>
            @endforelse
        </div>
    </div>
</section>

@endsection
