@extends('frontend.layouts.main')

@section('content')
<section class="grid-wrapper">
    <div class="section-header">
        <h2>Our Team</h2>
    </div>

    <div class="grid-band">
        @foreach ($members as $member)
            <div class="card team-card">
                <div class="thumb team-image-wrapper" 
                     style="background-image: url('{{ asset('storage/'.$member->image) }}');">
                </div>
                <article>
                    <h1>{{ $member->name }}</h1>
                    <span class="position">{{ $member->position }}</span>
                    <p class="feature-text">{{ $member->bio }}</p>
                    <div class="social-icons">
                        @if($member->twitter)
                            <a href="{{ $member->twitter }}" target="_blank">
                                <img class="twitter-icon" src="{{ asset('images/twitter-icon.png') }}" alt="Twitter">
                            </a>
                        @endif
                        @if($member->facebook)
                            <a href="{{ $member->facebook }}" target="_blank">
                                <img class="facebook-icon" src="{{ asset('images/facebook-icon.png') }}" alt="Facebook">
                            </a>
                        @endif
                    </div>
                </article>
            </div>
        @endforeach
    </div>
</section>
@endsection
