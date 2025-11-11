@extends('frontend.layouts.main')

@section('content')
    <div class="details-wrapper has-sidebar">

        <!-- Main Content -->
        <div class="details-main">
            <header class="details">
                <h1 class="details-title">{{ $newsItem->title }}</h1>

                @if ($newsItem->image)
                    <img src="{{ asset('storage/' . $newsItem->image) }}" alt="{{ $newsItem->title }}" class="details-image">
                @endif

                @if ($newsItem->date)
                    <p class="details-date">{{ \Carbon\Carbon::parse($newsItem->date)->format('M d, Y') }}</p>
                @endif


                @if ($newsItem->subtitle)
                    <h3 class="details-subtitle">{{ $newsItem->subtitle }}</h3>
                @endif

            </header>

            @if ($newsItem->short_description)
                <p class="details-short-description">{{ $newsItem->short_description }}</p>
            @endif

            <div class="details-content">
                {!! $newsItem->detailed_description !!}
            </div>
        </div>

        <!-- Sidebar -->
        <aside class="sidebar">
            <h3 class="sidebar-title">Recent News</h3>

            @foreach ($recentNews as $item)
                <a href="{{ route('news-details', $item->id) }}" class="recent-item">
                    @if ($item->image)
                        <div class="thumb" style="background-image: url('{{ asset('storage/' . $item->image) }}');"></div>
                    @endif
                    <div class="recent-info">
                        <span class="recent-title">{{ $item->title }}</span>
                        @if ($item->short_description)
                            <span class="recent-desc">
                                {{ \Illuminate\Support\Str::limit($item->short_description, 60) }}
                            </span>
                        @endif
                        @if ($item->date)
                            <span class="recent-date">
                                {{ \Carbon\Carbon::parse($item->date)->format('M d, Y') }}
                            </span>
                        @endif
                    </div>
                </a>
            @endforeach
        </aside>

    </div>
@endsection
