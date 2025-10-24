@extends('frontend.layouts.main')
@section('content')
    <div class="news-details-wrapper">

        <!-- Main Content -->
        <div class="news-main">
            <header class="news">
                @if ($newsItem->image)
                    <img src="{{ asset('storage/' . $newsItem->image) }}" alt="{{ $newsItem->title }}"
                        style="width:100%; border-radius:5px; margin-bottom: 20px;">
                @endif
                <h1 style="font-weight: bold; margin-bottom: 10px;">{{ $newsItem->title }}</h1>
                @if ($newsItem->subtitle)
                    <h3 style="font-weight: normal; color: #666; margin-bottom: 15px;">{{ $newsItem->subtitle }}</h3>
                @endif
                @if ($newsItem->date)
                    <p style="font-size: 13px; color: #999; margin-bottom: 15px;">
                        {{ \Carbon\Carbon::parse($newsItem->date)->format('M d, Y') }}
                    </p>
                @endif
            </header>

            @if ($newsItem->short_description)
                <p style="font-size: 16px; font-weight: 500; margin-bottom: 20px;">{{ $newsItem->short_description }}</p>
            @endif

            <div class="news-content" style="line-height:1.6; font-size: 15px;">
                {!! $newsItem->detailed_description !!}
            </div>
        </div>

        <!-- Sidebar -->
        <aside class="news-sidebar">
            <h3 style="color: #26a6a0; margin-bottom: 15px;">Recent News</h3>
            @php
                $recentNews = \App\Models\News::where('id', '!=', $newsItem->id)
                    ->orderBy('date', 'desc')
                    ->take(5)
                    ->get();
            @endphp

            @foreach ($recentNews as $item)
                <a href="{{ route('news-details', $item->id) }}" class="recent-news-item">
                    @if ($item->image)
                        <div class="thumb" style="background-image: url('{{ asset('storage/' . $item->image) }}');"></div>
                    @endif
                    <div style="display:flex; flex-direction:column;">
                        <span style="font-weight:bold; font-size: 14px;">{{ $item->title }}</span>
                        @if ($item->short_description)
                            <span
                                style="font-size: 12px; color:#666;">{{ \Illuminate\Support\Str::limit($item->short_description, 50) }}</span>
                        @endif
                        @if ($item->date)
                            <span
                                style="font-size: 11px; color:#999; margin-top:2px;">{{ \Carbon\Carbon::parse($item->date)->format('M d, Y') }}</span>
                        @endif
                    </div>
                </a>
            @endforeach
        </aside>

    </div>
@endsection
