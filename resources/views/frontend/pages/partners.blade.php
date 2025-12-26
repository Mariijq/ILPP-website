@extends('frontend.layouts.layout')
@section('content')
<section class="grid-wrapper">
    <div class="section-header">
        <h2>{{ __('frontend.Funding_&_Support') }}</h2>
    </div>
    <div class="grid-band">
        @foreach($partners as $partner)
            <a href="{{ $partner->website ?? '#' }}" target="_blank" class="card">
                @if($partner->logo)
                    <div class="thumb" style="background-image: url('{{ asset('storage/' . $partner->logo) }}');"></div>
                @else
                    <div class="thumb" style="background-color: var(--light-primary-color); display: flex; align-items: center; justify-content: center;">
                        No Logo
                    </div>
                @endif
                <article>
<h1>{{ $partner->localized_name }}</h1>
                    @if($partner->type)
                        <span>{{ ucfirst($partner->type) }}</span>
                    @endif
                </article>
            </a>
        @endforeach
    </div>
</section>
@endsection
