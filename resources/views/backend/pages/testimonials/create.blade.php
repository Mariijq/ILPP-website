@extends('backend.layouts.layout')

@section('title', isset($testimonial) ? 'Edit Testimonial' : 'Add Testimonial')

@section('content')
@php
    $languages = ['en' => 'English', 'mk' => 'Macedonian', 'al' => 'Albanian'];
@endphp

<div class="card mb-4">
    <div class="card-header">
        <h3>{{ isset($testimonial) ? 'Edit Testimonial' : 'Add Testimonial' }}</h3>
    </div>
    <div class="card-body">
        <form action="{{ isset($testimonial) ? route('backend.testimonials.update', $testimonial->id) : route('backend.testimonials.store') }}"
              method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($testimonial))
                @method('PUT')
            @endif

            {{-- Multilingual tabs --}}
            <ul class="nav nav-tabs" id="testimonialTabs" role="tablist">
                @foreach($languages as $code => $label)
                    <li class="nav-item" role="presentation">
                        <button class="nav-link @if($loop->first) active @endif" 
                                id="tab-{{ $code }}" data-bs-toggle="tab" 
                                data-bs-target="#tab-content-{{ $code }}" type="button" role="tab">
                            {{ $label }}
                        </button>
                    </li>
                @endforeach
            </ul>

            <div class="tab-content mt-3">
                @foreach($languages as $code => $label)
                    <div class="tab-pane fade @if($loop->first) show active @endif" id="tab-content-{{ $code }}" role="tabpanel">
                        {{-- Name --}}
                        <div class="mb-3">
                            <label class="form-label">Name ({{ $label }})</label>
                            <input type="text" name="name_{{ $code }}" class="form-control"
                                   value="{{ old('name_'.$code, $testimonial->name[$code] ?? '') }}"
                                   @if($code === 'en') required @endif>
                        </div>

                        {{-- Designation --}}
                        <div class="mb-3">
                            <label class="form-label">Designation ({{ $label }})</label>
                            <input type="text" name="designation_{{ $code }}" class="form-control"
                                   value="{{ old('designation_'.$code, $testimonial->designation[$code] ?? '') }}">
                        </div>

                        {{-- Review --}}
                        <div class="mb-3">
                            <label class="form-label">Review ({{ $label }})</label>
                            <textarea name="review_{{ $code }}" class="form-control" rows="3">{{ old('review_'.$code, $testimonial->review[$code] ?? '') }}</textarea>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Image --}}
            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" name="image" id="image" class="form-control">
                @if(isset($testimonial) && $testimonial->image)
                    <img src="{{ asset('storage/' . $testimonial->image) }}" alt="Testimonial Image"
                         style="width:80px;height:80px;margin-top:10px;object-fit:cover;border-radius:50%;">
                @endif
            </div>

            <div class="d-flex justify-content-end">
                <a href="{{ route('backend.testimonials.index') }}" class="btn btn-secondary me-2">Cancel</a>
                <button type="submit" class="btn btn-custom">{{ isset($testimonial) ? 'Update' : 'Save' }}</button>
            </div>
        </form>
    </div>
</div>
@endsection
