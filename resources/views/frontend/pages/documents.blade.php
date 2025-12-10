@extends('frontend.layouts.main')
@section('content')
<div class="grid-wrapper">

    <div class="section-header">
        <h2>Documents</h2>
    </div>
    <div class="grid-wrapper">
        <div class="grid-band">
            @foreach ($documents as $document)
                <div class="card">
                    <article>
                        <h1>{{ $document->title }}</h1>
                        @if ($document->description)
                            <p>{{ strip_tags($document->description) }}</p>
                        @endif
                        <a href="{{ asset('storage/' . $document->file_path) }}" target="_blank" class="btn"
                            style="margin-top:auto; display:inline-block; padding:8px 12px; border-radius:5px; background-color: var(--primary-color); color:#fff; text-decoration:none;">Download</a>
                    </article>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
