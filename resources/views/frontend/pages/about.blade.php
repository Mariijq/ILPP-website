@extends('frontend.layouts.main')
@section('content')
    <div class="details-wrapper">
        <div class="details-main">
            @foreach ($about as $item)
                <div class="section-header">
                    <h2>Vision</h2>
                </div>
                <div class="details">
                    <p> {!! $item->vision !!}
                    </p>
                </div>
                <hr>
                <div class="section-header">
                    <h2>Mission</h2>
                </div>
                <div class="details">
                    <p> {!! $item->mision !!}
                    </p>
                </div>
                <hr>
                <div class="section-header">
                    <h2>Vision</h2>
                </div>
                <div class="details">
                    <p> {!! $item->goals !!}
                    </p>
                </div>
            @endforeach
        </div>
    </div>
@endsection
