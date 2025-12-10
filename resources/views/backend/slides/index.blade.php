@extends('backend.layout')
@section('title', 'Slider Management')

@section('content')
<div class="mb-3">
        <a href="{{ route('slides.create') }}" class="btn btn-success btn-custom">Add Slides</a>

</div>
<div class="card">
    <div class="card-body">
        {!! $dataTable->table(['class' => 'table table-bordered table-striped table-hover'], false) !!}
    </div>
</div>
@endsection

