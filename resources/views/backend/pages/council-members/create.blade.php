@extends('backend.layouts.layout')
@section('title', 'Council Members')
@section('content')

@php
    $languages = ['en' => 'English', 'mk' => 'Macedonian', 'al' => 'Albanian'];
@endphp

<div class="card mb-4">
    <div class="card-header">
        <h3>{{ isset($member) ? 'Edit Council Member' : 'Add Council Member' }}</h3>
    </div>

    <div class="card-body">
        <form
            action="{{ isset($member)
                ? route('backend.council-members.update', $member->id)
                : route('backend.council-members.store') }}"
            method="POST"
            enctype="multipart/form-data">

            @csrf
            @isset($member)
                @method('PUT')
            @endisset

            {{-- Language Tabs --}}
            <ul class="nav nav-tabs" role="tablist">
                @foreach ($languages as $code => $label)
                    <li class="nav-item" role="presentation">
                        <button
                            type="button"
                            class="nav-link @if($loop->first) active @endif"
                            data-bs-toggle="tab"
                            data-bs-target="#lang-{{ $code }}"
                            role="tab">
                            {{ $label }}
                        </button>
                    </li>
                @endforeach
            </ul>

            {{-- Tab Content --}}
            <div class="tab-content mt-3">
                @foreach ($languages as $code => $label)
                    <div
                        class="tab-pane fade @if($loop->first) show active @endif"
                        id="lang-{{ $code }}"
                        role="tabpanel">

                        {{-- Name --}}
                        <div class="mb-3">
                            <label class="form-label">
                                Name ({{ $label }}) @if($code === 'en') * @endif
                            </label>
                            <input
                                type="text"
                                name="name[{{ $code }}]"
                                class="form-control"
                                value="{{ old("name.$code", $member->name[$code] ?? '') }}"
                                @if($code === 'en') required @endif>
                        </div>

                        {{-- Position --}}
                        <div class="mb-3">
                            <label class="form-label">
                                Position ({{ $label }}) @if($code === 'en') * @endif
                            </label>
                            <input
                                type="text"
                                name="position[{{ $code }}]"
                                class="form-control"
                                value="{{ old("position.$code", $member->position[$code] ?? '') }}"
                                @if($code === 'en') required @endif>
                        </div>

                        {{-- Bio --}}
                        <div class="mb-3">
                            <label class="form-label">Bio ({{ $label }})</label>
                            <textarea
                                name="bio[{{ $code }}]"
                                class="form-control ckeditor"
                                rows="4">{{ old("bio.$code", $member->bio[$code] ?? '') }}</textarea>
                        </div>

                    </div>
                @endforeach
            </div>

            {{-- Image --}}
            <div class="mb-3 mt-3">
                <label class="form-label">Image</label>
                <input type="file" name="image" class="form-control">

                @if(isset($member->image) && $member->image)
                    <div class="mt-2">
                        <img
                            src="{{ asset('storage/'.$member->image) }}"
                            width="120"
                            class="rounded"
                            alt="Member Image">
                    </div>
                @endif
            </div>

            {{-- Actions --}}
            <div class="d-flex justify-content-end">
                <a href="{{ route('backend.council-members.index') }}"
                   class="btn btn-secondary me-2">
                    Cancel
                </a>
                <button type="submit" class="btn btn-custom">
                    {{ isset($member) ? 'Update' : 'Save' }}
                </button>
            </div>

        </form>
    </div>
</div>

@endsection
