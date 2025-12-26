@extends('backend.layouts.layout')
@section('title', 'Partners')

@section('content')
    <div class="mb-3">
        <a href="{{ route('backend.partners.create') }}" class="btn btn-success btn-custom">Add Partner</a>
    </div>
    <div class="card">
        <div class="card-body">
            {!! $dataTable->table(['class' => 'table table-bordered table-striped table-hover'], false) !!}

        </div>
    </div>

@endsection
