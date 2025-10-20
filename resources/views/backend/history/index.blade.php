@extends('backend.layout')
@section('title', 'History')

@section('content')
    <div class="history-form">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('history.update') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="title" class="form-label">History Title</label>
                <input type="text" name="title" id="title" class="form-control"
                    value="{{ old('title', $history->title ?? '') }}">
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">History Description</label>
                <textarea name="description" id="description" class="form-control" rows="10">{{ old('description', $history->description ?? '') }}</textarea>
            </div>

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-custom">
                    Save </button>
            </div>
        </form>
    </div>
@endsection
