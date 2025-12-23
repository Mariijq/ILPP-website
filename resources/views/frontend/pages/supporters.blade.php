@extends('frontend.layouts.main')
@section('content')
<section class="grid-wrapper">
    <div class="section-header">
        <h2>{{ __('frontend.Strategic_Partners') }}</h2>
    </div>
    <div class="grid-band">
        @foreach($supporters as $supporter)
            <a href="{{ $supporter->website ?? '#' }}" target="_blank" class="card">
                @if($supporter->logo)
                    <div class="thumb" style="background-image: url('{{ asset('storage/' . $supporter->logo) }}');"></div>
                @else
                    <div class="thumb" style="background-color: var(--light-primary-color); display: flex; align-items: center; justify-content: center;">
                        No Logo
                    </div>
                @endif
                <article>
                    <h1>{{ $supporter->localized_name }}</h1>
                    @if($supporter->type)
                        <span>{{ ucfirst($supporter->type) }}</span>
                    @endif
                </article>
            </a>
        @endforeach
    </div>
</section>
@endsection
