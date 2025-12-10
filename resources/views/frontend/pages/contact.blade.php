@extends('frontend.layouts.main')

@section('content')
<div class="contact_us_2">
    <div class="responsive-container-block big-container">

        <div class="blueBG"></div>

        <div class="responsive-container-block container">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <!-- Shared container -->
            <div class="contact-main-wrapper">

                <!-- Contact Form -->
                <form action="{{ route('contact.store') }}" method="POST" class="form-box">
                    @csrf
                    <div class="container-block form-wrapper">
                        <p class="text-blk contactus-head">Get in Touch</p>
                        <p class="text-blk contactus-subhead">We’d love to hear from you. Send us a message!</p>

                        <div class="responsive-container-block">
                            <div class="responsive-cell-block wk-desk-6 wk-ipadp-6 wk-tab-12 wk-mobile-12">
                                <p class="text-blk input-title">FIRST NAME</p>
                                <input class="input" name="first_name" placeholder="Please enter first name..." value="{{ old('first_name') }}">
                            </div>

                            <div class="responsive-cell-block wk-desk-6 wk-ipadp-6 wk-tab-12 wk-mobile-12">
                                <p class="text-blk input-title">LAST NAME</p>
                                <input class="input" name="last_name" placeholder="Please enter last name..." value="{{ old('last_name') }}">
                            </div>

                            <div class="responsive-cell-block wk-desk-6 wk-ipadp-6 wk-tab-12 wk-mobile-12">
                                <p class="text-blk input-title">EMAIL</p>
                                <input class="input" type="email" name="email" placeholder="Please enter email..." value="{{ old('email') }}">
                            </div>

                            <div class="responsive-cell-block wk-desk-6 wk-ipadp-6 wk-tab-12 wk-mobile-12">
                                <p class="text-blk input-title">PHONE NUMBER</p>
                                <input class="input" name="phone" placeholder="Please enter phone number..." value="{{ old('phone') }}">
                            </div>

                            <div class="responsive-cell-block wk-tab-12 wk-mobile-12 wk-desk-12 wk-ipadp-12">
                                <p class="text-blk input-title">MESSAGE</p>
                                <textarea class="textinput" name="message" placeholder="Please enter your message...">{{ old('message') }}</textarea>
                            </div>
                        </div>

                        <button type="submit" class="submit-btn">Submit</button>
                    </div>
                </form>

                <!-- Contact Details + Map -->
                @php
                    $contact = \App\Models\ContactInfo::first();
                @endphp
                <div class="contact-details-wrapper">
                    <div class="contact-info">
                        <h2>Contact Us</h2>
                        <p><i class="bi bi-geo-alt"></i> {{ $contact?->address }}</p>
                        <p><i class="bi bi-envelope"></i>
                            @if ($contact?->email)
                                <a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a>
                            @endif
                        </p>
                        <p><i class="bi bi-telephone"></i> {{ $contact?->phone }}</p>
                        <p>Follow us:
                            @if ($contact?->facebook)
                                <a href="{{ $contact->facebook }}"><i class="bi bi-facebook"></i></a>
                            @endif
                            @if ($contact?->instagram)
                                <a href="{{ $contact->instagram }}"><i class="bi bi-instagram"></i></a>
                            @endif
                            @if ($contact?->linkedin)
                                <a href="{{ $contact->linkedin }}"><i class="bi bi-linkedin"></i></a>
                            @endif
                        </p>
                    </div>
                    <div class="contact-map">
                        {!! $contact?->map_embed !!}
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
