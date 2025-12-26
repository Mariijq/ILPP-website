@extends('frontend.layouts.layout')
@section('content')
@php $locale = app()->getLocale(); @endphp


    <div class="details-wrapper">
        <div class="details-main">
            @foreach ($history as $item)
                <div class="section-header">
                    <h2>{!! $item->title[$locale] ?? $item->title['en'] !!}</h2>
                </div>
                <div class="details">
                    {!! $item->description[$locale] ?? $item->description['en'] !!}
                </div>
            @endforeach
        </div>
    </div>
@endsection
