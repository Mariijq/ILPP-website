@extends('backend.layouts.layout')
@section('title', 'Council Members Management')

@section('content')
<div class="mb-3">
        <a href="{{ route('backend.council-members.create') }}" class="btn btn-success btn-custom">Add Council Member</a>

</div>
<div class="card">
    <div class="card-body">
        {!! $dataTable->table(['class' => 'table table-bordered table-striped table-hover'], false) !!}
    </div>
</div>
@endsection

