@php
$contact = \App\Models\ContactInfo::first();
@endphp

<footer id="contact" class="footer">
    <div class="footer-container">
        <div class="footer-left">
            <h2>Contact Us</h2>
            <p><i class="bi bi-geo-alt"></i> {{ $contact?->address }}</p>
            <br>
            <p><i class="bi bi-envelope"></i> {{ $contact?->email }}</p>
            <br>
            <p><i class="bi bi-telephone"></i> {{ $contact?->phone }}</p>
            <br>
            <p>Follow us:
                @if($contact?->facebook)<a href="{{ $contact->facebook }}"><i class="bi bi-facebook"></i></a>@endif
                @if($contact?->instagram)<a href="{{ $contact->instagram }}"><i class="bi bi-instagram"></i></a>@endif
                @if($contact?->linkedin)<a href="{{ $contact->linkedin }}"><i class="bi bi-linkedin"></i></a>@endif
            </p>
        </div>
        <div class="footer-right">
            {!! $contact?->map_embed !!}
        </div>
    </div>
    <div class="footer-bottom">
        &copy; {{ date('Y') }} Institute for Leadership and Public Policy (ILPP). All rights reserved.
    </div>
</footer>
