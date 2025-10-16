@extends('layouts.main')

{{-- @section('title', 'Home | Institute for Leadership and Public Policy (ILPP)') --}}

@section('content')
    <!-- Hero Section -->
    <section id="home" class="hero">
        <div class="hero-content">
            <h1>Building Leadership for Better Policy</h1>
            <p>Empowering young leaders and policymakers to shape inclusive public policy.</p>
            <a href="{{ route('home') }}" class="btn">Learn More</a>
        </div>
    </section>

    <!-- Programs -->
    <section id="programs" class="programs">
        <h2>Our Programs</h2>
        <div class="program-grid">
            <div class="program-card">Youth Leadership Academy</div>
            <div class="program-card">Policy Innovation Lab</div>
            <div class="program-card">Research Fellowship</div>
        </div>
    </section>

    <!-- More sections ... -->
@endsection
