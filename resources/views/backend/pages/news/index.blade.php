@extends('backend.layouts.layouts.layout')
@section('title', 'News Management')

@section('content')
    <div class="mb-3">
        <a href="{{ route('backend.news.create') }}" class="btn btn-success btn-custom">Add News</a>
    </div>

    <div class="card">
        <div class="card-body">
            {!! $dataTable->table(['class' => 'table table-bordered table-striped table-hover'], false) !!}
        </div>
    </div>
@endsection
