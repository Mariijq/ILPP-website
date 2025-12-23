@extends('backend.layout')

@section('title', 'Slides')

@php $locale = app()->getLocale(); @endphp
@section('content')
    <h4 class="mb-4">{{ isset($slide->id) ? 'Edit Slide' : 'Add Slide' }}</h4>

    <form action="{{ route('slides.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Select News</label>
            <select name="news_id" class="form-control" required>
                <option value="">-- Select News --</option>
                @foreach ($news as $n)
                    <option value="{{ $n->id }}">{{ $n->title[$locale] ?? $n->title['en'] }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Order (optional)</label>
            <input type="number" name="order" class="form-control">
        </div>

        <button class="btn btn-custom">Save</button>
    </form>


@endsection
