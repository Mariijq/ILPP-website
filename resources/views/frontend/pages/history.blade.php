@extends('frontend.layouts.main')
@section('content')
    <div class="details-wrapper">
        <div class="details-main">
            @foreach ($history as $item)
                <div class="section-header">
                    <h2>{!! $item->title !!}</h2>
                </div>
                <div class="details">
                    {!! $item->description !!}
                </div>
            @endforeach
        </div>
    </div>
@endsection
