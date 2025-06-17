@extends('layouts.fileLayout')
@section('file_title', 'File Inbox')
@section('file_content')
<div class="row">
    <div class="section-body">
        <div class="col-md-10 m-auto">
            <div class="card">
                <div class="card-header">
                    <h5>{{ __('Edit Document') }}</h5>
                </div>
                {{ Form::model($document, ['route' => ['document.update', $document->id], 'method' => 'PUT', 'class' => 'form-horizontal']) }}
                <div class="card-body">
                    <div class="form-group">
                        {{ Form::label('dtype', __('Document Type'), ['class' => 'form-label']) }}
                        <select name="dtype" id="dtype" class="form-control">
                            <option value="">Select Document Type</option>
                            <option value="create" @if ($document->dtype == 'create') selected @endif>Create</option>
                            <option value="upload" @if ($document->dtype == 'upload') selected @endif>Upload</option>
                        </select>
                        @error('dtype')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div id="create-options" style="display:none;">
                        <div class="form-group">
                            {{ Form::label('name', __('Document Title'), ['class' => 'form-label']) }}
                            {{ Form::text('document_name', null, ['class' => 'form-control', 'id' => 'title', 'placeholder' => __('Enter Document')]) }}
                            @error('name')
                            <span class="invalid-name" role="alert">
                                <strong class="text-danger">{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            {{ Form::label('meta_title', __('Meta Title'), ['class' => 'form-label']) }}
                            {{ Form::text('meta_title', null, ['class' => 'form-control', 'id' => 'metatitle', 'placeholder' => __('Enter Meta Title')]) }}
                            @error('name')
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
                    <div id="upload-options" @if ($document->dtype != 'upload') style="display: none;" @endif>
                        <div class="form-group">
                            {{ Form::label('documentpath', __('Document'), ['class' => 'form-label']) }}
                            {{ Form::file('documentpath', null, ['class' => 'form-control']) }}
                            @error('documentpath')
                            <span class="invalid-documentpath" role="alert">
                                <strong class="text-danger">{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="float-end">
                        <a href="{{ route('document.index') }}" class="btn btn-success mb-3">{{ __('Cancel') }}</a>
                        <button type="submit" class="btn btn-primary mb-3">{{ __('Update') }}</button>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>
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
            var dtype = $(this).val();
            if (dtype == 'create') {
                $('#create-options').show();
                $('#upload-options').hide();
            } else if (dtype == 'upload') {
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