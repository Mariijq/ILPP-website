@extends('backend.layout')
@section('title', 'Documents Management')

@section('content')
    <div class="mb-3">
        <a href="{{ route('documents.create') }}" class="btn btn-c btn-custom">Add Documents</a>

    </div>
    <div class="card">
        <div class="card-body">
        {!! $dataTable->table(['class' => 'table table-bordered table-striped table-hover'], false) !!}
        </div>
    </div>
@endsection
