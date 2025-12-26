@extends('backend.layouts.layout')
@section('title', 'Team Members')

@section('content')
    <div class="mb-3">
        <a href="{{ route('backend.team-members.create') }}" class="btn btn-success btn-custom btn-custom">Add Team Member</a>
    </div>

    <div class="card">
        <div class="card-body">
        {!! $dataTable->table(['class' => 'table table-bordered table-striped table-hover'], false) !!}
        </div>
    </div>
@endsection

{{-- @section('scripts')
{!! $dataTable->scripts() !!}
@endsection --}}
