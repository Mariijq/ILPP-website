@extends('backend.layout')

@section('content')
    <h4 class="mb-4">{{ isset($document) ? 'Edit Document' : 'Add Document' }}</h4>

    <div class="document-form">

        <form action="{{ isset($document) ? route('documents.update', $document->id) : route('documents.store') }}"
            method="POST" enctype="multipart/form-data">
            @csrf
            @if (isset($document))
                @method('PUT')
            @endif
            @php
                $languages = ['en' => 'English', 'mk' => 'Macedonian', 'al' => 'Albanian'];
            @endphp

            <ul class="nav nav-tabs mb-3">
                @foreach ($languages as $code => $lang)
                    <li class="nav-item">
                        <button class="nav-link {{ $loop->first ? 'active' : '' }}" data-bs-toggle="tab"
                            data-bs-target="#lang-{{ $code }}">
                            {{ $lang }}
                        </button>
                    </li>
                @endforeach
            </ul>

            <div class="tab-content">
                @foreach ($languages as $code => $lang)
                    <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="lang-{{ $code }}">

                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input type="text" name="title_{{ $code }}" class="form-control"
                                value="{{ old("title_$code", $document->title[$code] ?? '') }}" >
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description_{{ $code }}" class="form-control ckeditor" rows="4">{{ old("description_$code", $document->description[$code] ?? '') }}</textarea>
                        </div>

                    </div>
                @endforeach
            </div>


            <div class="mb-3">
                <label for="file_path" class="form-label">Upload File</label>
                <input type="file" name="file_path" id="file_path" class="form-control">

                @if (isset($document) && $document->file_path)
                    <div class="mt-2">
                        <small class="text-muted">
                            Current file:
                            <a href="{{ asset('storage/' . $document->file_path) }}" target="_blank"
                                class="btn btn-outline-primary btn-sm">
                                View File
                            </a>
                        </small>
                    </div>
                @endif
            </div>

            <div class="d-flex justify-content-end">
                <a href="{{ route('documents.index') }}" class="btn btn-secondary me-2">Cancel</a>
                <button type="submit" class="btn btn-custom">
                    {{ isset($document) ? 'Update' : 'Save' }}
                </button>
            </div>
        </form>
    </div>
@endsection
