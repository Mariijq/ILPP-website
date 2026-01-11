@extends('frontend.layouts.layout')
@php $locale = app()->getLocale(); @endphp

@section('content')

    <!-- Career Council Section -->
    <section class="career-council">
        <div class="container">
            <h1 class="career-title">
                {{ $careerCouncil->title[$locale] ?? ($careerCouncil->title['en'] ?? 'Career Council') }}
            </h1>
            <p class="career-description">
                {!! $careerCouncil->short_description[$locale] ?? ($careerCouncil->short_description['en'] ?? '') !!}
            </p>

            <!-- Career Council Files -->
            @if (!empty($careerCouncil->files) && count($careerCouncil->files))
                <div class="career-files mt-3">
                    <h5>{{ __('frontend.download_files') }}:</h5>
                    <ul>
                        @foreach ($careerCouncil->files as $file)
                            <li>
                                <a href="{{ asset('storage/' . $file) }}" target="_blank" download>
                                    {{ basename($file) }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </section>

    <!-- Council Members Section -->
    <section class="career-members">
        <div class="container">
            <div class="section-header">
                <h2>{{ __('frontend.career_members') }}</h2>
            </div>

            <div class="team-grid">
                @forelse($members as $member)
                    <div class="team-card">
                        <!-- Member Image -->
                        <div class="team-image-wrapper">
                            <img src="{{ asset('storage/' . $member->image) }}"
                                alt="{{ $member->name[$locale] ?? $member->name['en'] }}" loading="lazy">
                        </div>

                        <!-- Basic Info -->
                        <div class="team-info">
                            <h3>{{ $member->name[$locale] ?? ($member->name['en'] ?? '') }}</h3>
                            <span class="position">{{ $member->position[$locale] ?? ($member->position['en'] ?? '') }}</span>
                        </div>

                        <!-- Hover Overlay with Bio + Socials -->
                        <div class="hover-overlay">
                            <p class="bio">{!! $member->bio[$locale] ?? ($member->bio['en'] ?? '') !!}</p>

                            <div class="social-icons">
                                @if (!empty($member->facebook))
                                    <a href="{{ $member->facebook }}" target="_blank"><i class="bi bi-facebook"></i></a>
                                @endif
                                @if (!empty($member->linkedin))
                                    <a href="{{ $member->linkedin }}" target="_blank"><i class="bi bi-linkedin"></i></a>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <p>{{ __('frontend.no_members_found') }}</p>
                @endforelse
            </div>
        </div>
    </section>

@endsection
