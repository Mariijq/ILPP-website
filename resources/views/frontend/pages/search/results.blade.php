@extends('frontend.layouts.main')

@section('content')
    <div class="search-results-container">

        <h2 class="search-title">
            Search results for: <strong>{{ $query }}</strong>
        </h2>

        @foreach ($results as $group => $items)
            @if ($items->count() > 0)
                <div class="grid-band">
                    @foreach ($items as $item)
                        @php
                            // Title / name
                            $title = $item->title ?? ($item->name ?? null);

                            // Image handling (public/storage path)
                            $image = $item->image ?? ($item->photo ?? ($item->thumbnail ?? null));
                            $imageUrl = $image ? asset('storage/' . $image) : asset('images/placeholder.png');

                            // Detail page link
                            $link = isset($routes[$group]) ? route($routes[$group], $item->id) : '#';
                        @endphp

                        @if ($title)
                            <div class="grid-item">
                                <a href="{{ $link }}" class="card" style="text-decoration: none; color: inherit;">
                                    @if ($image)
                                        <div class="thumb" style="background-image: url('{{ $imageUrl }}');"></div>
                                    @endif
                                    <article>
                                        <h3>{{ $title }}</h3>
                                    </article>
                                </a>
                            </div>
                        @endif
                    @endforeach
                </div>
            @endif
        @endforeach

        @if ($results->isEmpty())
            <p class="no-results">No results found.</p>
        @endif

    </div>
@endsection
