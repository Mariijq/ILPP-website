@extends('frontend.layouts.layout')

@section('content')

@php $locale = app()->getLocale(); @endphp

<div class="grid-wrapper">
    <header class="section-header">
        <h2>{{ __('frontend.news') }}</h2>
    </header>

    <div class="grid-band">
        @foreach($news as $item)
            <div class="grid-item">
                <a href="{{ route('news-details', $item->id) }}" class="card">
                    <div class="thumb" style="background-image: url('{{ asset('storage/'.$item->image) }}');"></div>
                    <article>
                        <h1>{{ $item->title[$locale] ?? $item->title['en'] }}</h1>
                        @if($item->date)
                            <span>{{ \Carbon\Carbon::parse($item->date)->format('M d, Y') }}</span>
                        @endif
                    </article>
                </a>
            </div>
        @endforeach
    </div>

    <div class="pagination-wrapper">
        {{ $news->links('pagination::bootstrap-5') }}
    </div>
</div>

@endsection
