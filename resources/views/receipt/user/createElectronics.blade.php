@extends('layouts.fileLayout')
@section('file_title', __('Create Electronics Receipt'))
@section('file_content')
<!-- @section('breadcrumb')
                                                                    <ul class="breadcrumb">
                                                                        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Dashboard') }}</a></li>
                                                                        <li class="breadcrumb-item"><a href="{{ route('receipt.index') }}">{{ __('Receipt') }}</a></li>
                                                                        <li class="breadcrumb-item">{{ __('Create') }}</li>
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
@endsection -->
<style>
    input[type="file"] {
        display: none;
    }

    .custom-file-upload {
        display: inline-block;
        color: white;
        padding: 0.3rem;
        font-family: sans-serif;
        font-size: 15px;
        border-radius: 0.3rem;
        cursor: pointer;
        margin-bottom: 1rem;
        background-color: dodgerblue !important;
        /* background-image: linear-gradient(315deg, #e76d2c 0%, #FFA500 74%); */

    }
</style>
<div class="row" style="padding-left:5px; background:none">
    <div class="section-body col-lg-6" style="padding-right:0s;margin-top:0.5%">
        <div class="col-md-12 m-auto" id="diary-details-card">
            <div class="card">
                {{ Form::open(['url' => 'receipt', 'method' => 'post', 'files' => true, 'enctype' => 'multipart/form-data']) }}

                <div class="card-body">
                    <div class="form-group">
                        {{-- <div class="row"style="height:30px"> --}}
                        {{-- <div class="col-md-7 m-b-20">

                                <input class="form-control" id="fileUpload" name="receipt_file" type="file"
                                    accept=".pdf,.doc,.docx">

                                <label for="fileUpload" class="custom-file-upload">Upload <span class="sidebar-icon">
                                        <svg width="25px" height="25px" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                stroke-linejoin="round"></g>
                                            <g id="SVGRepo_iconCarrier">
                                                <path
                                                    d="M17 17H17.01M15.6 14H18C18.9319 14 19.3978 14 19.7654 14.1522C20.2554 14.3552 20.6448 14.7446 20.8478 15.2346C21 15.6022 21 16.0681 21 17C21 17.9319 21 18.3978 20.8478 18.7654C20.6448 19.2554 20.2554 19.6448 19.7654 19.8478C19.3978 20 18.9319 20 18 20H6C5.06812 20 4.60218 20 4.23463 19.8478C3.74458 19.6448 3.35523 19.2554 3.15224 18.7654C3 18.3978 3 17.9319 3 17C3 16.0681 3 15.6022 3.15224 15.2346C3.35523 14.7446 3.74458 14.3552 4.23463 14.1522C4.60218 14 5.06812 14 6 14H8.4M12 15V4M12 4L15 7M12 4L9 7"
                                                    stroke="#ffffff" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round"></path>
                                            </g>
                                        </svg>
                                    </span>
                                </label>


                                
                                <button type="button" id="remofveFileLabel"
                                    style="display:none; border: none; border-radius: 5px; background-color: #868e96; color: white; padding: 3px;"
                                    class=" btn-secondary btn-sm">
                                    Remove File
                                    <svg fill="#ffffff" width="25px" height="25px" viewBox="0 0 32 32"
                                        xmlns="http://www.w3.org/2000/svg" stroke="#ffffff">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                        </g>
                                        <g id="SVGRepo_iconCarrier">
                                            <path
                                                d="M18.8,16l5.5-5.5c0.8-0.8,0.8-2,0-2.8l0,0C24,7.3,23.5,7,23,7c-0.5,0-1,0.2-1.4,0.6L16,13.2l-5.5-5.5 c-0.8-0.8-2.1-0.8-2.8,0C7.3,8,7,8.5,7,9.1s0.2,1,0.6,1.4l5.5,5.5l-5.5,5.5C7.3,21.9,7,22.4,7,23c0,0.5,0.2,1,0.6,1.4 C8,24.8,8.5,25,9,25c0.5,0,1-0.2,1.4-0.6l5.5-5.5l5.5,5.5c0.8,0.8,2.1,0.8,2.8,0c0.8-0.8,0.8-2.1,0-2.8L18.8,16z">
                                            </path>
                                        </g>
                                    </svg>
                                </button>

                                @error('receipt_file')
                                    <span class="invalid-name" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div> --}}
                        {{-- </div> --}}
                        <div class="row g-0" style="height:30px">
                            <div class="col-sm-4 col-md-2 text-end">
                                <input class="form-control" id="fileUpload" name="receipt_file" type="file"
                                    accept=".pdf,.doc,.docx">

                                <label for="fileUpload" class="custom-file-upload">Upload <span class="sidebar-icon">
                                        <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                stroke-linejoin="round"></g>
                                            <g id="SVGRepo_iconCarrier">
                                                <path
                                                    d="M17 17H17.01M15.6 14H18C18.9319 14 19.3978 14 19.7654 14.1522C20.2554 14.3552 20.6448 14.7446 20.8478 15.2346C21 15.6022 21 16.0681 21 17C21 17.9319 21 18.3978 20.8478 18.7654C20.6448 19.2554 20.2554 19.6448 19.7654 19.8478C19.3978 20 18.9319 20 18 20H6C5.06812 20 4.60218 20 4.23463 19.8478C3.74458 19.6448 3.35523 19.2554 3.15224 18.7654C3 18.3978 3 17.9319 3 17C3 16.0681 3 15.6022 3.15224 15.2346C3.35523 14.7446 3.74458 14.3552 4.23463 14.1522C4.60218 14 5.06812 14 6 14H8.4M12 15V4M12 4L15 7M12 4L9 7"
                                                    stroke="#ffffff" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round"></path>
                                            </g>
                                        </svg>
                                    </span>
                                </label>
                            </div>
                            <div class="col-sm-4 col-md-2 text-center" id="removeFilediv" style="display:none;">
                                <button type="button" id="removeFileLabel"
                                    style="display:none; border: none; border-radius: 5px; background-color: #868e96; color: white; padding: 3px; margin-top: 5px;"
                                    class=" btn-secondary btn-sm">
                                    Remove File
                                    <svg fill="#ffffff" width="16px" height="16px" viewBox="0 0 32 32"
                                        xmlns="http://www.w3.org/2000/svg" stroke="#ffffff">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                        </g>
                                        <g id="SVGRepo_iconCarrier">
                                            <path
                                                d="M18.8,16l5.5-5.5c0.8-0.8,0.8-2,0-2.8l0,0C24,7.3,23.5,7,23,7c-0.5,0-1,0.2-1.4,0.6L16,13.2l-5.5-5.5 c-0.8-0.8-2.1-0.8-2.8,0C7.3,8,7,8.5,7,9.1s0.2,1,0.6,1.4l5.5,5.5l-5.5,5.5C7.3,21.9,7,22.4,7,23c0,0.5,0.2,1,0.6,1.4 C8,24.8,8.5,25,9,25c0.5,0,1-0.2,1.4-0.6l5.5-5.5l5.5,5.5c0.8,0.8,2.1,0.8,2.8,0c0.8-0.8,0.8-2.1,0-2.8L18.8,16z">
                                            </path>
                                        </g>
                                    </svg>
                                </button>
                            </div>
                            <div class="col-sm-4 col-md-8">
                                <b class="text-danger" style="margin-left: 3px; margin-top: 5px !important;">PDF only <=
                                        20 MB</b>
                            </div>
                            @error('receipt_file')
                                <span class="invalid-name" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <iframe id="pdf-viewer"
                        style="display:none;height: 153vh;width: 102%;border: none;margin-top:20px"></iframe>
                    <div id="doc-viewer" style="display:none;"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="section-body col-lg-6" style="padding-left:0">
        <div class="col-md-12 m-auto">

            {{ Form::open(['url' => 'receipt', 'method' => 'post']) }}
            <input type="hidden" name="receipt_status" value="{{ ucfirst($type) }}">

            <div class="card-body">
                <div class="card" style="margin-top: 0.8%;">
                    <div class="card-header" style="background-color: #b1b1b1 !important;">
                        <h5 class="text-dark">
                            <svg fill="#000000" width="15px" height="15px" viewBox="0 0 32 32" version="1.1"
                                xmlns="http://www.w3.org/2000/svg">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <title>diary</title>
                                    <path
                                        d="M0 26.016q0 2.496 1.76 4.224t4.256 1.76h20q2.464 0 4.224-1.76t1.76-4.224v-20q0-1.952-1.12-3.488t-2.88-2.144v2.624q0 1.248-0.864 2.144t-2.144 0.864-2.112-0.864-0.864-2.144v-3.008h-12v3.008q0 1.248-0.896 2.144t-2.112 0.864-2.144-0.864-0.864-2.144v-2.624q-1.76 0.64-2.88 2.144t-1.12 3.488v20zM4 26.016v-16h24v16q0 0.832-0.576 1.408t-1.408 0.576h-20q-0.832 0-1.44-0.576t-0.576-1.408zM6.016 26.016h9.984v-2.016h-9.984v2.016zM6.016 22.016h20v-2.016h-20v2.016zM6.016 18.016h20v-2.016h-20v2.016zM6.016 14.016h20v-2.016h-20v2.016zM6.016 3.008q0 0.416 0.288 0.704t0.704 0.288 0.704-0.288 0.288-0.704v-3.008h-1.984v3.008zM24 3.008q0 0.416 0.288 0.704t0.704 0.288 0.704-0.288 0.32-0.704v-3.008h-2.016v3.008z">
                                    </path>
                                </g>
                            </svg> {{ __('Diary Details') }}
                        </h5>
                    </div>
                    <div class="form-group" style="padding: 0 1.7% 1.7%;">
                        <div class="row g-3">
                            <div class="col-md-6">
                                {{ Form::label('letter_ref_no', __('Letter Ref.no'), ['class' => 'form-label']) }}
                                {{ Form::text('letter_ref_no', $letter_reference_no, ['class' => 'form-control', 'placeholder' => __('Referance.No'), 'readonly' => true]) }}
                                @error('letter_ref_no')
                                    <span class="invalid-name" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                {{ Form::label('computer_number', __('Computer.no'), ['class' => 'form-label']) }}
                                {{ Form::text('computer_number', $com_num, ['class' => 'form-control', 'placeholder' => __('Referance.No'), 'readonly' => true]) }}
                                @error('computer_number')
                                    <span class="invalid-name" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                {{ Form::label('dairy_date', __('DairyDate'), ['class' => 'form-label']) }}
                                {{ Form::date('dairy_date', date('Y-m-d'), ['class' => 'form-control', 'placeholder' => __('DairyDate'), 'readonly']) }}
                                @error('dairy_date')
                                    <span class="invalid-name" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                {{ Form::label('form_of_communication', __('Form Of Communication')), ['class' => 'form-label'] }}<span
                                    class="text-danger">*</span>
                                <select name="form_of_communication" id="communication" class="form-control">
                                    <option value="">Choose one</option>
                                    @foreach ($communication as $communications)
                                        <option value="{{ $communications->id }}">
                                            {{ $communications->communication }}
                                    @endforeach

                                </select>
                                @error('form_of_communication')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                {{ Form::label('language', __('Language')), ['class' => 'form-label'] }}
                                <select name="language" id="language" class="form-control">
                                    <option value="">Select Language</option>
                                    <option value="English">English</option>
                                    <option value="Odia">Odia</option>
                                    <option value="Hindi">Hindi</option>
                                </select>
                                @error('language')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                {{ Form::label('receved_date', __('Received Date'), ['class' => 'form-label']) }}<span
                                    class="text-danger">*</span>
                                {{ Form::date('receved_date', null, ['class' => 'form-control', 'placeholder' => __('Received Date')]) }}
                                @error('receved_date')
                                    <span class="invalid-name" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                {{ Form::label('letter_date', __('Letter Date'), ['class' => 'form-label']) }}<span
                                    class="text-danger">*</span>
                                {{ Form::date('letter_date', null, ['class' => 'form-control', 'placeholder' => __('Received Date')]) }}
                                @error('letter_date')
                                    <span class="invalid-name" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                {{ Form::label('delivery_mode', __('Delivery Mode')), ['class' => 'form-label'] }}<span
                                    class="text-danger">*</span>
                                <select name="delivery_mode" id="delivery_mode" class="form-control">
                                    <option value="">Select one</option>
                                    @foreach ($deliverymode as $deliverymodes)
                                        <option value="{{ $deliverymodes->id }}">{{ $deliverymodes->mode }}
                                    @endforeach
                                </select>
                                @error('delivery_mode')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                {{ Form::label('mode_number', __('Mode Number'), ['class' => 'form-label']) }}
                                {{ Form::text('mode_number', null, ['class' => 'form-control', 'placeholder' => __('Referance.No')]) }}
                                @error('mode_number')
                                    <span class="invalid-name" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                {{ Form::label('sender_type', __('SenderType')), ['class' => 'form-label'] }}<span
                                    class="text-danger">*</span>
                                <select name="sender_type" id="sender_type" class="form-control">
                                    <option value="">Select one</option>
                                    @foreach ($sendertype as $sendertypes)
                                        <option value="{{ $sendertypes->id }}">{{ $sendertypes->sendertype }}
                                    @endforeach
                                </select>
                                @error('sender_type')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                {{ Form::label('vip', __('VIP')), ['class' => 'form-label'] }}
                                <select name="vip" id="vip" class="form-control">
                                    <option value="">Select one</option>
                                    @foreach ($vip as $vips)
                                        <option value="{{ $vips->id }}">{{ $vips->name }}
                                    @endforeach
                                </select>
                                @error('vip')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card" style="margin-top:0.8%">
                    <div class="card-header" style="background-color: #b1b1b1 !important;">
                        <h5 class="text-dark">
                            <svg version="1.1" id="Uploaded to svgrepo.com" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" width="20px" height="20px"
                                viewBox="0 0 32 32" xml:space="preserve" fill="#000000">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <style type="text/css">
                                        .stone_een {
                                            fill: #0B1719;
                                        }
                                    </style>
                                    <path class="stone_een"
                                        d="M19,19.415V21h-6v-1.585c0-0.986,0.48-1.903,1.288-2.464l0.463-0.231C15.132,16.896,15.553,17,16,17 s0.868-0.104,1.249-0.28l0.463,0.231C18.52,17.512,19,18.429,19,19.415z M16,16c1.103,0,2-0.897,2-2c0-1.103-0.897-2-2-2 s-2,0.897-2,2C14,15.103,14.897,16,16,16z M26,10v1h1c0.552,0,1,0.448,1,1v1c0,0.552-0.448,1-1,1h-1v1h1c0.552,0,1,0.448,1,1v1 c0,0.552-0.448,1-1,1h-1v1h1c0.552,0,1,0.448,1,1v1c0,0.552-0.448,1-1,1h-1v4c0,1.657-1.343,3-3,3H9c-1.657,0-3-1.343-3-3v-2H4.5 C4.224,24,4,23.776,4,23.5C4,23.224,4.224,23,4.5,23H6v-1H4.5C4.224,22,4,21.776,4,21.5C4,21.224,4.224,21,4.5,21H6V11H4.5 C4.224,11,4,10.776,4,10.5C4,10.224,4.224,10,4.5,10H6V9H4.5C4.224,9,4,8.776,4,8.5C4,8.224,4.224,8,4.5,8H6V6c0-1.657,1.343-3,3-3 h14c1.657,0,3,1.343,3,3v1h1c0.552,0,1,0.448,1,1v1c0,0.552-0.448,1-1,1H26z M20,19.022c0-1.254-0.709-2.399-1.83-2.959 c0.639-0.672,0.977-1.635,0.768-2.676c-0.236-1.179-1.215-2.134-2.399-2.34C14.645,10.717,13,12.167,13,14 c0,0.801,0.319,1.524,0.83,2.062c-1.122,0.56-1.83,1.706-1.83,2.959V21c0,0.552,0.448,1,1,1h6c0.552,0,1-0.448,1-1V19.022z">
                                    </path>
                                </g>
                            </svg> {{ __('Contact Details') }}
                        </h5>
                    </div>
                    <div class="card-body">
                        <!-- checkbox div -->
                        <div class="form-check form-switch" style="margin-top: 0.4%;">
                            <label class="form-check-label" for="flexSwitchCheckDefault">Save Contact</label>
                            <input class="form-check-input" name="saveContact" type="checkbox" role="switch"
                                id="flexSwitchCheckDefault">
                        </div>
                        <div class="row g-3">
                            <div class="col-md-6 " id="contactDropdown" type="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                {{ Form::label('name', __('Name:'), ['class' => 'form-label']) }}<span
                                    class="text-danger">*</span>
                                {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => __('Enter Name'), 'autocomplete' => 'off', 'oninput' => 'get_contact_name()']) }}
                                <!-- dropdown div -->
                                <div style="display: none;" class="dropdown-menu" id="autoComeplete-dropdown-menu"
                                    aria-labelledby="contactDropdown">
                                </div>
                                @error('name')
                                    <span class="invalid-name" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                {{ Form::label('department', __('Min/Department/others:')), ['class' => 'form-label'] }}
                                <select name="ministry_department" id="ministry_department" class="form-control">
                                    <option value="">Select Department</option>
                                    @foreach ($ministry as $ministrys)
                                        <option value="{{ $ministrys->id }}">
                                            {{ $ministrys->ministryname }}
                                    @endforeach
                                </select>
                                @error('department')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                {{ Form::label('designation', __('Designation:'), ['class' => 'form-label']) }}
                                {{ Form::text('designation', null, ['class' => 'form-control', 'placeholder' => __('Enter Designation')]) }}
                                @error('designation')
                                    <span class="invalid-name" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                {{ Form::label('organitation', __('Organization:'), ['class' => 'form-label']) }}
                                {{ Form::text('organitation', null, ['class' => 'form-control', 'placeholder' => __('Enter organitation')]) }}
                                @error('organitation')
                                    <span class="invalid-name" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                {{ Form::label('email', __('Email:'), ['class' => 'form-label']) }}
                                {{ Form::email('email', null, ['class' => 'form-control', 'placeholder' => __('Enter Email')]) }}
                                @error('email')
                                    <span class="invalid-name" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                {{ Form::label('address', __('Address:'), ['class' => 'form-label']) }}
                                {{ Form::text('address', null, ['class' => 'form-control', 'placeholder' => __('Enter Address')]) }}
                                @error('address')
                                    <span class="invalid-name" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                {{ Form::label('pin_code', __('Pin Code:'), ['class' => 'form-label']) }}
                                {{ Form::text('pin_code', null, ['class' => 'form-control', 'placeholder' => __('Enter Pin')]) }}
                                @error('pin_code')
                                    <span class="invalid-name" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6" id="phoneDropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ Form::label('phone_number', __('Phone Number:'), ['class' => 'form-label']) }}
                                {{ Form::text('phone_number', null, ['class' => 'form-control', 'placeholder' => __('Enter Phone no'), 'autocomplete' => 'off', 'oninput' => 'get_contact_phone()']) }}
                                <!-- dropdown div -->
                                <div style="display: none;" class="dropdown-menu phone-dropdown" id="phone-autoComplete-dropdown-menu" aria-labelledby="phoneDropdown">
                                </div>
                                @error('phone_number')
                                    <span class="invalid-name" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                {{ Form::label('country', __('Country:')), ['class' => 'form-label'] }}
                                <select name="country" id="country" class="form-control">
                                    <option value="">Select Country</option>
                                    @foreach ($country as $countrys)
                                        <option value="{{ $countrys->id }}">{{ $countrys->name }}
                                    @endforeach
                                </select>
                                @error('country')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                {{ Form::label('state', __('State:')), ['class' => 'form-label'] }}
                                <select name="state" id="state" class="form-control">
                                    <option value="">Select State</option>
                                    @foreach ($state as $states)
                                        <option value="{{ $states->id }}">{{ $states->name }}
                                    @endforeach
                                </select>
                                @error('State')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                {{ Form::label('city', __('City:'), ['class' => 'form-label']) }}
                                {{ Form::text('city', null, ['class' => 'form-control', 'placeholder' => __('Enter City')]) }}
                                @error('city')
                                    <span class="invalid-name" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card" style="margin-top: 0.8%;">
                    <div class="card-header" style="background-color: #b1b1b1 !important;">
                        <h5 class="text-dark">
                            <svg width="20px" height="20px" viewBox="0 0 512 512" version="1.1"
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                fill="#000000">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <title>tree</title>
                                    <g id="Page-1" stroke="none" stroke-width="1" fill="none"
                                        fill-rule="evenodd">
                                        <g id="icon" fill="#000000" transform="translate(85.333333, 64.000000)">
                                            <path
                                                d="M1.42108547e-14,-4.26325641e-14 L128,-4.26325641e-14 L128,64 L1.42108547e-14,64 L1.42108547e-14,-4.26325641e-14 Z M106.666667,106.666667 L234.666667,106.666667 L234.666667,170.666667 L106.666667,170.666667 L106.666667,106.666667 Z M106.666667,213.333333 L234.666667,213.333333 L234.666667,277.333333 L106.666667,277.333333 L106.666667,213.333333 Z M213.333333,320 L341.333333,320 L341.333333,384 L213.333333,384 L213.333333,320 Z M74.6666667,85.3333333 L74.6666667,117.333333 L85.3333333,117.333333 L85.3333333,149.333333 L42.6666667,149.333333 L42.6666667,85.3333333 L74.6666667,85.3333333 Z M181.333333,298.666667 L181.333333,330.666667 L192,330.666667 L192,362.666667 L149.333333,362.666667 L149.333333,298.666667 L181.333333,298.666667 Z M74.6666667,170.666667 L74.6666667,224 L85.3333333,224 L85.3333333,256 L42.6666667,256 L42.6666667,170.666667 L74.6666667,170.666667 Z"
                                                id="Combined-Shape"> </path>
                                        </g>
                                    </g>
                                </g>
                            </svg> {{ __('Category/Subcategory') }}
                        </h5>
                    </div>
                    <div class="card-body" style="background: none;">
                        <div class="row">
                            <div class="col-md-6">
                                {{ Form::label('category', __('Category')), ['class' => 'form-label'] }}<span
                                    class="text-danger">*</span>
                                <select name="category" id="category" class="form-control">
                                    <option value="">Category</option>
                                    @foreach ($category as $categorys)
                                        <option value="{{ $categorys->id }}">{{ $categorys->name }}
                                    @endforeach
                                </select>
                                @error('category')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                {{ Form::label('subcategory', __('SubCategory')), ['class' => 'form-label'] }}
                                <select name="subcategory" id="subcategory" class="form-control">
                                    <option value="">SubCategory</option>
                                    @foreach ($subcategory as $subcategorys)
                                        <option value="{{ $subcategorys->id }}">{{ $subcategorys->name }}
                                    @endforeach
                                </select>
                                @error('subcategory')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                {{ Form::label('subject', __('Subject'), ['class' => 'form-label']) }}<span
                                    class="text-danger">*</span>
                                {{ Form::text('subject', null, ['class' => 'form-control', 'placeholder' => __('Enter Subject')]) }}
                                @error('subject')
                                    <span class="invalid-name" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                {{ Form::label('remarks', __('Remarks'), ['class' => 'form-label']) }}
                                {{ Form::text('remarks', null, ['class' => 'form-control', 'placeholder' => __('Enter Remarks')]) }}
                                @error('remarks')
                                    <span class="invalid-name" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="card-footer">
                                <div class="float-start">
                                    <input type="checkbox" name="acknowledgement" style="cursor: pointer;"
                                        id="Acknowledgement"> Generate Acknowledgement
                                </div>
                                <div class="float-end" style="height: 5 vh;">
                                    <a href="{{ route('receipt.index') }}"
                                        class="btn btn-secondary mb-3">{{ __('Cancel') }}</a>
                                    <button type="submit" name="action" value="generate"
                                        class="btn btn-primary mb-3">{{ __('Gernerate') }}</button>
                                    <button type="submit" name="action" value="generate&send"
                                        class="btn btn-primary mb-3">{{ __('Generate & Send') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/mammoth/1.4.2/mammoth.browser.min.js"></script>

<script>
    $(document).ready(function() {
        function toggleDiaryDetailsCard() {
            if ($('#physicall').is(':checked')) {
                $('#diary-details-card').hide();
            } else {
                $('#diary-details-card').show();
            }
        }
        toggleDiaryDetailsCard();
        $('input[name="receipt_status"]').change(function() {
            toggleDiaryDetailsCard();
        });
    });
</script>
@include('receipt.user.contactDetailsScript')
<script>
    const fileInput = document.getElementById('fileUpload');
    const removeBtn = document.getElementById('removeFileBtn');

    fileInput.addEventListener('change', function() {
        const file = fileInput.files[0];
        if (file && file.type === "application/pdf") {
            removeBtn.style.display = 'inline-block';
        } else {
            removeBtn.style.display = 'none';
        }
    });

    removeBtn.addEventListener('click', function() {
        fileInput.value = ''; // Clear the selected file
        removeBtn.style.display = 'none'; // Hide the button again
        document.getElementById('pdf-viewer').style.display = 'none'; // Optionally hide PDF viewer
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        $('#fileUpload').change(function() {
            const file = this.files[0];
            if (!file) return;

            const maxSize = 20 * 1024 * 1024;
            if (file.size > maxSize) {
                Swal.fire({
                    icon: 'error',
                    title: 'File Too Large',
                    text: 'File size exceeds 20MB. Please upload a smaller file.',
                    confirmButtonColor: '#d33',
                });
                resetFileUpload();
                return;
            }

            const fileType = file.type;

            if (fileType === "application/pdf") {
                $('#pdf-viewer').show().attr('src', URL.createObjectURL(file));
                $('#doc-viewer').hide();
                $('#removeFileLabel').show();
                $('#removeFilediv').show();
            } else if (
                fileType === "application/msword" ||
                fileType === "application/vnd.openxmlformats-officedocument.wordprocessingml.document"
            ) {
                $('#pdf-viewer').hide();
                $('#doc-viewer').show();
                $('#removeFileLabel').show();
                $('#removeFilediv').show();

                const reader = new FileReader();
                reader.onload = function(event) {
                    mammoth.convertToHtml({
                            arrayBuffer: event.target.result
                        })
                        .then(function(result) {
                            $('#doc-viewer').html(result.value);
                        })
                        .catch(function(err) {
                            console.error("Error rendering Word document:", err);
                            $('#doc-viewer').html(
                                "<p>Unable to display the document. Please download it instead.</p>" +
                                "<a href='" + URL.createObjectURL(file) + "' download='" +
                                file.name + "'>Download Document</a>"
                            );
                        });
                };
                reader.readAsArrayBuffer(file);
            } else {
                $('#pdf-viewer').hide();
                $('#doc-viewer').show().html(
                    "<p>Unsupported file type. Please upload a PDF or Word document.</p>");
                $('#removeFileLabel').hide();
                $('#removeFilediv').hide();
            }
        });

        $('#removeFileLabel').click(function() {
            resetFileUpload();
        });

        function resetFileUpload() {
            $('#fileUpload').val('');
            $('#pdf-viewer').hide().attr('src', '');
            $('#doc-viewer').hide().html('');
            $('#removeFileLabel').hide();
            $('#removeFilediv').hide();
        }
    });
</script>

@endsection
