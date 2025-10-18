@extends('backend.layout')
@section('title', 'History')

@section('content')
<div class="history-form">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('history.update') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="content" class="form-label">History Content</label>
            <textarea name="content" id="content" class="form-control" rows="10">{{ old('content', $history->content ?? '') }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Save</button>
    </form>
</div>
@endsection
