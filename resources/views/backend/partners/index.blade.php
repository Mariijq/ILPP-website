@extends('backend.layout')
@section('title', 'Partners')

@section('content')
    <div class="mb-3">
        <a href="{{ route('partners.create') }}" class="btn btn-success btn-custom">Add Partner</a>
    </div>
    <div class="card">
        <div class="card-body">
            {!! $dataTable->table(['class' => 'table table-striped table-bordered'], true) !!}

        </div>
    </div>

    @push('scripts')
        {!! $dataTable->scripts() !!}
    @endpush
@endsection
