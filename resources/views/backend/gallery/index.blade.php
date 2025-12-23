@extends('backend.layout')
@section('title', 'Gallery')
@section('content')

@php
    $languages = ['mk' => 'Macedonian', 'en' => 'English', 'al' => 'Albanian'];
@endphp

{{-- Upload New Images --}}
<div class="card mb-4">
    <div class="card-header">
        <h3>Upload Images</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('gallery.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Tabs for multilingual titles and descriptions --}}
            <ul class="nav nav-tabs" id="galleryTabs" role="tablist">
                @foreach ($languages as $code => $label)
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
                @foreach ($languages as $code => $label)
                    <div class="tab-pane fade @if($loop->first) show active @endif" id="tab-content-{{ $code }}" role="tabpanel">

                        {{-- Title --}}
                        <div class="mb-3">
                            <label class="form-label">Title ({{ $label }})</label>
                            <input type="text" name="title_{{ $code }}" class="form-control" value="{{ old('title_'.$code) }}">
                        </div>

                        {{-- Description --}}
                        <div class="mb-3">
                            <label class="form-label">Description ({{ $label }})</label>
                            <textarea name="description_{{ $code }}" class="form-control" rows="3">{{ old('description_'.$code) }}</textarea>
                        </div>

                    </div>
                @endforeach
            </div>

            {{-- Image Upload --}}
            <div class="mb-3 mt-3">
                <label for="images" class="form-label">Upload Image(s)</label>
                <input type="file" name="images[]" id="images" class="form-control" multiple required>
            </div>

            {{-- Form Actions --}}
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-custom">Save</button>
            </div>
        </form>
    </div>
</div>

{{-- Existing Images --}}
<div class="card mt-4">
    <div class="card-header">
        <h3>Gallery Images</h3>
    </div>
    <div class="card-body">
        <div class="row g-3">
            @foreach ($images as $image)
                <div class="col-6 col-md-3">
                    <div class="card">
                        <img src="{{ asset('storage/' . $image->image_path) }}" 
                             class="card-img-top" alt="{{ $image->title['en'] ?? 'Gallery Image' }}">
                        <div class="card-body text-center">

                            {{-- Edit multilingual titles/descriptions --}}
                            <ul class="nav nav-tabs" id="editGalleryTabs-{{ $image->id }}" role="tablist">
                                @foreach ($languages as $code => $label)
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link @if($loop->first) active @endif" 
                                                id="edit-tab-{{ $code }}-{{ $image->id }}" 
                                                data-bs-toggle="tab" 
                                                data-bs-target="#edit-tab-content-{{ $code }}-{{ $image->id }}" 
                                                type="button" role="tab">
                                            {{ $label }}
                                        </button>
                                    </li>
                                @endforeach
                            </ul>

                            <div class="tab-content mt-2">
                                <form action="{{ route('gallery.update', $image->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    @foreach ($languages as $code => $label)
                                        <div class="tab-pane fade @if($loop->first) show active @endif" 
                                             id="edit-tab-content-{{ $code }}-{{ $image->id }}" role="tabpanel">
                                            <input type="text" name="title_{{ $code }}" class="form-control mb-2" 
                                                   value="{{ $image->title[$code] ?? '' }}" placeholder="Title ({{ $label }})">
                                            <textarea name="description_{{ $code }}" class="form-control mb-2" rows="2" 
                                                      placeholder="Description ({{ $label }})">{{ $image->description[$code] ?? '' }}</textarea>
                                        </div>
                                    @endforeach
                                    <button type="submit" class="btn btn-custom btn-sm mt-2">Save</button>
                                </form>
                            </div>

                            {{-- Delete --}}
                            <form action="{{ route('gallery.destroy', $image->id) }}" method="POST" 
                                  onsubmit="return confirm('Are you sure?');" class="mt-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="bi bi-trash"></i> Delete
                                </button>
                            </form>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @if ($images->isEmpty())
            <p class="text-muted mt-3">No images uploaded yet.</p>
        @endif
    </div>
</div>

@endsection
