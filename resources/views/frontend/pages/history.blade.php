@extends('frontend.layouts.main')
@section('content')
    <div class="details-wrapper">
        <div class="details-main">
            @foreach ($history as $item)
                <div class="details">
                    <h1 style="color: #26a6a0">{!! $item->title !!}</h1>
                    {!! $item->description !!}
                </div>

            @endforeach
        </div>
    </div>
@endsection
