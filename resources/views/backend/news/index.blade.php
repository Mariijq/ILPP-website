@extends('backend.layout')
@section('title', 'News Management')
@section('content')
<div class="card">
    <div class="card-header">
        <h3>News List</h3>
        <a href="{{ route('news.create') }}" class="btn btn-success float-end">Add New News</a>
    </div>
    <div class="card-body">
        {!! $dataTable->table(['class' => 'table table-bordered table-striped table-hover'], false) !!}
    </div>
</div>
@endsection

