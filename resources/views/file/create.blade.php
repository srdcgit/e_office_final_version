@extends('layouts.admin')
@section('title', __('File '))
@section('breadcrumb')
<ul class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Dashboard') }}</a></li>
    <li class="breadcrumb-item">{{ __('File') }}
    </li>
</ul>
@endsection
<!-- [ breadcrumb ] end -->
<!-- [ Main Content ] start -->
 @section('content')
<div class="row">
    <div class="section-body">
        <div class="col-md-12 m-auto">
            <div class="card ">
                <div class="card-header">
                    <h5> {{ __('Create File') }}</h5>
                </div>
                {{ Form::open(['url' => 'file', 'method' => 'post', 'enctype' => 'multipart/form-data']) }}
                <div class="create-card-body h-29  p-3">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4 m-b-10">
                                {{ Form::label('name', __('File Name'), ['class' => 'form-label']) }}
                                {{ Form::text('file_name', null, ['class' => 'form-control', 'placeholder' => __('Enter File Name')]) }}
                                @error('file_name')
                                <span class="invalid-name" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-4 m-b-10">
                                {{ Form::label('file', __('File No'), ['class' => 'form-label']) }}
                                {{ Form::text('fileno', null, ['class' => 'form-control', 'placeholder' => __('Enter File Name')]) }}
                                @error('fileno')
                                <span class="invalid-name" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-4 m-b-10">
                                {{ Form::label('description', __('Description'), ['class' => 'form-label']) }}
                                {{ Form::text('description', null, ['class' => 'form-control', 'placeholder' => __('Enter Description')]) }}
                                @error('description')
                                <span class="invalid-name" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-4 m-b-10">
                                {{ Form::label('metatags', __('Metatags'), ['class' => 'form-label']) }}
                                {{ Form::text('metatags', null, ['class' => 'form-control', 'placeholder' => __('Enter MetaTags')]) }}
                                @error('metatags')
                                <span class="invalid-name" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-4 m-b-10">
                                {{ Form::label('category_id', __('Category')), ['class' => 'form-label'] }}
                                <select name="category_id" id="category" class="form-control">
                                    <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4 m-b-10">
                                {{ Form::label('subcategory_id', __('SubCategory')) , ['class' => 'form-label']}}
                                <select name="subcategory_id" id="subcategory" class="form-control">
                                    <option value="">Select SubCategory</option>
                                </select>
                                @error('subcategory')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4 m-b-10">
                                {{ Form::label('department_id', __('Department')), ['class' => 'form-label'] }}
                                <select name="department_id" id="department" class="form-control">
                                    <option value="">Select Department</option>
                                    @foreach($department as $departments)
                                    <option value="{{ $departments->id }}">{{ $departments->name }}</option>
                                    @endforeach
                                </select>
                                @error('department')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4 m-b-10">
                                {{ Form::label('section_id', __('Section')) , ['class' => 'form-label']}}
                                <select name="section_id" id="section" class="form-control">
                                    <option value="">Select Section</option>
                                </select>
                                @error('section')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer mt-4 vh-8">
                    <div class="float-end">
                        <a href="{{ route('file.index') }}" class="btn btn-secondary mb-3">{{ __('Cancel') }}</a>
                        <button type="submit" class="btn btn-primary mb-3">{{ __('Save') }}</button>
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
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script>
    // Include jQuery library in your HTML
    $(document).ready(function() {
        $('#category').change(function() {
            var categoryId = $(this).val();
            $.ajax({
                url: "{{url('get-subcategory')}}",
                type: 'GET',
                data: {
                    category_id: categoryId,
                },
                success: function(response) {
                    console.log(response);
                    var subcategories = response;
                    $('#subcategory').empty();
                    $.each(subcategories, function(index, subcategory) {
                        $('#subcategory').append('<option value="' + subcategory.id + '">' + subcategory.name + '</option>');
                    });
                },
                error: function(xhr, status, error) {

                }
            });
        });

        $('#department').change(function() {
            var departmentId = $(this).val();
            $.ajax({
                url: "{{url('get-section')}}",
                type: 'GET',
                data: {
                    department_id: departmentId,
                },
                success: function(response) {
                    console.log(response);
                    var sections = response;
                    $('#section').empty();
                    $.each(sections, function(index, section) {
                        $('#section').append('<option value="' + section.id + '">' + section.name + '</option>');
                    });
                },
                error: function(xhr, status, error) {

                }
            });
        });
    });
</script>
@endsection