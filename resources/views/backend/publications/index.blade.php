@extends('backend.layout')
@section('title', 'Publications Management')
@section('content')
    <div class="mb-3">
        <a href="{{ route('publications.create') }}" class="btn btn-success btn-custom">Add Publication</a>
    </div>

    <div class="card">
        <div>
            <div class="card-body">
                {!! $dataTable->table(['class' => 'table table-bordered table-striped table-hover'], false) !!}
            </div>
        </div>

    </div>
@endsection
