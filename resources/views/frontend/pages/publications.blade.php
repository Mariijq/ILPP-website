@extends('frontend.layouts.main')

@section('content')

<div class="grid-wrapper">
    <header class="section-header">
        <h2>Publications</h2>
    </header>

    <div class="grid-band">
        @foreach($publications as $publication)
        <div class="grid-item">
            <a href="{{ route('publication-details', $publication->id) }}" class="card">
                <div class="thumb" style="background-image: url('{{ asset('storage/'.$publication->image) }}');"></div>
                <article>
                    <h1>{{ $publication->title }}</h1>
                    @if($publication->date)
                        <span>{{ \Carbon\Carbon::parse($publication->date)->format('M d, Y') }}</span>
                    @endif
                </article>
            </a>
        </div>
        @endforeach
    </div>

</div>

@endsection