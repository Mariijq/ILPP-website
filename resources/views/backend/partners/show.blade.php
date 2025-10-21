@extends('backend.layout')

@section('title', 'Partner Details')

@section('content')
<div class="card">
    <div class="card-header d-flex">
        <a href="{{ route('partners.index') }}" class="btn btn-secondary ms-auto">Back to List</a>
    </div>

    <div class="card-body show">
        <div class="mb-3">
            <label class="fw-bold">Name:</label>
            <p>{{ $partners->name }}</p>
        </div>

        <div class="mb-3">
            <label class="fw-bold">Type:</label>
            <p>{{ ucfirst($partners->type ?? '-') }}</p>
        </div>

        <div class="mb-3">
            <label class="fw-bold">Website:</label>
            <p>
                @if($partners->website)
                    <a href="{{ $partners->website }}" target="_blank">{{ $partners->website }}</a>
                @else
                    <span class="text-muted">N/A</span>
                @endif
            </p>
        </div>

        <div class="mb-3">
            <label class="fw-bold">Order:</label>
            <p>{{ $partners->order ?? '-' }}</p>
        </div>

        <div class="mb-3">
            <label class="fw-bold">Logo:</label>
            <div>
                @if($partners->logo && file_exists(storage_path('app/public/'.$partners->logo)))
                    <img src="{{ asset('storage/'.$partners->logo) }}" class="show-img" style="width:150px;height:150px;object-fit:cover;border-radius:6px;">
                @else
                    <span class="text-muted">No Logo</span>
                @endif
            </div>
        </div>

        <div class="mt-3">
            <a href="{{ route('partners.edit', $partners->id) }}" class="btn btn-primary">Edit</a>
        </div>
    </div>
</div>
@endsection
