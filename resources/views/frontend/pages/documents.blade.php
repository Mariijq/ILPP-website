@extends('frontend.layouts.main')
@section('content')
@php 
    $locale = app()->getLocale();
@endphp
<div class="grid-wrapper">

    <div class="section-header">
        <h2>{{ __('frontend.documents') }}</h2>
    </div>
    <div class="grid-wrapper">
        <div class="grid-band">
            @foreach ($documents as $document)
                <div class="card">
                    <article>
                        <h1>{{ $document->title[$locale] ?? $document->title['en'] }}</h1>
                        @if ($document->description)
                            <p>{{ strip_tags($document->description[$locale] ?? $document->description['en']) }}</p>
                        @endif
                        <a href="{{ asset('storage/' . $document->file_path) }}" target="_blank" class="btn"
                            style="margin-top:auto; display:inline-block; padding:8px 12px; border-radius:5px; background-color: var(--cyan-color); color:#fff; text-decoration:none;">Download</a>
                    </article>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
