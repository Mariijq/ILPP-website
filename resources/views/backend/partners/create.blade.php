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

            @php
                $languages = ['en' => 'English', 'mk' => 'Macedonian', 'al' => 'Albanian'];
            @endphp

            {{-- NAME --}}
            <div class="mb-3">
                <label class="form-label">Name</label>
                <ul class="nav nav-tabs">
                    @foreach ($languages as $code => $label)
                        <li class="nav-item">
                            <button class="nav-link @if ($loop->first) active @endif" data-bs-toggle="tab"
                                data-bs-target="#name-{{ $code }}">
                                {{ $label }}
                            </button>
                        </li>
                    @endforeach
                </ul>

                <div class="tab-content mt-2">
                    @foreach ($languages as $code => $label)
                        <div class="tab-pane fade @if ($loop->first) show active @endif"
                            id="name-{{ $code }}">
                            <input type="text" name="name_{{ $code }}" class="form-control"
                                value="{{ old('name_' . $code, $partner->name[$code] ?? '') }}"
                                @if ($code === 'en') required @endif>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- TYPE --}}
            <div class="mb-3">
                <label for="type" class="form-label">Type</label>
                <select name="type" id="type" class="form-select" required>
                    <option value="Funding & Support"
                        {{ old('type', $partner->type ?? '') == 'Funding & Support' ? 'selected' : '' }}>
                        Funding & Support
                    </option>
                    <option value="Strategic Partners"
                        {{ old('type', $partner->type ?? '') == 'Strategic Partners' ? 'selected' : '' }}>
                        Strategic Partners
                    </option>
                </select>
            </div>

            {{-- LOGO --}}
            <div class="mb-3">
                <label for="logo" class="form-label">Logo / Image</label>
                <input type="file" name="logo" id="logo" class="form-control">
                @if (isset($partner) && $partner->logo)
                    <img src="{{ asset('storage/' . $partner->logo) }}" alt="Logo"
                        style="width:80px;height:80px;margin-top:10px;">
                @endif
            </div>

            {{-- WEBSITE --}}
            <div class="mb-3">
                <label for="website" class="form-label">Website (optional)</label>
                <input type="url" name="website" id="website" class="form-control"
                    value="{{ old('website', $partner->website ?? '') }}">
            </div>

            {{-- ORDER --}}
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
