@extends('backend.layouts.layout')

@section('title', isset($slide) ? 'Edit Slide' : 'Add Slide')

@php $locale = app()->getLocale(); @endphp

@section('content')

<div class="container-fluid">
    <h4 class="mb-4">
        {{ isset($slide) ? 'Edit Slide' : 'Add Slide' }}
    </h4>

    {{-- Success message --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Validation errors --}}
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form
        action="{{ isset($slide)
            ? route('backend.slides.update', $slide->id)
            : route('backend.slides.store') }}"
        method="POST">

        @csrf
        @isset($slide)
            @method('PUT')
        @endisset

        {{-- Select News --}}
        <div class="mb-3">
            <label class="form-label">Select News</label>
            <select name="news_id" class="form-control" required>
                <option value="">-- Select News --</option>
                @foreach ($news as $n)
                    <option value="{{ $n->id }}"
                        {{ old('news_id', $slide->news_id ?? '') == $n->id ? 'selected' : '' }}>
                        {{ $n->title[$locale] ?? $n->title['en'] }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Order --}}
        <div class="mb-3">
            <label class="form-label">Order (optional)</label>
            <input type="number"
                   name="order"
                   class="form-control"
                   value="{{ old('order', $slide->order ?? '') }}">
        </div>

        {{-- Buttons --}}
        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-custom">
                {{ isset($slide) ? 'Update Slide' : 'Save Slide' }}
            </button>

            <a href="{{ route('backend.slides.index') }}" class="btn btn-secondary">
                Cancel
            </a>
        </div>

    </form>
</div>

@endsection
