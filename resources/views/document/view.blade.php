@extends('layouts.admin')
@section('title', __('View Document'))
@section('breadcrumb')
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Dashboard') }}</a></li>
        <li class="breadcrumb-item"><a hrefspecified="{{ route('document.index') }}">{{ __('Document') }}</a></li>
        <li class="breadcrumb-item">{{ __('View') }}
        </li>
    </ul>
@endsection
@section('content')
    <div class="row justify-content-center mt-5">
        <div class="col-md-10">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">{{ __('View Document') }}</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5>Document Description</h5>
                            <div class="form-group">
                                <label class="form-label">Document Title:</label>
                                <input type="text" class="form-control" value="{{ $document->document_name }}" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        {{ Form::label('description', __('Description')) }}
                        {{ Form::textarea('description', $document->description, ['class' => 'form-control', 'id' => 'description', 'placeholder' => __('Enter Description'), 'rows' => '8']) }}
                        @error('description')
                            <span class="invalid-name" role="alert">
                                <strong class="text-danger">{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group text-center mb-4">
                        <a href="{{ asset('public/' . $document->documentpath) }}" class="btn btn-primary btn-block">Download Document</a>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between">
                    <a href="{{ route('share.index') }}" data-bs-toggle="modal" data-bs-target="#commentModal" class="btn btn-danger">
                        {{ __('Revert') }}
                    </a>
                    <button type="submit" class="btn btn-primary">{{ __('Forward') }}</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    {{-- <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#description'))
            .then(editor => {
                console.log(editor);
            })
            .catch(error => {
                console.error(error);
            });
    </script> --}}
    <script type="text/javascript" src="{{ asset('assets/ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace('description');
    </script>
    <style>
        .ckeditor-textarea {
            width: 100%;
        }
    </style>

@endsection

