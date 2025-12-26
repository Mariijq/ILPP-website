@extends('backend.layouts.layout')
@section('title', 'Team Members')
@section('content')

@php
    $languages = ['en' => 'English', 'mk' => 'Macedonian', 'al' => 'Albanian'];
@endphp

<div class="card mb-4">
    <div class="card-header">
        <h3>{{ isset($teamMember) ? 'Edit Team Member' : 'Add Team Member' }}</h3>
    </div>
    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form
            action="{{ isset($teamMember) ? route('backend.team-members.update', $teamMember->id) : route('backend.team-members.store') }}"
            method="POST" enctype="multipart/form-data">
            @csrf
            @if (isset($teamMember))
                @method('PUT')
            @endif

            {{-- Tabs for multilingual content --}}
            <ul class="nav nav-tabs" id="teamMemberTabs" role="tablist">
                @foreach ($languages as $code => $label)
                    <li class="nav-item" role="presentation">
                        <button class="nav-link @if ($loop->first) active @endif"
                                id="tab-{{ $code }}" data-bs-toggle="tab"
                                data-bs-target="#tab-content-{{ $code }}" type="button" role="tab">
                            {{ $label }}
                        </button>
                    </li>
                @endforeach
            </ul>

            <div class="tab-content mt-3">
                @foreach ($languages as $code => $label)
                    <div class="tab-pane fade @if ($loop->first) show active @endif"
                         id="tab-content-{{ $code }}" role="tabpanel">

                        {{-- Name --}}
                        <div class="mb-3">
                            <label class="form-label">Name ({{ $label }}) *</label>
                            <input type="text" name="name_{{ $code }}" class="form-control"
                                   value="{{ old('name_' . $code, $teamMember->name[$code] ?? '') }}"
                                   @if ($code === 'en') required @endif>
                        </div>

                        {{-- Position --}}
                        <div class="mb-3">
                            <label class="form-label">Position ({{ $label }})</label>
                            <input type="text" name="position_{{ $code }}" class="form-control"
                                   value="{{ old('position_' . $code, $teamMember->position[$code] ?? '') }}">
                        </div>

                        {{-- Bio --}}
                        <div class="mb-3">
                            <label class="form-label">Bio ({{ $label }})</label>
                            <textarea name="bio_{{ $code }}" class="form-control" rows="4">{{ old('bio_' . $code, $teamMember->bio[$code] ?? '') }}</textarea>
                        </div>

                    </div>
                @endforeach
            </div>

            {{-- Social Links (single fields) --}}
            <div class="mb-3 mt-3">
                <label class="form-label">Facebook</label>
                <input type="url" name="facebook" class="form-control"
                       value="{{ old('facebook', $teamMember->facebook ?? '') }}"
                       placeholder="https://facebook.com/username">
            </div>

            <div class="mb-3">
                <label class="form-label">LinkedIn</label>
                <input type="url" name="linkedin" class="form-control"
                       value="{{ old('linkedin', $teamMember->linkedin ?? '') }}"
                       placeholder="https://linkedin.com/in/username">
            </div>

            {{-- Image --}}
            <div class="mb-3 mt-3">
                <label class="form-label">Image</label>
                <input type="file" name="image" class="form-control">
                @if (isset($teamMember) && $teamMember->image)
                    <img src="{{ asset('storage/' . $teamMember->image) }}" alt="Image"
                         style="width:120px;margin-top:10px;">
                @endif
            </div>

            {{-- Order --}}
            <div class="mb-3">
                <label class="form-label">Order</label>
                <input type="number" name="order" class="form-control"
                       value="{{ old('order', $teamMember->order ?? 0) }}">
            </div>

            {{-- Form Actions --}}
            <div class="d-flex justify-content-end">
                <a href="{{ route('backend.team-members.index') }}" class="btn btn-secondary me-2">Cancel</a>
                <button type="submit" class="btn btn-custom">{{ isset($teamMember) ? 'Update' : 'Save' }}</button>
            </div>

        </form>
    </div>
</div>

@endsection
