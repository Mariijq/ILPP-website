@php
    $contact = \App\Models\ContactInfo::first();
@endphp

<footer class="footer">
    <div class="footer-container">

        <!-- Column 1: Contact Info + Logo -->
        <div class="footer-column">
            <h2>{{ __('frontend.contact') }}</h2>
            <p><i class="bi bi-geo-alt"></i> {{ $contact?->address }}</p>
            <p><i class="bi bi-envelope"></i>
                @if ($contact?->email)
                    <a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a>
                @endif
            </p>
            <p><i class="bi bi-telephone"></i> {{ $contact?->phone }}</p>
            <div class="footer-social">
                @if ($contact?->facebook)
                    <a href="{{ $contact->facebook }}"><i class="bi bi-facebook"></i></a>
                @endif
                @if ($contact?->instagram)
                    <a href="{{ $contact->instagram }}"><i class="bi bi-instagram"></i></a>
                @endif
                @if ($contact?->linkedin)
                    <a href="{{ $contact->linkedin }}"><i class="bi bi-linkedin"></i></a>
                @endif
            </div>
        </div>

        <!-- Column 2: Website Links -->
        <div class="footer-column">
            <h2>{{ __('frontend.website_links') }}</h2>
            <ul>
                <li><a href="{{ route('home') }}">{{ __('frontend.home') }}</a></li>
                <li><a href="{{ route('news') }}">{{ __('frontend.news') }}</a></li>
                <li><a href="{{ route('projects') }}">{{ __('frontend.projects') }}</a></li>
                <li><a href="{{ route('publications') }}">{{ __('frontend.publications') }}</a></li>
                <li><a href="{{ route('gallery') }}">{{ __('frontend.gallery') }}</a></li>
                <li><a href="{{ route('contact') }}">{{ __('frontend.contact_us') }}</a></li>
            </ul>
        </div>

        <!-- Column 3: Who We Are -->
        <div class="footer-column">
            <h2>{{ __('frontend.who_we_are_footer') }}</h2>
            <ul>
                <li><a href="{{ route('about') }}">{{ __('frontend.about_ilpp') }}</a></li>
                <li><a href="{{ route('history') }}">{{ __('frontend.history') }}</a></li>
                <li><a href="{{ route('what-we-do') }}">{{ __('frontend.what_we_do') }}</a></li>
                <li><a href="{{ route('team') }}">{{ __('frontend.our_team') }}</a></li>
                <li><a href="{{ route('partners') }}">{{ __('frontend.our_partners') }}</a></li>
                <li><a href="{{ route('documents') }}">{{ __('frontend.internal_documents') }}</a></li>
            </ul>
        </div>

    </div>

    <div class="footer-bottom">
        &copy; {{ date('Y') }} {{ __('frontend.institute_name') }}. All rights reserved.
    </div>
</footer>
