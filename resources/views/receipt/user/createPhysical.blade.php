@extends('layouts.fileLayout')
@section('file_title', __('Create Physical Receipt'))
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

<div class="row" style="padding-left:5px">
    <div class="section-body col-lg-12" style="padding-left:0;padding-right : 0px">
        <div class="col-md-12 m-auto">
            <div class="card">
                {{ Form::open(['url' => 'receipt', 'method' => 'post']) }}
                <input type="hidden" name="receipt_status" value="{{ ucfirst($type) }}">
                <div class="card-body" style="background: none !important;">
                    <div class="form-group" style="display: none;">
                        <label class="radio-inline">
                            <input type="radio" name="receipt_status" id="physicall" value="physical">Physical
                        </label>
                    </div>
                    <div class="card" style="margin-top: 0.8%;">
                        <div class="card-header">
                            <h5> {{ __('Diary Details') }}</h5>
                        </div>
                        <div class="form-group" style="padding: 0 1.3% 1.3%;">
                            <div class="row g-3">
                                <div class="col-md-4">
                                    {{ Form::label('letter_ref_no', __('Letter Ref.no'), ['class' => 'form-label']) }}
                                    {{ Form::text('letter_ref_no', $letter_reference_no, ['class' => 'form-control', 'placeholder' => __('Referance.No'), 'readonly' => true]) }}
                                    @error('letter_ref_no')
                                    <span class="invalid-name" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    {{ Form::label('computer_number', __('Computer.no'), ['class' => 'form-label']) }}
                                    {{ Form::text('computer_number', $com_num, ['class' => 'form-control', 'placeholder' => __('Referance.No'), 'readonly' => true]) }}
                                    @error('computer_number')
                                    <span class="invalid-name" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    {{ Form::label('dairy_date', __('DairyDate'), ['class' => 'form-label']) }}
                                    {{ Form::date('dairy_date', date('Y-m-d'), ['class' => 'form-control', 'placeholder' => __('DairyDate'), 'readonly']) }}
                                    @error('dairy_date')
                                    <span class="invalid-name" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    {{ Form::label('form_of_communication', __('Form Of Communication')), ['class' => 'form-label'] }}<span
                                        class="text-danger">*</span>
                                    <select name="form_of_communication" id="communication" class="form-control">
                                        <option value="">Choose one</option>
                                        @foreach ($communication as $communications)
                                        <option value="{{ $communications->id }}">{{ $communications->communication }}
                                            @endforeach

                                    </select>
                                    @error('form_of_communication')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-4">
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
                                <div class="col-md-4">
                                    {{ Form::label('receved_date', __('Receved Date'), ['class' => 'form-label']) }}<span
                                        class="text-danger">*</span>
                                    {{ Form::date('receved_date', null, ['class' => 'form-control', 'placeholder' => __('Received Date')]) }}
                                    @error('receved_date')
                                    <span class="invalid-name" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    {{ Form::label('letter_date', __('Letter Date'), ['class' => 'form-label']) }}<span
                                        class="text-danger">*</span>
                                    {{ Form::date('letter_date', null, ['class' => 'form-control', 'placeholder' => __('Received Date')]) }}
                                    @error('letter_date')
                                    <span class="invalid-name" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-4">
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
                                <div class="col-md-4">
                                    {{ Form::label('mode_number', __('Mode Number'), ['class' => 'form-label']) }}
                                    {{ Form::text('mode_number', null, ['class' => 'form-control', 'placeholder' => __('Referance.No')]) }}
                                    @error('mode_number')
                                    <span class="invalid-name" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-4">
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
                                <div class="col-md-4">
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
                    <div class="card" style="margin-top:0.9%">
                        <div class="card-header">
                            <h5> {{ __('Contact Details') }}</h5>
                        </div>
                        <div class="card-body">
                            <!-- checkbox div -->
                            <div class="form-check form-switch" style="margin-top: 0.4%;">
                                <label class="form-check-label" for="flexSwitchCheckDefault">Save Contact</label>
                                <input class="form-check-input" name="saveContact" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                            </div>
                            <div class="row g-3">
                                <div class="col-md-4 " id="contactDropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ Form::label('name', __('Name:'), ['class' => 'form-label']) }}<span
                                        class="text-danger">*</span>
                                    {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => __('Enter Name'),'autocomplete' => 'off','oninput' => 'get_contact_name()']) }}
                                    <!-- dropdown div -->
                                    <div style="display: none;" class="dropdown-menu" id="autoComeplete-dropdown-menu" aria-labelledby="contactDropdown">
                                    </div>
                                    @error('name')
                                    <span class="invalid-name" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-4">
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
                                <div class="col-md-4">
                                    {{ Form::label('designation', __('Designation:'), ['class' => 'form-label']) }}
                                    {{ Form::text('designation', null, ['class' => 'form-control', 'placeholder' => __('Enter Designation')]) }}
                                    @error('designation')
                                    <span class="invalid-name" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    {{ Form::label('organitation', __('Organization:'), ['class' => 'form-label']) }}
                                    {{ Form::text('organitation', null, ['class' => 'form-control', 'placeholder' => __('Enter organitation')]) }}
                                    @error('organitation')
                                    <span class="invalid-name" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    {{ Form::label('email', __('Email:'), ['class' => 'form-label']) }}
                                    {{ Form::email('email', null, ['class' => 'form-control', 'placeholder' => __('Enter Email')]) }}
                                    @error('email')
                                    <span class="invalid-name" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    {{ Form::label('address', __('Address:'), ['class' => 'form-label']) }}
                                    {{ Form::text('address', null, ['class' => 'form-control', 'placeholder' => __('Enter Address')]) }}
                                    @error('address')
                                    <span class="invalid-name" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    {{ Form::label('pin_code', __('Pin Code:'), ['class' => 'form-label']) }}
                                    {{ Form::text('pin_code', null, ['class' => 'form-control', 'placeholder' => __('Enter Pin')]) }}
                                    @error('pin_code')
                                    <span class="invalid-name" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-4" id="phoneDropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
                                <div class="col-md-4">
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
                                <div class="col-md-4">
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
                                <div class="col-md-4">
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
                        <div class="card-header">
                            <h5> {{ __('Category/Subcategory') }}</h5>
                        </div>
                        <div class="card-body" style="background: none !important;">
                            <div class="row">
                                <div class="col-md-4">
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
                                <div class="col-md-4">
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
                                <div class="col-md-4">
                                    {{ Form::label('subject', __('Subject'), ['class' => 'form-label']) }}<span
                                        class="text-danger">*</span>
                                    {{ Form::text('subject', null, ['class' => 'form-control', 'placeholder' => __('Enter Subject')]) }}
                                    @error('subject')
                                    <span class="invalid-name" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    {{ Form::label('remarks', __('Remarks'), ['class' => 'form-label']) }}
                                    {{ Form::text('remarks', null, ['class' => 'form-control', 'placeholder' => __('Enter Remarks')]) }}
                                    @error('remarks')
                                    <span class="invalid-name" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="card-footer">
                                    <div class="float-end" style="height: 5vh;">
                                        <a href="{{ route('receipt.index') }}"
                                            class="btn btn-secondary mb-3">{{ __('Cancel') }}</a>
                                        <a href="{{ route('receipt.index') }}"
                                            class="btn btn-secondary mb-3">{{ __('Attach') }}</a>
                                        <a href="{{ route('receipt.index') }}"
                                            class="btn btn-secondary mb-3">{{ __('Dispatch') }}</a>
                                        <a href="{{ route('receipt.index') }}"
                                            class="btn btn-secondary mb-3">{{ __('Convert') }}</a>
                                        <button type="submit"
                                            class="btn btn-primary mb-3">{{ __('Save') }}</button>
                                    </div>
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
@include('receipt.user.contactDetailsScript')
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

<script>
    $(document).ready(function() {
        $('#fileUpload').change(function() {
            const file = this.files[0];
            const fileType = file.type;

            if (fileType === "application/pdf") {
                $('#pdf-viewer').show().attr('src', URL.createObjectURL(file));
                $('#doc-viewer').hide();
            } else if (fileType === "application/msword" || fileType ===
                "application/vnd.openxmlformats-officedocument.wordprocessingml.document") {
                $('#pdf-viewer').hide();
                $('#doc-viewer').show();

                const reader = new FileReader();
                reader.onload = function(event) {
                    mammoth.convertToHtml({
                            arrayBuffer: event.target.result
                        })
                        .then(function(result) {
                            $('#doc-viewer').html(result.value);
                        })
                        .catch(function(err) {
                            console.error("Error rendering Word document: ", err);
                            $('#doc-viewer').html(
                                "<p>Unable to display the document. Please download it instead.</p><a href='" +
                                URL.createObjectURL(file) + "' download='" + file.name +
                                "'>Download Document</a>");
                        });
                };
                reader.readAsArrayBuffer(file);
            } else {
                $('#pdf-viewer').hide();
                $('#doc-viewer').show().html(
                    "<p>Unsupported file type. Please upload a PDF or Word document.</p>");
            }
        });
    });
</script>
@endsection