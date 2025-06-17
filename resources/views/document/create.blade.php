@extends('layouts.admin')
@section('title', __('Create Document '))
@section('breadcrumb')
<ul class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Dashboard') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('document.index') }}">{{ __('Document') }}</a></li>
    <li class="breadcrumb-item">{{ __('Create') }}
    </li>
</ul>
@endsection
@section('content')
<div class="row">
    <div class="section-body">
        <div class="col-md-10 m-auto">
            <div class="card">
                <div class="card-header">
                    <h5> {{ __('Create Document') }}</h5>
                </div>
                <div class="card-body">
                    {{ Form::open(['url' => 'document', 'method' => 'post', 'enctype' => 'multipart/form-data']) }}
                    <div class="form-group">
                        {{ Form::label('file_id', __('Document Type')) }}
                        <select name="dtype" id="dtype" class="form-control">
                            <option value="">Select DocumentType</option>
                            <option value="create">Create</option>
                            <option value="upload">Upload</option>
                        </select>
                        @error('dtype')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div id="create-options" style="display:none;">
                        <div class="form-group">
                            {{ Form::label('name', __('Document Title'), ['class' => 'form-label']) }}
                            {{ Form::text('title', null, ['class' => 'form-control', 'id' => 'title', 'placeholder' => __('Enter Document')]) }}
                            @error('title')
                            <span class="invalid-name" role="alert">
                                <strong class="text-danger">{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            {{ Form::label('name', __('Meta Title'), ['class' => 'form-label']) }}
                            {{ Form::text('metatitle', null, ['class' => 'form-control', 'id' => 'metatitle', 'placeholder' => __('Enter Meta Title')]) }}
                            @error('metatitle')
                            <span class="invalid-name" role="alert">
                                <strong class="text-danger">{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            {{ Form::label('description', __('Description')) }}
                            {{ Form::textarea('description', null, ['class' => 'form-control ckeditor-textarea', 'id' => 'description', 'rows' => '8']) }}
                            @error('description')
                            <span class="invalid-name" role="alert">
                                <strong class="text-danger">{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div id="upload-options" style="display:none;">
                        <div class="form-group">
                            {{ Form::label('documentpath', __('Document'), ['class' => 'form-label']) }}
                            {{ Form::file('documentpath', null, ['class' => 'form-control', 'placeholder' => __('Enter Document Name')]) }}
                            @error('documentpath')
                            <span class="invalid-name" role="alert">
                                <strong class="text-danger">{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            {{ Form::label('uploaddocument_name', __('Upload Title'), ['class' => 'form-label']) }}
                            {{ Form::text('uploaddocument_name', null, ['class' => 'form-control', 'id' => 'title', 'placeholder' => __('Enter Title')]) }}
                            @error('uploaddocument_name')
                            <span class="invalid-name" role="alert">
                                <strong class="text-danger">{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            {{ Form::label('uploadmetatitle', __('Meta Title'), ['class' => 'form-label']) }}
                            {{ Form::text('uploadmetatitle', null, ['class' => 'form-control', 'id' => 'metatitle', 'placeholder' => __('Enter Meta Title')]) }}
                            @error('metatitle')
                            <span class="invalid-name" role="alert">
                                <strong class="text-danger">{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="float-end">
                            <a href="{{ route('document.index') }}"
                                class="btn btn-secondary mb-3">{{ __('Cancel') }}</a>
                            <button type="submit" class="btn btn-primary mb-3">{{ __('Save') }}</button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
<!-- [ sample-page ] end -->
<!-- [ Main Content ] end -->
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>
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

<script>
    $(document).ready(function() {
        $('#dtype').change(function() {
            var doctype = this.value;
            if (doctype === 'create') {
                $('#create-options').show();
                $('#upload-options').hide();
            } else if (doctype === 'upload') {
                $('#create-options').hide();
                $('#upload-options').show();
            } else {
                $('#create-options').hide();
                $('#upload-options').hide();
            }
        });
    });
</script>
@endsection