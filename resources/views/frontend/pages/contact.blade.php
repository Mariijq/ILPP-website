@extends('frontend.layouts.layout')

@section('content')
<div class="contact_us_2">
    <div class="responsive-container-block big-container">

        <div class="blueBG"></div>

        <div class="responsive-container-block container">
            <!-- Shared container -->
            <div class="contact-main-wrapper">

                <!-- Contact Form -->
                <form action="{{ route('contact.messages.store') }}" method="POST" class="form-box">
                    @csrf
                    <div class="container-block form-wrapper">
                        <p class="text-blk contactus-head">{{ __('frontend.get_in_touch') }}</p>
                        <p class="text-blk contactus-subhead">{{ __('frontend.contact_subhead') }}</p>

                        <div class="responsive-container-block">
                            <div class="responsive-cell-block wk-desk-6 wk-ipadp-6 wk-tab-12 wk-mobile-12">
                                <p class="text-blk input-title">{{ __('frontend.first_name') }}</p>
                                <input class="input" name="first_name" placeholder="{{ __('frontend.enter_first_name') }}" value="{{ old('first_name') }}">
                            </div>

                            <div class="responsive-cell-block wk-desk-6 wk-ipadp-6 wk-tab-12 wk-mobile-12">
                                <p class="text-blk input-title">{{ __('frontend.last_name') }}</p>
                                <input class="input" name="last_name" placeholder="{{ __('frontend.enter_last_name') }}" value="{{ old('last_name') }}">
                            </div>

                            <div class="responsive-cell-block wk-desk-6 wk-ipadp-6 wk-tab-12 wk-mobile-12">
                                <p class="text-blk input-title">{{ __('frontend.email') }}</p>
                                <input class="input" type="email" name="email" placeholder="{{ __('frontend.enter_email') }}" value="{{ old('email') }}">
                            </div>

                            <div class="responsive-cell-block wk-desk-6 wk-ipadp-6 wk-tab-12 wk-mobile-12">
                                <p class="text-blk input-title">{{ __('frontend.phone_number') }}</p>
                                <input class="input" name="phone" placeholder="{{ __('frontend.enter_phone') }}" value="{{ old('phone') }}">
                            </div>

                            <div class="responsive-cell-block wk-tab-12 wk-mobile-12 wk-desk-12 wk-ipadp-12">
                                <p class="text-blk input-title">{{ __('frontend.message') }}</p>
                                <textarea class="textinput" name="message" placeholder="{{ __('frontend.enter_message') }}">{{ old('message') }}</textarea>
                            </div>
                        </div>

                        <button type="submit" class="submit-btn">{{ __('frontend.submit') }}</button>
                    </div>
                </form>

                <!-- Contact Details + Map -->
                @php
                    $contact = \App\Models\ContactInfo::first();
                @endphp
                <div class="contact-details-wrapper">
                    <div class="contact-info">
                        <h2>{{ __('frontend.contact_us') }}</h2>
                        <p><i class="bi bi-geo-alt"></i> {{ $contact?->address }}</p>
                        <p><i class="bi bi-envelope"></i>
                            @if ($contact?->email)
                                <a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a>
                            @endif
                        </p>
                        <p><i class="bi bi-telephone"></i> {{ $contact?->phone }}</p>
                        <div class="social-links">
                                                    <p>{{ __('frontend.follow_us') }}
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
