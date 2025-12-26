@extends('frontend.layouts.layout')
@php $locale = app()->getLocale(); @endphp
@section('content')
    <section class="team-section">
        <div class="section-header">
            <h2>{{ __('frontend.team') }}</h2>
        </div>
        <div class="team-grid">
            @foreach ($members as $member)
                <div class="team-card">
                    <!-- Team Image -->
                    <div class="team-image-wrapper"
                        style="background-image: url('{{ asset('storage/' . $member->image) }}');">
                    </div>

                    <!-- Basic Info -->
                    <div class="team-info">
                        <h3>{{ $member->name[$locale] ?? $member->name['en'] }}</h3>
                        <span class="position">{{ $member->position[$locale] ?? $member->position['en'] }}</span>
                    </div>

                    <!-- Hover Overlay with Bio + Socials -->
                    <div class="hover-overlay">
                        <p class="bio">{{ $member->bio[$locale] ?? $member->bio['en'] }}</p>
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
            @endforeach
        </div>
    </section>
@endsection
