@php
    $contact = \App\Models\ContactInfo::first();
@endphp

<footer class="footer">
    <div class="footer-container">

        <!-- Column 1: Contact Info + Logo -->
        <div class="footer-column">
            <h2>Contact Us</h2>
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
            <h2>Website Links</h2>
            <ul>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('news') }}">News</a></li>
                <li><a href="{{ route('projects') }}">Projects</a></li>
                <li><a href="{{ route('publications') }}">Publications</a></li>
                <li><a href="{{ route('gallery') }}">Gallery</a></li>
                <li><a href="{{ route('contact') }}">Contact</a></li>
            </ul>
        </div>

        <!-- Column 3: Who We Are -->
        <div class="footer-column">
            <h2>Who We Are</h2>
            <ul>
                <li><a href="{{ route('about') }}">About ILPP</a></li>
                <li><a href="{{ route('history') }}">History</a></li>
                <li><a href="{{ route('what-we-do') }}">What we do</a></li>
                <li><a href="{{ route('team') }}">Our Team</a></li>
                <li><a href="{{ route('partners') }}">Our Partners</a></li>
                <li><a href="{{ route('documents') }}">Internal Documents</a></li>
            </ul>
        </div>

    </div>

    <div class="footer-bottom">
        &copy; {{ date('Y') }} Institute for Leadership and Public Policy (ILPP). All rights reserved.
    </div>
</footer>
