@extends('backend.layout')
@section('title', 'Testimonials Management')

@section('content')
<div class="mb-3">
    <a href="{{ route('testimonials.create') }}" class="btn btn-success btn-custom">Add Testimonial</a>
</div>

<div class="card">
    <div class="card-body">
        {!! $dataTable->table(['class' => 'table table-bordered table-striped table-hover'], false) !!}
    </div>
</div>
@endsection
