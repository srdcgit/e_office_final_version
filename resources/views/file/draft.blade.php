@extends('layouts.admin')
@section('title', __('Draft'))
@section('breadcrumb')
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Dashboard') }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('receipt.index') }}">{{ __('Draft') }}</a></li>
        <li class="breadcrumb-item">{{ __('Draft') }}
        </li>
    </ul>
    <style>
        #pdf-viewer,
        #doc-viewer {
            width: 100%;
            height: 500px;
            border: 1px solid #ccc;
            margin-top: 10px;
        }
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="section-body col-lg-6" style="padding-right:0">
            <div class="col-md-12 m-auto">
                <div class="card">
                    <div class="card-header">
                        <h5>{{ __('Create Draft') }}</h5>
                    </div>
                    {{ Form::open(['url' => 'receipt', 'method' => 'post', 'files' => true]) }}
                    <div class="card-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6 m-b-20">
                                    {{ Form::label('receipt_file', __('UPLOAD'), ['class' => 'form-label']) }}
                                    {{ Form::file('receipt_file', ['class' => 'form-control', 'id' => 'fileUpload']) }}
                                    @error('receipt_file')
                                        <span class="invalid-name" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    {{ Form::label('description', __('Description')) }}
                                    {{ Form::textarea('description', null, ['class' => 'form-control', 'id' => 'description', 'placeholder' => __('Enter Description'), 'rows' => '12']) }}
                                    @error('description')
                                        <span class="invalid-name" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="float-end">
                                <button type="submit" class="btn btn-primary mb-3">{{ __('Save') }}</button>
                                <button type="submit" class="btn btn-primary mb-3">{{ __('Clear') }}</button>

                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
        <div class="section-body col-lg-6" style="padding-right:0">
            <div class="col-md-12 m-auto">
                <div class="card">
                    <div class="card-header">
                        <h5>{{ __('Draft Details') }}</h5>
                    </div>
                    {{ Form::open(['url' => 'receipt', 'method' => 'post', 'files' => true]) }}
                    <div class="card-body">
                        <div class="form-group">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    {{ Form::label('action', __('Draft Nature'), ['class' => 'form-label']) }}
                                    <select name="role" id="role" class="form-control">
                                        <option value="">Select one</option>
                                        <option value="">Low</option>
                                        <option value="">Highi</option>
                                        <option value="">Medium</option>

                                    </select>
                                </div>
                                <div class="col-md-6">
                                    {{ Form::label('action', __('Receipt No'), ['class' => 'form-label']) }}
                                    <select name="role" id="role" class="form-control">
                                        <option value="">Select one</option>
                                        <option value="">Low</option>
                                        <option value="">Highi</option>
                                        <option value="">Medium</option>

                                    </select>
                                </div>
                                <div class="col-md-6">
                                    {{ Form::label('action', __('Reply Type'), ['class' => 'form-label']) }}
                                    <select name="role" id="role" class="form-control">
                                        <option value="">Select one</option>
                                        <option value="">Low</option>
                                        <option value="">Highi</option>
                                        <option value="">Medium</option>

                                    </select>
                                </div>
                                <div class="col-md-6">
                                    {{ Form::label('action', __('Form of Communication'), ['class' => 'form-label']) }}
                                    <select name="role" id="role" class="form-control">
                                        <option value="">Select one</option>
                                        <option value="">Low</option>
                                        <option value="">Highi</option>
                                        <option value="">Medium</option>

                                    </select>
                                </div>
                                <div class="col-md-6">
                                    {{ Form::label('role_id', __('Prefix')), ['class' => 'form-label'] }}
                                    <select name="role" id="role" class="form-control">
                                        <option value="">Select one</option>
                                        <option value="">Low</option>
                                        <option value="">Highi</option>
                                        <option value="">Medium</option>

                                    </select>
                                    @error('letter_ref_no')
                                        <span class="invalid-name" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    {{ Form::label('action', __('Main Category'), ['class' => 'form-label']) }}
                                    <select name="role" id="role" class="form-control">
                                        <option value="">Select one</option>
                                        <option value="">Low</option>
                                        <option value="">Highi</option>
                                        <option value="">Medium</option>

                                    </select>
                                </div>
                                <div class="col-md-6">
                                    {{ Form::label('action', __('Main Subcategory'), ['class' => 'form-label']) }}
                                    <select name="role" id="role" class="form-control">
                                        <option value="">Select one</option>
                                        <option value="">Low</option>
                                        <option value="">Highi</option>
                                        <option value="">Medium</option>

                                    </select>
                                </div>
                                <div class="col-md-6">
                                    {{ Form::label('action', __('Language'), ['class' => 'form-label']) }}
                                    <select name="role" id="role" class="form-control">
                                        <option value="">Select one</option>
                                        <option value="">Low</option>
                                        <option value="">Highi</option>
                                        <option value="">Medium</option>

                                    </select>
                                </div>
                                <div class="col-md-12">
                                    {{ Form::label('text', __('Subject'), ['class' => 'form-label']) }}
                                    {{ Form::text('text', null, ['class' => 'form-control', 'placeholder' => __('Subject')]) }}
                                    @error('text')
                                        <span class="invalid-name" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="float-end">
                                <button type="submit" class="btn btn-primary mb-3">{{ __('Add') }}</button>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mammoth/1.4.2/mammoth.browser.min.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#description'))
            .then(editor => {
                console.log(editor);
            })
            .catch(error => {
                console.error(error);
            });
    </script>

@endsection
