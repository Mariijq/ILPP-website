@extends('frontend.layouts.main')

{{-- @section('title', 'Home | Institute for Leadership and Public Policy (ILPP)') --}}

@section('content')
    <!-- Hero Section -->
@include('frontend.pages.sections.banner')
@include('frontend.pages.sections.projects')
@include('frontend.pages.sections.publications')

    <!-- ================= Testimonials Section ================= -->
@include('frontend.pages.sections.testimonials')
@include('frontend.pages.sections.gallery')


@endsection
