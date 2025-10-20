@extends('backend.layout')

@section('content')
    <h4 class="mb-4">{{ isset($teamMember) ? 'Edit Team Member' : 'Add Team Member' }}</h4>

    <div class="card p-4 shadow-sm border-0">
        {{-- <h4 class="mb-4">{{ isset($teamMember) ? 'Edit Team Member' : 'Add Team Member' }}</h4> --}}

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ isset($teamMember) ? route('team-members.update', $teamMember->id) : route('team-members.store') }}"
            method="POST" enctype="multipart/form-data">
            @csrf
            @if (isset($teamMember))
                @method('PUT')
            @endif

            <div class="mb-3">
                <label for="name" class="form-label fw-semibold">Name *</label>
                <input type="text" name="name" id="name" class="form-control"
                    value="{{ old('name', $teamMember->name ?? '') }}" required>
            </div>

            <div class="mb-3">
                <label for="position" class="form-label fw-semibold">Position</label>
                <input type="text" name="position" id="position" class="form-control"
                    value="{{ old('position', $teamMember->position ?? '') }}">
            </div>

            <div class="mb-3">
                <label for="bio" class="form-label fw-semibold">Bio</label>
                <textarea name="bio" id="bio" class="form-control" rows="5">{{ old('bio', $teamMember->bio ?? '') }}</textarea>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label fw-semibold">Image</label>
                <input type="file" name="image" id="image" class="form-control">
                @if (isset($teamMember) && $teamMember->image)
                    <img src="{{ asset('storage/' . $teamMember->image) }}" alt="Current Image" class="mt-3 rounded"
                        style="width:120px; height:auto; object-fit:cover;">
                @endif
            </div>

            <div class="mb-3">
                <label for="order" class="form-label fw-semibold">Order</label>
                <input type="number" name="order" id="order" class="form-control"
                    value="{{ old('order', $teamMember->order ?? 0) }}">
            </div>

            <div class="d-flex justify-content-end mt-4">
                <a href="{{ route('team-members.index') }}" class="btn btn-secondary me-2">Cancel</a>
                <button type="submit" class="btn btn-custom">
                    {{ isset($teamMember) ? 'Update' : 'Save' }}
                </button>
            </div>
        </form>
    </div>
@endsection
