@extends('frontend.layouts.main')
@section('content')
    <div class="details-wrapper">
        <div class="details-main">
            @foreach ($pillars as $pillar)
                <div class="details">
                    <h1 style="color: #26a6a0">Leadership</h1>
                    {!! $pillar->leadership !!}
                </div>
                <hr>
                <div class="details">
                    <h1 style="color: #26a6a0">Research</h1>
                    {!! $pillar->research !!}
                </div>
                <hr>
                <div class="details">
                    <h1 style="color: #26a6a0">Public Policy</h1>
                    {!! $pillar->public_policy !!}
                </div>
            @endforeach
        </div>
    </div>
@endsection
