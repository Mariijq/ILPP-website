@extends('frontend.layouts.main')
@section('content')

<header class="news">Latest News</header>

<div class="band">
    @foreach($news as $item)
    <div class="item">
        <a href="{{ route('news-details', $item->id) }}" class="card-news">
            <div class="thumb" style="background-image: url('{{ asset('storage/'.$item->image) }}');"></div>
            <article>
                <h1>{{ $item->title }}</h1>
                @if($item->short_description)
                <p>{{ $item->short_description }}</p>
                @endif
                @if($item->date)
                <span>{{ \Carbon\Carbon::parse($item->date)->format('M d, Y') }}</span>
                @endif
            </article>
        </a>
    </div>
    @endforeach
</div>

@endsection