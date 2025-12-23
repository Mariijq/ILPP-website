@extends('backend.layout')
@section('title', 'Gallery')
@section('content')

    <form action="{{ route('contact-info.update') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <input type="text" name="address" id="address" class="form-control"
                value="{{ old('address', $contact->address ?? '') }}">
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control"
                value="{{ old('email', $contact->email ?? '') }}">
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" name="phone" id="phone" class="form-control"
                value="{{ old('phone', $contact->phone ?? '') }}">
        </div>

        <div class="mb-3">
            <label for="facebook" class="form-label">Facebook URL</label>
            <input type="url" name="facebook" id="facebook" class="form-control"
                value="{{ old('facebook', $contact->facebook ?? '') }}">
        </div>

        <div class="mb-3">
            <label for="instagram" class="form-label">Instagram URL</label>
            <input type="url" name="instagram" id="instagram" class="form-control"
                value="{{ old('instagram', $contact->instagram ?? '') }}">
        </div>

        <div class="mb-3">
            <label for="linkedin" class="form-label">LinkedIn URL</label>
            <input type="url" name="linkedin" id="linkedin" class="form-control"
                value="{{ old('linkedin', $contact->linkedin ?? '') }}">
        </div>
        <div class="mb-3">
            <label for="youtube" class="form-label">YouTube URL</label>
            <input type="url" name="youtube" id="youtube" class="form-control"
                value="{{ old('youtube', $contact->youtube  ?? '') }}">
        </div>
        <div class="mb-3">
            <label for="map_embed" class="form-label">Map Embed Code</label>
            <textarea name="map_embed" id="map_embed" class="form-control" rows="5">{{ old('map_embed', $contact->map_embed ?? '') }}</textarea>
        </div>

        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-custom">Save</button>
        </div>
    </form>
@endsection
