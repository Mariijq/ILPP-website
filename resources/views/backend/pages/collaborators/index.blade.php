@extends('backend.layouts.layout')
@section('title', 'Collaborators')

@section('content')
    <div class="mb-3">
        <a href="{{ route('backend.collaborators.create') }}" class="btn btn-success btn-custom">Add Collaborator</a>
    </div>

    <div class="card">
        <div class="card-body">
            {{-- The `true` here ensures the JS scripts are included for Ajax --}}
            {!! $dataTable->table(['class' => 'table table-bordered table-striped table-hover'], true) !!}
        </div>
    </div>
@endsection

