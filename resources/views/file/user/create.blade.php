@extends('layouts.fileLayout')
@section('file_title', 'File Inbox')
@section('file_content')
<?php

use App\Models\File;
?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

<!-- [ breadcrumb ] end -->
<!-- [ Main Content ] start -->
<div class="container-fluid" style="justify-items: center; width: 50%;">
    <div class="row">
        <div class="section-body">
            {{ Form::open(['url' => 'file', 'method' => 'post', 'enctype' => 'multipart/form-data', 'id' => 'fileCreateForm']) }}
            <div class="col-md-12 m-auto file-container">
                <div class="card file-card-header-container">
                    <div class="card-header file-card-header">
                        <div class="file-nature">
                            <p style="color: black;margin-top: 2px; margin-right: 4px;font-size:11px;">Nature:</p>
                            <input type="radio" checked id="electronics" name="nature" value="{{File::FILE_TYPE_ELECTRONIC}}"
                                style="font-size:11px;">
                            <label for="electronics" style="margin-left:2px; font-size:11px;">Electronics</label>
                            <input type="radio" value="{{File::FILE_TYPE_PHYSICAL}}" id="physical" name="nature"
                                style="font-size:11px;">
                            <label for="physical" style="margin-left:2px; font-size:11px;">Physical</label>


                            <div class="type-contents">
                                <p style="color: black;margin-top: 2px; margin-right: 4px;font-size:11px;">Type:</p>
                                <input type="radio" checked id="non-sfs" name="type" value="nonsfs"
                                    style="font-size:11px;">
                                <label for="non-sfs" style="font-size:11px;">NON SFS</label>
                                <input type="radio" id="sfs" name="type" value="sfs"
                                    style="font-size:11px;">
                                <label for="sfs" style="font-size:11px;">SFS</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card file-card" style="background-color: #945880; justify-content: center;">
                <div class="card-header-content" style="display: flex;flex-direction: column;text-align: center;">
                    <h6>Bharat Sarkar</h6>
                    <h6>Government Of India</h6>
                    <h6>Ministry</h6>
                    <h6>DFS</h6>
                    <h6>BO 1 SECTION - DFS</h6>
                </div>
                <div style="font-size: 12px; margin-left: 8px; display: flex; justify-content: space-between; align-items: center;">
                    <p style="margin: 0;"><b>Nature</b>-Electronic</p>
                    <p style="margin: 0;"><b>Type</b>-NON SFS</p>
                </div>


                <div class="file-form" style="font-size:18px">

                    <div class="create-card-body h-29  p-1" style="padding: 0.25rem !important;">
                        <div class="form-group">
                            <div class="row">
                                {{-- File No starts here --}}
                                <div class="row justify-content-center" style="margin-top: 25px; width: 100% !important;">
                                    <div class="" style="margin-left: 25px !important;">
                                        <div style="position: relative; background: #f3d6e3; border-radius: 10px; border: 1px solid #e0b7c8; padding: 30px 20px 20px 20px; margin-bottom: 20px;">
                                            <!-- File No label overlapping the card -->
                                            <div style="position: absolute; left: 50%; top: 0; transform: translate(-50%, -50%);">
                                                <span style="background: #fff; border: 1px solid #e0b7c8; border-radius: 6px; padding: 4px 30px; font-weight: bold; font-size: 18px; color: #945880;">File No</span>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4 m-b-10" style="font-size:18px">
                                                    {{ Form::label('file', __('File No'), ['class' => 'form-label']) }}
                                                    {{ Form::text('fileno', null, ['class' => 'form-control', 'placeholder' => __('Enter File Name')]) }}
                                                    @error('fileno')
                                                    <span class="invalid-name" role="alert">
                                                        <strong class="text-danger">{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4 m-b-10" style="font-size:18px">
                                                    {{ Form::label('name', __('File Name'), ['class' => 'form-label']) }}
                                                    {{ Form::text('file_name', null, ['class' => 'form-control', 'placeholder' => __('Enter File Name')]) }}
                                                    @error('file_name')
                                                    <span class="invalid-name" role="alert">
                                                        <strong class="text-danger">{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4 m-b-10" style="font-size:18px">
                                                    {{ Form::label('metatags', __('Metatags'), ['class' => 'form-label']) }}
                                                    {{ Form::text('metatags', null, ['class' => 'form-control', 'placeholder' => __('Enter MetaTags')]) }}
                                                    @error('metatags')
                                                    <span class="invalid-name" role="alert">
                                                        <strong class="text-danger">{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- File No ends here --}}
                                
                                {{-- subject  --}}
                                <div class="row justify-content-center" style="margin-top: 25px; width: 100% !important;">
                                    <div class="" style="margin-left: 25px !important;">
                                        <div style="position: relative; background: #f3d6e3; border-radius: 10px; border: 1px solid #e0b7c8; padding: 30px 20px 20px 20px; margin-bottom: 20px;">
                                            <!-- Subject label overlapping the card -->
                                            <div style="position: absolute; left: 50%; top: 0; transform: translate(-50%, -50%);">
                                                <span style="background: #fff; border: 1px solid #e0b7c8; border-radius: 6px; padding: 4px 30px; font-weight: bold; font-size: 18px; color: #945880;">Subject</span>
                                            </div>
                                            <!-- Description textarea -->
                                            <div class="form-group mb-3">
                                                {{ Form::label('description', __('Description *'), ['class' => 'form-label', 'style' => 'font-size:14px; color:#945880;']) }}
                                                {{ Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => __('Description'), 'rows' => 3, 'style' => 'font-size:14px;']) }}
                                                @error('description')
                                                <span class="invalid-name" role="alert">
                                                    <strong class="text-danger">{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <!-- Main Category and Sub Category side by side -->
                                            <div class="row">
                                                <div class="col-md-6 mb-2">
                                                    {{ Form::label('category_id', __('Main Category'), ['class' => 'form-label', 'style' => 'color:#945880;']) }}
                                                    <select name="category_id" id="categories" class="form-control">
                                                        <option value="">Choose One</option>
                                                        @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('category')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6 mb-2">
                                                    {{ Form::label('subcategory_id', __('Sub Category'), ['class' => 'form-label', 'style' => 'color:#945880;']) }}
                                                    <select name="subcategory_id" id="subcategory" class="form-control">
                                                        <option value="">Choose One</option>
                                                    </select>
                                                    @error('subcategory')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- Subject ends here  --}}

                                {{-- Other Details starts here --}}
                                <div class="row justify-content-center" style="margin-top: 25px; width: 100% !important;">
                                    <div class="" style="margin-left: 25px !important;">
                                        <div style="position: relative; background: #f3d6e3; border-radius: 10px; border: 1px solid #e0b7c8; padding: 30px 20px 20px 20px; margin-bottom: 20px;">
                                            <!-- Other Details label overlapping the card -->
                                            <div style="position: absolute; left: 50%; top: 0; transform: translate(-50%, -50%);">
                                                <span style="background: #fff; border: 1px solid #e0b7c8; border-radius: 6px; padding: 4px 30px; font-weight: bold; font-size: 18px; color: #945880;">Other Details</span>
                                            </div>
                                            <div class="form-group mb-3" style="font-size:18px">
                                                {{ Form::label('remarks', __('Remarks'), ['class' => 'form-label']) }}
                                                {{ Form::text('remarks', null, ['class' => 'form-control', 'placeholder' => __('Enter Remarks')]) }}
                                                @error('description')
                                                <span class="invalid-name" role="alert">
                                                    <strong class="text-danger">{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="row">
                                               
                                                <div class="col-md-6 mb-2" style="font-size:18px">
                                                    {{ Form::label('department_id', __('Department')), ['class' => 'form-label'] }}
                                                    <select name="department_id" id="department" class="form-control">
                                                        <option value="">Select Department</option>
                                                        @foreach ($department as $departments)
                                                        <option value="{{ $departments->id }}">{{ $departments->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('department')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6 mb-2" style="font-size:18px">
                                                    {{ Form::label('section_id', __('Section')), ['class' => 'form-label'] }}
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
                                </div>
                                {{-- Other Details ends here --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="float-end" style="margin: auto; ">
                    <button type="button"
                        id="continueWorkingBtn"
                        style="background: #945880; color: white; height: 23px; font-size: 11px; border: 2px solid #7b4765; padding: 7px 13px; border-radius: 5px; display: inline-flex; align-items: center; justify-content: center; cursor: pointer; box-shadow: 0 3px 5px rgba(0, 0, 0, 0.1); transition: all 0.3s ease;">
                        {{ __('Continue Working') }}
                        <i class="fa-solid fa-play" style="font-size:8px; margin-left: 5px; align-items:center"></i>
                    </button>
                </div>
                {!! Form::close() !!}
            </div>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Include jQuery library in your HTML
    $(document).ready(function() {
        $('#categories').change(function() {
            console.log("comming to change");
            var categoryId = $(this).val();
            $.ajax({
                url: "{{ url('get-subcategory') }}",
                type: 'GET',
                data: {
                    category_id: categoryId,
                },
                success: function(response) {
                    console.log(response);
                    var subcategories = response;
                    $('#subcategory').empty();
                    $.each(subcategories, function(index, subcategory) {
                        $('#subcategory').append('<option value="' + subcategory
                            .id + '">' + subcategory.name + '</option>');
                    });
                },
                error: function(xhr, status, error) {

                }
            });
        });

        $('#department').change(function() {
            console.log("Comming to department");

            var departmentId = $(this).val();
            $.ajax({
                url: "{{ url('get-section') }}",
                type: 'GET',
                data: {
                    department_id: departmentId,
                },
                success: function(response) {
                    console.log(response);
                    var sections = response;
                    $('#section').empty();
                    $.each(sections, function(index, section) {
                        $('#section').append('<option value="' + section.id + '">' +
                            section.name + '</option>');
                    });
                },
                error: function(xhr, status, error) {

                }
            });
        });

        // Show modal on button click
        $('#continueWorkingBtn').on('click', function(e) {
            e.preventDefault();
            var modal = new bootstrap.Modal(document.getElementById('fileConfirmModal'));
            modal.show();
        });

        // On proceed, submit the form
        $('#proceedBtn').on('click', function() {
            $('#fileConfirmModal').modal('hide');
            $('#fileCreateForm').submit();
        });
    });
</script>

<!-- Confirmation Modal -->
<div class="modal fade" id="fileConfirmModal" tabindex="-1" aria-labelledby="fileConfirmModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="border-radius: 10px;">
      <div class="modal-header bg-primary text-light">
        <h5 class="modal-title" id="fileConfirmModalLabel">Confirmation</h5>
        <button type="button" class="btn-close text-light" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" style="font-size: 16px;">
        File No. will be generated(Number generated will be final and cannot be edited). Do you wish to proceed?
      </div>
      <div class="modal-footer">
          <button type="button" id="proceedBtn" class="btn text-light" style="background-color: #d5a000; transition: all 0.3s ease;">Proceed</button>
          <button type="button" class="btn text-light" data-bs-dismiss="modal" style="background-color: #d5a000; transition: all 0.3s ease;">Cancel</button>
      </div>
    </div>
  </div>
</div>
@endsection