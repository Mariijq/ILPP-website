@extends('backend.layouts.layout')
@section('title', 'Career Council Management')

@section('content')
<div class="mb-3">
        <a href="{{ route('backend.career-councils.create') }}" class="btn btn-success btn-custom">Add Career Council</a>

</div>
<div class="card">
    <div class="card-body">
        {!! $dataTable->table(['class' => 'table table-bordered table-striped table-hover'], false) !!}
    </div>
</div>
@endsection

