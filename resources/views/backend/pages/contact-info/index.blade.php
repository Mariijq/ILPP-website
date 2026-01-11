@extends('backend.layouts.layout')
@section('title', 'Contact Info')

@section('content')

<form action="{{ route('backend.contact-info.update', $contact->id ?? 0) }}" method="POST">
    @csrf
    @method('PUT') {{-- Important for update --}}

    {{-- Address --}}
    <div class="mb-3">
        <label for="address" class="form-label">Address</label>
        <input type="text" name="address" id="address" class="form-control"
               value="{{ old('address', $contact->address ?? '') }}">
    </div>

    {{-- Email --}}
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" name="email" id="email" class="form-control"
               value="{{ old('email', $contact->email ?? '') }}">
    </div>

    {{-- Phone --}}
    <div class="mb-3">
        <label for="phone" class="form-label">Phone</label>
        <input type="text" name="phone" id="phone" class="form-control"
               value="{{ old('phone', $contact->phone ?? '') }}">
    </div>

    {{-- Facebook --}}
    <div class="mb-3">
        <label for="facebook" class="form-label">Facebook URL</label>
        <input type="url" name="facebook" id="facebook" class="form-control"
               value="{{ old('facebook', $contact->facebook ?? '') }}">
    </div>

    {{-- Instagram --}}
    <div class="mb-3">
        <label for="instagram" class="form-label">Instagram URL</label>
        <input type="url" name="instagram" id="instagram" class="form-control"
               value="{{ old('instagram', $contact->instagram ?? '') }}">
    </div>

    {{-- LinkedIn --}}
    <div class="mb-3">
        <label for="linkedin" class="form-label">LinkedIn URL</label>
        <input type="url" name="linkedin" id="linkedin" class="form-control"
               value="{{ old('linkedin', $contact->linkedin ?? '') }}">
    </div>

    {{-- YouTube --}}
    <div class="mb-3">
        <label for="youtube" class="form-label">YouTube URL</label>
        <input type="url" name="youtube" id="youtube" class="form-control"
               value="{{ old('youtube', $contact->youtube ?? '') }}">
    </div>

    {{-- Map Embed --}}
    <div class="mb-3">
        <label for="map_embed" class="form-label">Map Embed Code</label>
        <textarea name="map_embed" id="map_embed" class="form-control" rows="5">{{ old('map_embed', $contact->map_embed ?? '') }}</textarea>
    </div>

    <div class="d-flex justify-content-end">
        <button type="submit" class="btn btn-custom">Save</button>
    </div>
</form>

@endsection
