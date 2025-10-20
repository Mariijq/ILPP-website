@extends('backend.layout')

@section('content')
        <h4 class="mb-4">{{ isset($partner) ? 'Edit Partner' : 'Add Partner' }}</h4>

    <div class="partner-form">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ isset($partner) ? route('partners.update', $partner->id) : route('partners.store') }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @if (isset($partner))
                @method('PUT')
            @endif

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" id="name" class="form-control"
                    value="{{ old('name', $partner->name ?? '') }}" required>
            </div>

            <div class="mb-3">
                <label for="type" class="form-label">Type</label>
                <select name="type" id="type" class="form-select" required>
                    <option value="person" {{ old('type', $partner->type ?? '') == 'person' ? 'selected' : '' }}>Person
                    </option>
                    <option value="organization"
                        {{ old('type', $partner->type ?? '') == 'organization' ? 'selected' : '' }}>Organization</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="logo" class="form-label">Logo / Image</label>
                <input type="file" name="logo" id="logo" class="form-control">
                @if (isset($partner) && $partner->logo)
                    <img src="{{ asset('storage/' . $partner->logo) }}" alt="Logo"
                        style="width:80px;height:80px;margin-top:10px;">
                @endif
            </div>

            <div class="mb-3">
                <label for="website" class="form-label">Website (optional)</label>
                <input type="url" name="website" id="website" class="form-control"
                    value="{{ old('website', $partner->website ?? '') }}">
            </div>

            <div class="mb-3">
                <label for="order" class="form-label">Order</label>
                <input type="number" name="order" id="order" class="form-control"
                    value="{{ old('order', $partner->order ?? 0) }}">
            </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('partners.index') }}" class="btn btn-secondary me-2">Cancel</a>
                    <button type="submit" class="btn btn-custom">
                        {{ isset($partner) ? 'Update' : 'Save' }}
                    </button>
                </div>
        </form>
    </div>
@endsection
