@extends('backend.layout')
@section('title', 'What We Do')

@section('content')
    <div class="what-we-do-form">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('what-we-do.update') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" id="title" class="form-control"
                    value="{{ old('title', $whatWeDo->title ?? '') }}">
            </div>

            <div class="mb-3">
                <label for="leadership" class="form-label">Leadership</label>
                <textarea name="leadership" id="leadership" class="form-control" rows="10">{{ old('leadership', $whatWeDo->leadership ?? '') }}</textarea>
            </div>

            <div class="mb-3">
                <label for="research" class="form-label">Research</label>
                <textarea name="research" id="research" class="form-control" rows="10">{{ old('research', $whatWeDo->research ?? '') }}</textarea>
            </div>

            <div class="mb-3">
                <label for="public_policy" class="form-label">Public Policy</label>
                <textarea name="public_policy" id="public_policy" class="form-control" rows="10">{{ old('public_policy', $whatWeDo->public_policy ?? '') }}</textarea>
            </div>

            <div class="d-flex justify-content-end">
                <a href="{{ route('what-we-do.index') }}" class="btn btn-secondary me-2">Cancel</a>
                <button type="submit" class="btn btn-custom">
                    Save </button>
            </div>
        </form>
    </div>


@endsection
