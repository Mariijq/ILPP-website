@php
    $contact = \App\Models\ContactInfo::first();
@endphp

<footer class="footer">
    <div class="footer-container">

        <!-- Contact Info + Socials -->
        <div class="footer-column contact-column">
            <h2>{{ __('frontend.contact') }}</h2>

            <div class="footer-contact-row">
                <p><i class="bi bi-geo-alt"></i> {{ $contact?->address }}</p>

                @if ($contact?->email)
                    <p><i class="bi bi-envelope"></i> <a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a></p>
                @endif

                <p><i class="bi bi-telephone"></i> {{ $contact?->phone }}</p>
            </div>

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
                @if ($contact?->youtube)
                    <a href="{{ $contact->youtube }}"><i class="bi bi-youtube"></i></a>
                @endif
            </div>
        </div>

    </div>

    <div class="footer-bottom">
        &copy; {{ date('Y') }} {{ __('frontend.institute_name') }}. All rights reserved.
    </div>
</footer>
