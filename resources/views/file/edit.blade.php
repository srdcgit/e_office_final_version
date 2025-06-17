@extends('layouts.admin')
@section('title', __('Edit File '))
@section('breadcrumb')
<ul class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Dashboard') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('file.index') }}">{{ __('File') }}</a></li>
    <li class="breadcrumb-item">{{ __('Edit') }}
    </li>
</ul>
@endsection

@section('content')

<!-- [ breadcrumb ] end -->
<!-- [ Main Content ] start -->
<div class="row">
    <div class="section-body">
        <div class="col-md-12 m-auto">
            <div class="card ">
                <div class="card-header">
                    <h5> {{ __('Edit File') }}</h5>
                </div>
                {{ Form::model($file, ['route' => ['file.update', $file->id], 'method' => 'PUT']) }}

                <div class="card-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4 m-b-10">
                                {{ Form::label('file_name', __('File Name'), ['class' => 'form-label']) }}
                                {{ Form::text('file_name', null, ['class' => 'form-control', 'placeholder' => __('Enter File Name')]) }}
                                @error('name')
                                <span class="invalid-name" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-4 m-b-10">
                                {{ Form::label('fileno', __('File No'), ['class' => 'form-label']) }}
                                {{ Form::tel('fileno', null, ['class' => 'form-control', 'placeholder' => __('Enter File No')]) }}
                                @error('name')
                                <span class="invalid-name" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-4 m-b-10">
                                {{ Form::label('description', __('Description'),['class' => 'form-label']) }}
                                {{ Form::text('description', null, ['class' => 'form-control', 'placeholder' => __('Enter Description')]) }}
                                @error('description')
                                <span class="invalid-name" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-4 m-b-10">
                                {{ Form::label('metatags', __('Metatags'),['class' => 'form-label']) }}
                                {{ Form::text('metatags', null, ['class' => 'form-control', 'placeholder' => __('Enter MetaTags')]) }}
                                @error('description')
                                <span class="invalid-name" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-4 m-b-10">
                                {{ Form::label('category_id', __('Category'),['class' => 'form-label']) }}
                                <select name="category_id" id="category_id" class="form-control">
                                    <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}" @if($file->category_id == $category->id) selected @endif>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4 m-b-10">
                                {{ Form::label('subcategory_id', __('SubCategory'),['class' => 'form-label']) }}
                                <select name="subcategory_id" id="subcategory_id" class="form-control">
                                    <option value="">Select Category</option>
                                    @foreach($subcategory as $subcategoryy)
                                    <option value="{{ $subcategoryy->id }}" @if($file->subcategory_id == $subcategoryy->id) selected @endif>{{ $subcategoryy->name }}</option>
                                    @endforeach
                                </select>
                                @error('subcategory_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4 m-b-10">
                                {{ Form::label('department_id', __('Department'),['class' => 'form-label']) }}
                                <select name="department_id" id="department_id" class="form-control">
                                    <option value="">Select Department</option>
                                    @foreach($department as $departments)
                                    <option value="{{ $departments->id }}" @if($file->department_id == $departments->id) selected @endif>{{ $departments->name }}</option>
                                    @endforeach
                                </select>
                                @error('department_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4 m-b-10">
                                {{ Form::label('section_id', __('Section'),['class' => 'form-label']) }}
                                <select name="section_id" id="section_id" class="form-control">
                                    <option value="">Select Section</option>
                                    @foreach($section as $sections)
                                    <option value="{{ $sections->id }}" @if($file->section_id == $sections->id) selected @endif>{{ $sections->name }}</option>
                                    @endforeach
                                </select>
                                @error('section_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>

                        <!-- <div class="col-md-4 m-b-10">
                            {{ Form::label('file', __('Document Upload'), ['class' => 'form-label']) }}
                            {{ Form::file('file', null, ['class' => 'form-control', 'placeholder' => __('Enter Department Name')]) }}
                            @error('name')
                            <span class="invalid-name" role="alert">
                                <strong class="text-danger">{{ $message }}</strong>
                            </span>
                            @enderror
                        </div> -->
                    </div>

                </div>
            </div>
            <div class="card-footer">
                <div class="float-end">
                    <a href="{{ route('file.index') }}" class="btn btn-secondary mb-3">{{ __('Cancel') }}</a>
                    <button type="submit" class="btn btn-primary mb-3">{{ __('Update') }}</button>
                </div>
            </div>
            {!! Form::close() !!}

        </div>
    </div>
</div>
</div>

<!-- [ sample-page ] end -->
</div>
<!-- [ Main Content ] end -->
</div>
</div>
@endsection
