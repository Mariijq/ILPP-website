@extends('backend.layout')
@section('title', 'News Management')

@section('content')
    <div class="mb-3">
        <a href="{{ route('news.create') }}" class="btn btn-success btn-custom">Add News</a>
    </div>

    <div class="card">
        <div class="card-body">
            {!! $dataTable->table(['class' => 'table table-bordered table-striped table-hover'], false) !!}
        </div>
    </div>
@endsection
