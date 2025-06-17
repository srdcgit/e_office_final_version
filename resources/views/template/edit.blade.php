@extends('layouts.admin')
@section('title', __('Edit Template'))
@section('breadcrumb')
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Dashboard') }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('template.index') }}">{{ __('Template') }}</a></li>
        <li class="breadcrumb-item">{{ __('Edit') }}</li>
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
        <div class="section-body col-lg-12" style="padding-left:0">
            <div class="col-md-12 m-auto">
                <div class="card">
                    <div class="card-header">
                        <h5> {{ __('Edit Temaplte') }}</h5>
                    </div>
                    {{ Form::model($template, ['route' => ['template.update', $template->id], 'method' => 'PUT']) }}
                    <div class="card-body">
                        <div class="form-group">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    {{ Form::label('category', __('Category')), ['class' => 'form-label'] }}
                                    <select name="category_id" id="category" class="form-control">
                                        <option value="">Choose one</option>
                                        @foreach ($category as $categorys)
                                            <option
                                                value="{{ $categorys->id }}"@if ($template->category_id == $categorys->id) selected @endif>
                                                {{ $categorys->name }}</option>
                                        @endforeach

                                    </select>
                                    @error('Category')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    {{ Form::label('subcategory', __('Subcategory')), ['class' => 'form-label'] }}
                                    <select name="subcategory" id="language" class="form-control">
                                        <option value="">Select Subcategory</option>
                                        @foreach ($subcategory as $subcategorys)
                                            <option
                                                value="{{ $subcategorys->id }}"@if ($template->subcategory_id == $subcategorys->id) selected @endif>
                                                {{ $subcategorys->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('language')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    {{ Form::label('title', __('Title'), ['class' => 'form-label']) }}
                                    {{ Form::text('title', null, ['class' => 'form-control', 'placeholder' => __('Enter Title')]) }}
                                    @error('Title')
                                        <span class="invalid-name" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    {{ Form::label('description', __('Description'), ['class' => 'form-label']) }}
                                    {{ Form::textarea('description', null, ['class' => 'form-control ckeditor-textarea', 'id' => 'description', 'rows' => '8']) }}
                                    @error('description')
                                        <span class="invalid-name" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="float-end">
                            <a href="{{ route('template.index') }}" class="btn btn-secondary mb-3">{{ __('Cancel') }}</a>
                            <button type="submit" class="btn btn-primary mb-3">{{ __('Update') }}</button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mammoth/1.4.2/mammoth.browser.min.js"></script>
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
