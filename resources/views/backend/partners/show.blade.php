@extends('backend.layout')
@section('title', 'Partner Details')

@section('content')
<div class="partner-details">
    <h2>{{ $partner->name }}</h2>
    <p><strong>Type:</strong> {{ ucfirst($partner->type) }}</p>
    <p><strong>Website:</strong> 
        @if($partner->website)
            <a href="{{ $partner->website }}" target="_blank">{{ $partner->website }}</a>
        @else
            N/A
        @endif
    </p>
    <p><strong>Order:</strong> {{ $partner->order }}</p>
    <p><strong>Logo:</strong></p>
    @if($partner->logo)
        <img src="{{ asset('storage/'.$partner->logo) }}" alt="Logo" style="width:150px;height:150px;object-fit:cover;">
    @else
        <span class="text-muted">No Logo</span>
    @endif

    <div class="mt-3">
        <a href="{{ route('partners.edit', $partner->id) }}" class="btn btn-primary">Edit</a>
        <a href="{{ route('partners.index') }}" class="btn btn-secondary">Back to List</a>
    </div>
</div>
@endsection
