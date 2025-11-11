@extends('frontend.layouts.main')
@section('content')
    <div class="details-wrapper">
        <div class="details-main">
            @foreach ($about as $item)
                <div class="details">
                    <h1>Vision</h1>
                    <p> {!! $item->vision !!}
                    </p>
                </div>
                <hr>
                <div class="details">
                    <h1>Mission</h1>
                    <p> {!! $item->mision !!}
                    </p>
                </div>
                <hr>
                <div class="details">
                    <h1>Goals</h1>
                    <p> {!! $item->goals !!}
                    </p>
                </div>
            @endforeach
        </div>
    </div>
@endsection
