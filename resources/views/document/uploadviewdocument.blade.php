@extends('layouts.admin')
@section('title', __('Upload Document'))
@section('breadcrumb')
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Dashboard') }}</a></li>
        <li class="breadcrumb-item"><a hrefspecified="{{ route('document.index') }}">{{ __('Document') }}</a></li>
        <li class="breadcrumb-item">{{ __('Upload ') }}
        </li>
    </ul>
@endsection
@section('content')
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white d-flex align-items-center">
                    <h5 class="mb-0 flex-grow-1">{{ __('Upload Document') }}</h5>
                    <i class="fas fa-upload ml-auto"></i>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <h5>Document Description</h5>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Upload Title:</label>
                                <input type="text" class="form-control" value="{{ $document->document_name }}" disabled>
                            </div>
                        </div>
                        <div class="col-md-6 ">
                            <div class="form-group">
                                <label class="form-label">Meta Title:</label>
                                <input type="text" class="form-control" value="{{ $document->uploadmetatitle }}"
                                    disabled>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-12">
                            <div class="form-group text-center">
                                <a href="{{ asset('public/' . $document->documentpath) }}"
                                    class="btn btn-primary btn-block">
                                    <i class="fas fa-download"></i> Download Document
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between">
                    <a href="{{ route('share.index') }}" data-bs-toggle="modal" data-bs-target="#commentModal"
                        class="btn btn-danger">
                        <i class="fas fa-undo-alt"></i> {{ __('Revert') }}
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-forward"></i> {{ __('Forward') }}
                    </button>
                </div>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>


@endsection
