@extends('frontend.layouts.layout')

@section('content')
<div class="search-results-container">

    <h2 class="search-title">
        Search results for: <strong>{{ $query }}</strong>
    </h2>

    @forelse ($results as $group => $items)
        <h3 class="result-group-title">{{ $group }}</h3>

        <div class="grid-band">
            @foreach ($items as $item)
                <div class="grid-item">
                    <a href="{{ $item['link'] }}" class="card" style="text-decoration:none;color:inherit;">
                        <div class="thumb" style="background-image:url('{{ $item['image'] }}');"></div>
                        <article>
                            <h3>{{ $item['title'] }}</h3>
                        </article>
                    </a>
                </div>
            @endforeach
        </div>
    @empty
        <p class="no-results">No results found.</p>
    @endforelse

</div>
@endsection
