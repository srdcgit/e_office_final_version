@extends('layouts.fileLayout')
@section('file_title', 'Receipt View')

@section('file_content')
    {{-- top bar  --}}
    <style>
        .btnn {
            border-radius: 0px !important;
            background-color: #676869 !important;
            color: #fff !important;
        }

        .bg-dark {
            background-color: rgb(77 77 77) !important;
        }

        .hiddn-box {
            border-right: 2px solid white;
        }

        .hiddn-box:hover {
            border-right: 2px solid white;
        }

        .receipt-info-bar {
            height: 30px;
        }

        .receipt-info-bar-ul {
            list-style: none;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            padding-top: 3px;
            margin-left: auto;
        }

        .receipt-info-bar-ul li {
            display: inline-block;
            width: fit-content;
            height: 22px;
            padding-inline: 10px;
            font-weight: 500;
            font-size: 14px;
        }

        .receipt-info-bar-ul li:not(:last-child) {
            border-right: 2px solid rgb(173, 168, 168);
        }
    </style>
    <div class="d-flex align-items-center p-1 gap-2 bg-dark flex-wrap" style="border-bottom: 1px solid #dee2e6;">
        <a href="{{ route('receipt.index') }}">
            <button class="btn btnn btn-dark btn-sm shadow-sm">
                <svg fill="#ffffff" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink" width="20px" height="20px" viewBox="0 0 547.596 547.596"
                    xml:space="preserve">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <g>
                            <path
                                d="M540.76,254.788L294.506,38.216c-11.475-10.098-30.064-10.098-41.386,0L6.943,254.788 c-11.475,10.098-8.415,18.284,6.885,18.284h75.964v221.773c0,12.087,9.945,22.108,22.108,22.108h92.947V371.067 c0-12.087,9.945-22.108,22.109-22.108h93.865c12.239,0,22.108,9.792,22.108,22.108v145.886h92.947 c12.24,0,22.108-9.945,22.108-22.108v-221.85h75.965C549.021,272.995,552.081,264.886,540.76,254.788z">
                            </path>
                        </g>
                    </g>
                </svg>
            </button>
        </a>
        <a href="{{ route('movements.index', ['receipt_id' => $receipt->id]) }}">
            <button class="btn btnn  btn-sm shadow-sm">Movement</button>
        </a>
        <button class="btn btnn  btn-sm shadow-sm"
            onclick="copyToClipboard('{{ route('receipt.details.view', $copyreceiptid) }}')">Copy</button>
        <a href="{{ route('receipt.share', $receiptid) }}"><button class="btn btnn  btn-sm shadow-sm">Send</button></a>

        <a href="javascript:void(0);"><button id="put-in-file-btn" data-toggle="modal" data-target="#put_in_file_modal"
                data-id="{{ $receiptid }}" class="btn btnn  shadow-sm">Put in a file</button></a>

        <a href="{{ route('receipt.edit', $receipt->id) }}"><button class="btn btnn  btn-sm shadow-sm">Edit</button></a>


        <!-- Attach Dropdown -->
        <div class="dropdown">
            <button class="btn btnn  btn-sm shadow-sm dropdown-toggle" type="button" id="attachDropdown"
                data-bs-toggle="dropdown" aria-expanded="false">
                Attach
            </button>
            <ul class="dropdown-menu" aria-labelledby="attachDropdown">
                <li><a class="dropdown-item" href="#">File</a></li>
                <li><a class="dropdown-item" href="#">Image</a></li>
            </ul>
        </div>

        <!-- Draft Dropdown -->
        <div class="dropdown">
            <button class="btn btnn  btn-sm shadow-sm dropdown-toggle" type="button" id="draftDropdown"
                data-bs-toggle="dropdown" aria-expanded="false">
                Draft
            </button>
            <ul class="dropdown-menu" aria-labelledby="draftDropdown">
                <li><a class="dropdown-item" href="#">Save Draft</a></li>
                <li><a class="dropdown-item" href="#">View Drafts</a></li>
            </ul>
        </div>
        <a href="{{ route('home') }}">
            <button class="btn btnn  btn-sm shadow-sm">Close</button>
        </a>
        <a href="">
            <button class="btn btnn  btn-sm shadow-sm">Generate Acknowledgement</button>
        </a>

        <!-- Print Icon -->
        <button class="btn btnn btn-sm shadow-sm ms-auto" style="background: rgb(252, 111, 3) !important;">
            <i class="bi bi-printer"></i> <!-- Using Bootstrap Icons -->
        </button>
    </div>
    {{-- top bar ends  --}}

    <div class="receipt-info-bar" style="background:#b1b1b1;">
        <ul class="receipt-info-bar-ul">
            <li>{{ $receipt->receipt_status === 'Electronics' ? 'E' : 'P' }}</li>
            <li>Comp. No.: {{ $receipt->computer_number ?? 'N/A' }}</li>
            <li>Receipt No.: {{ $receipt->letter_ref_no ?? 'N/A' }}</li>
            <li><button class="btn btn-dark text-white"
                    style="width:300px; height:22px;margin-bottom:4px; padding-block:0px; padding-inline:10px;white-space: nowrap; overflow: hidden; text-overflow:ellipsis;">Subject:
                    {{ $receipt->subject ?? 'N/A' }}</button></li>
        </ul>
    </div>


    <div class="row" style="padding-left:5px; background:none">
        <div class="section-body col-lg-6" style="padding-right:0s;margin-top:0.5%">
            <div class="col-md-12 m-auto">
                <div class="card">
                    <div class="card-header" style="background-color:#d6d4d4 !important;">
                        <h5 class="text-dark">{{ __('Receipt') }}</h5>
                    </div>
                    {{ Form::model($receipt, ['route' => ['receipt.update', $receipt->id], 'method' => 'PUT']) }}
                    <div class="card-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4 m-b-10">
                                    {{ Form::label('receipt_file', __('UPLOAD'), ['class' => 'form-label']) }}
                                    {{ Form::file('receipt_file', ['class' => 'form-control', 'disabled' => 'disabled', 'id' => 'fileUpload']) }}
                                    @error('receipt_file')
                                        <span class="invalid-name" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <iframe id="pdf-viewer" style="height: 153vh; width: 102%; border: none;"
                            src="{{ $filePath ?? '' }}">
                        </iframe>
                        <div id="doc-viewer" style="display:none;"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section-body col-lg-6" style="padding-left:0">
            <div class="col-md-12 m-auto">
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
                                </svg> {{ __('Dairy Details') }}
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    {{ Form::label('Compute_No', __('Compute No'), ['class' => 'form-label']) }}
                                    {{ Form::text('computer_number', null, ['class' => 'form-control', 'disabled' => 'disabled', 'placeholder' => __('Referance.No')]) }}

                                    @error('dairy_date')
                                        <span class="invalid-name" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    {{ Form::label('letter_ref_no', __('Letter Ref.no'), ['class' => 'form-label']) }}
                                    {{ Form::text('letter_ref_no', null, ['class' => 'form-control', 'disabled' => 'disabled', 'placeholder' => __('Referance.No')]) }}
                                    @error('letter_ref_no')
                                        <span class="invalid-name" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    {{ Form::label('dairy_date', __('DairyDate'), ['class' => 'form-label']) }}
                                    {{ Form::date('dairy_date', null, ['class' => 'form-control', 'disabled' => 'disabled', 'placeholder' => __('DairyDate')]), 'disabled' }}
                                    @error('dairy_date')
                                        <span class="invalid-name" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    {{ Form::label('form_of_communication', __('Form Of Communication')), ['class' => 'form-label'] }}
                                    <select name="form_of_communication" id="communication" class="form-control"
                                        disabled>
                                        <option value="">Choose one</option>
                                        @foreach ($communication as $communications)
                                            <option value="{{ $communications->id }}"
                                                @if ($receipt->form_of_communication == $communications->id) selected @endif>
                                                {{ $communications->communication }}
                                        @endforeach

                                    </select>
                                    @error('form_of_communication')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    {{ Form::label('language', __('Language')), ['class' => 'form-label'] }}
                                    <select name="language" id="language" class="form-control" disabled>
                                        <option value="">Selected Language</option>
                                        <option value="English" {{ $receipt->language == 'English' ? 'selected' : '' }}>
                                            English</option>
                                        <option value="Odia" {{ $receipt->language == 'Odia' ? 'selected' : '' }}>Odia
                                        </option>
                                        <option value="Hindi" {{ $receipt->language == 'Hindi' ? 'selected' : '' }}>Hindi
                                        </option>
                                    </select>
                                    @error('language')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    {{ Form::label('receved_date', __('Receved Date'), ['class' => 'form-label']) }}
                                    {{ Form::date('receved_date', null, ['class' => 'form-control', 'disabled' => 'disabled', 'placeholder' => __('Received Date')]) }}
                                    @error('receved_date')
                                        <span class="invalid-name" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    {{ Form::label('letter_date', __('Letter Date'), ['class' => 'form-label']) }}
                                    {{ Form::date('letter_date', null, ['class' => 'form-control', 'disabled' => 'disabled', 'placeholder' => __('Received Date')]) }}
                                    @error('letter_date')
                                        <span class="invalid-name" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    {{ Form::label('delivery_mode', __('Delivery Mode')), ['class' => 'form-label'] }}
                                    <select name="delivery_mode" id="delivery_mode" disabled class="form-control">
                                        <option value="">Select one</option>
                                        @foreach ($deliverymode as $deliverymodes)
                                            <option value="{{ $deliverymodes->id }}"
                                                @if ($receipt->delivery_mode == $deliverymodes->id) selected @endif>
                                                {{ $deliverymodes->mode }}
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    {{ Form::label('mode_number', __('Mode Number'), ['class' => 'form-label']) }}
                                    {{ Form::text('mode_number', null, ['class' => 'form-control', 'disabled' => 'disabled', 'placeholder' => __('Referance.No')]) }}
                                    @error('mode_number')
                                        <span class="invalid-name" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    {{ Form::label('sender_type', __('SenderType')), ['class' => 'form-label'] }}
                                    <select name="sender_type" id="sender_type" disabled class="form-control">
                                        <option value="">Select one</option>
                                        @foreach ($sendertype as $sendertypes)
                                            <option value="{{ $sendertypes->id }}"
                                                @if ($receipt->sender_type == $sendertypes->id) selected @endif>
                                                {{ $sendertypes->sendertype }}
                                        @endforeach
                                    </select>
                                    @error('sender_type')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    {{ Form::label('vip', __('VIP')), ['class' => 'form-label'] }}
                                    <select name="vip" disabled id="vip" class="form-control">
                                        <option value="">Select one</option>
                                        @foreach ($vip as $vips)
                                            <option value="{{ $vips->id }}"
                                                @if ($receipt->Vip->id == $vips->id) selected @endif>
                                                {{ $receipt->Vip->name }}
                                        @endforeach
                                    </select>
                                    @error('vip')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card" style="margin-top: 0.8%;">
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
                            <div class="row g-3">
                                <div class="col-md-6">
                                    {{ Form::label('name', __('Name:'), ['class' => 'form-label']) }}
                                    {{ Form::text('name', null, ['class' => 'form-control', 'disabled' => 'disabled', 'placeholder' => __('Enter Name')]) }}
                                    @error('name')
                                        <span class="invalid-name" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    {{ Form::label('ministry_department', __('Department/other:'), ['class' => 'form-label']) }}
                                    <select name="ministry_department" disabled id="ministry_department"
                                        class="form-control">
                                        <option value="">Select Department</option>
                                        @foreach ($ministry as $ministrys)
                                            <option value="{{ $ministrys->id }}"
                                                @if ($receipt->ministry_department == $ministrys->id) selected @endif>
                                                {{ $ministrys->ministryname }}
                                        @endforeach
                                    </select>
                                    @error('department')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    {{ Form::label('designation', __('Designation:'), ['class' => 'form-label']) }}
                                    {{ Form::text('designation', null, ['class' => 'form-control', 'disabled' => 'disabled', 'placeholder' => __('Enter Designation')]) }}
                                    @error('designation')
                                        <span class="invalid-name" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    {{ Form::label('organitation', __('Organitation:'), ['class' => 'form-label']) }}
                                    {{ Form::text('organitation', null, ['class' => 'form-control', 'disabled' => 'disabled', 'placeholder' => __('Enter organitation')]) }}
                                    @error('organitation')
                                        <span class="invalid-name" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    {{ Form::label('email', __('Email:'), ['class' => 'form-label']) }}
                                    {{ Form::email('email', null, ['class' => 'form-control', 'disabled' => 'disabled', 'placeholder' => __('Enter Email')]) }}
                                    @error('email')
                                        <span class="invalid-name" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    {{ Form::label('address', __('Address:'), ['class' => 'form-label']) }}
                                    {{ Form::text('address', null, ['class' => 'form-control', 'disabled' => 'disabled', 'placeholder' => __('Enter Address')]) }}
                                    @error('address')
                                        <span class="invalid-name" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    {{ Form::label('pin_code', __('Pin Code:'), ['class' => 'form-label']) }}
                                    {{ Form::text('pin_code', null, ['class' => 'form-control', 'disabled' => 'disabled', 'placeholder' => __('Enter Pin')]) }}
                                    @error('pin_code')
                                        <span class="invalid-name" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    {{ Form::label('phone_number', __('Phone Number:'), ['class' => 'form-label']) }}
                                    {{ Form::text('phone_number', null, ['class' => 'form-control', 'disabled' => 'disabled', 'placeholder' => __('Enter Phone no')]) }}
                                    @error('phone_number')
                                        <span class="invalid-name" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    {{ Form::label('country', __('Country:'), ['class' => 'form-label']) }}
                                    <select name="country" disabled id="country" class="form-control">
                                        <option value="">Select Country</option>
                                        @foreach ($country as $countrys)
                                            <option value="{{ $countrys->id }}"
                                                @if ($receipt->country == $countrys->id) selected @endif>{{ $countrys->name }}
                                        @endforeach
                                    </select>
                                    @error('country')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    {{ Form::label('state', __('State:'), ['class' => 'form-label']) }}
                                    <select disabled name="state" id="state" class="form-control">
                                        <option value="">Select State</option>
                                        @foreach ($state as $states)
                                            <option value="{{ $states->id }}"
                                                @if ($receipt->state == $states->id) selected @endif>{{ $states->name }}
                                        @endforeach
                                    </select>
                                    @error('State')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    {{ Form::label('city', __('City:'), ['class' => 'form-label']) }}
                                    {{ Form::text('city', null, ['class' => 'form-control', 'disabled' => 'disabled', 'placeholder' => __('Enter City')]) }}
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
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    {{ Form::label('category', __('Category')), ['class' => 'form-label'] }}
                                    <select disabled name="category" id="category" class="form-control">
                                        <option value="">Category</option>
                                        @foreach ($category as $categorys)
                                            <option value="{{ $categorys->id }}"
                                                @if ($receipt->category == $categorys->id) selected @endif>{{ $categorys->name }}
                                        @endforeach
                                    </select>
                                    @error('department')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    {{ Form::label('subcategory', __('SubCategory')), ['class' => 'form-label'] }}
                                    <select disabled name="subcategory" id="subcategory" class="form-control">
                                        <option value="">SubCategory</option>
                                        @foreach ($subcategory as $subcategorys)
                                            <option value="{{ $subcategorys->id }}"
                                                @if ($receipt->subcategory == $subcategorys->id) selected @endif>
                                                {{ $subcategorys->name }}
                                        @endforeach
                                    </select>
                                    @error('department')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    {{ Form::label('subject', __('Subject'), ['class' => 'form-label']) }}
                                    {{ Form::text('subject', null, ['class' => 'form-control', 'disabled' => 'disabled', 'placeholder' => __('Enter Subject')]) }}
                                    @error('subject')
                                        <span class="invalid-name" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    {{ Form::label('remarks', __('Remarks'), ['class' => 'form-label']) }}
                                    {{ Form::text('remarks', null, ['class' => 'form-control', 'disabled' => 'disabled', 'placeholder' => __('Enter Remarks')]) }}
                                    @error('remarks')
                                        <span class="invalid-name" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        {{-- <div class="card-footer">
                            <div class="float-end" style="height: 5vh;">
                                <a href="{{ route('receipt.index') }}"
                                    class="btn btn-secondary mb-3">{{ __('Back') }}</a>
                            </div>
                        </div> --}}
                    </div>

                    <div class="card" style="margin-top: 0.8%;">
                        <h5 class="card-header d-flex justify-content-start align-items-center gap-2 text-dark"
                            style="background:#d6d4d4;"><i class="fa-solid fa-rotate-left text-dark"></i> History</h5>
                        <div class="card-body">


                            <ul class="nav nav-tabs mt-1" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="dispatch-tab" data-bs-toggle="tab"
                                        data-bs-target="#dispatch-tab-pane" type="button" role="tab"
                                        aria-controls="dispatch-tab-pane" aria-selected="true">Dispatch</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab"
                                        data-bs-target="#profile-tab-pane" type="button" role="tab"
                                        aria-controls="profile-tab-pane" aria-selected="false">Attached/Detached</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="Closed-tab" data-bs-toggle="tab"
                                        data-bs-target="#Closed-tab-pane" type="button" role="tab"
                                        aria-controls="Closed-tab-pane" aria-selected="false" disabled>Closed</button>
                                </li>

                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="dispatch-tab-pane" role="tabpanel"
                                    aria-labelledby="dispatch-tab" tabindex="0">
                                    <div class="button-style-tab">Dispatch History</div>

                                    <table class="mt-1">
                                        <thead>
                                            <th>Dispatch No.</th>
                                            <th>Issue No.</th>
                                            <th>Subject</th>
                                            <th>Dispatched On</th>
                                            <th>Dispatched By</th>
                                            <th>Delivery Mode</th>
                                        </thead>
                                        <tbody></tbody>
                                    </table>

                                </div>

                                <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel"
                                    aria-labelledby="profile-tab" tabindex="0">


                                    <div class="button-style-tab">Attached/Detached History</div>

                                    <table class="mt-1">
                                        <thead>
                                            <th>Dispatch No.</th>
                                            <th>Issue No.</th>
                                            <th>Subject</th>
                                            <th>Dispatched On</th>
                                            <th>Dispatched By</th>
                                            <th>Delivery Mode</th>
                                        </thead>
                                        <tbody></tbody>
                                    </table>

                                </div>

                                <div class="tab-pane fade" id="Closed-tab-pane" role="tabpanel"
                                    aria-labelledby="Closed-tab" tabindex="0">


                                    <div class="button-style-tab">Closed History</div>

                                    <table class="mt-1">
                                        <thead>
                                            <th>Dispatch No.</th>
                                            <th>Issue No.</th>
                                            <th>Subject</th>
                                            <th>Dispatched On</th>
                                            <th>Dispatched By</th>
                                            <th>Delivery Mode</th>
                                        </thead>
                                        <tbody></tbody>
                                    </table>


                                </div>

                            </div>



                        </div>

                        <div class="card-footer">
                            <div class="float-end" style="height: 5vh;">
                                <a href="{{ route('receipt.index') }}"
                                    class="btn btn-secondary mb-3">{{ __('Back') }}</a>
                                {{-- <a href="{{ route('receipt.edit', $receipt->id) }}"
                                    class="btn btn-secondary mb-3">{{ __('Edit') }}</a>
                                <button class="btn btn-primary mb-3">{{ __('Attach') }}</button>
                                <button class="btn btn-primary mb-3">{{ __('Draft') }}</button>
                                <button class="btn btn-primary mb-3">{{ __('Dispatch') }}</button>
                                @if ($receipt->receipt_status != 'Electronic')
                                    <button class="btn btn-primary mb-3">{{ __('Convert') }}</button>
                                @endif
                                <button class="btn btn-primary mb-3">{{ __('Print') }}</button> --}}
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('receipt.user.put_in_file_in_view')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.min.js"></script>
    <script>
        pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.worker.min.js';
        const url = "{{ $filePath }}";
        const pdfViewer = document.getElementById('pdf-viewer');
        console.log(url);

        if (url) {
            const loadingTask = pdfjsLib.getDocument(url);
            loadingTask.promise.then((pdf) => {
                console.log('PDF loaded');
            }).catch((error) => {
                console.error('Error loading PDF: ', error);
            });
        } else {
            console.error('PDF file path is missing.');
        }
    </script>

    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Copied!',
                    text: 'The link has been copied to your clipboard.',
                    timer: 1500,
                    showConfirmButton: false
                });
            }).catch(function(error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Failed to copy the link.',
                });
                console.error('Copy failed', error);
            });
        }
    </script>

    {!! Form::close() !!}

@endsection
