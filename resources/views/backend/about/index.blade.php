@extends('backend.layout')
@section('title', 'About Us')

@section('content')
    <div class="container py-4">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('about.update') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="vision" class="form-label">Vision</label>
                <textarea name="vision" id="vision" class="form-control" rows="4">{{ old('vision', $about->vision ?? '') }}</textarea>
            </div>

            <div class="mb-3">
                <label for="mision" class="form-label">Mission</label>
                <textarea name="mision" id="mision" class="form-control" rows="4">{{ old('mision', $about->mision ?? '') }}</textarea>
            </div>

            <div class="mb-3">
                <label for="goals" class="form-label">Goals</label>
                <textarea name="goals" id="goals" class="form-control" rows="4">{{ old('goals', $about->goals ?? '') }}</textarea>
            </div>

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-custom">
                    Save </button>
            </div>
        </form>
    </div>
@endsection
