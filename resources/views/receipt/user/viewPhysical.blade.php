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



<div class="row" style="padding-left:5px">
    <div class="section-body col-lg-12" style="padding-left:0;padding-right : 0px">
        <div class="col-md-12 m-auto">
            <div class="card">
                {{ Form::open(['url' => 'receipt', 'method' => 'post']) }}
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
                                    {{ Form::text('letter_ref_no', $receipt->letter_ref_no, ['class' => 'form-control', 'disabled' => 'disabled', 'placeholder' => __('Referance.No'), 'readonly' => true]) }}
                                    @error('letter_ref_no')
                                        <span class="invalid-name" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    {{ Form::label('computer_number', __('Computer.no'), ['class' => 'form-label']) }}
                                    {{ Form::text('computer_number', $receipt->computer_number, ['class' => 'form-control', 'disabled' => 'disabled', 'placeholder' => __('Referance.No'), 'readonly' => true]) }}
                                    @error('computer_number')
                                        <span class="invalid-name" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    {{ Form::label('dairy_date', __('DairyDate'), ['class' => 'form-label']) }}
                                    {{ Form::date('dairy_date', $receipt->dairy_date, ['class' => 'form-control', 'disabled' => 'disabled', 'placeholder' => __('DairyDate'), 'readonly' => true]) }}
                                    @error('dairy_date')
                                        <span class="invalid-name" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    {{ Form::label('form_of_communication', __('Form Of Communication')), ['class' => 'form-label'] }}<span
                                        class="text-danger">*</span>
                                    <select name="form_of_communication" id="communication" disabled
                                        class="form-control">
                                        <option>{{ $receipt->communication }}</option>
                                    </select>
                                    @error('form_of_communication')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    {{ Form::label('language', __('Language')), ['class' => 'form-label'] }}
                                    <select name="language" disabled id="language" class="form-control">
                                        <option value="">{{ $receipt->language }}</option>
                                    </select>
                                    @error('language')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    {{ Form::label('receved_date', __('Receved Date'), ['class' => 'form-label']) }}<span
                                        class="text-danger">*</span>
                                    {{ Form::date('receved_date', $receipt->receved_date, ['class' => 'form-control', 'disabled' => 'disabled', 'placeholder' => __('Received Date')]) }}
                                    @error('receved_date')
                                        <span class="invalid-name" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    {{ Form::label('letter_date', __('Letter Date'), ['class' => 'form-label']) }}<span
                                        class="text-danger">*</span>
                                    {{ Form::date('letter_date', $receipt->letter_date, ['class' => 'form-control', 'disabled' => 'disabled', 'placeholder' => __('Received Date')]) }}
                                    @error('letter_date')
                                        <span class="invalid-name" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    {{ Form::label('delivery_mode', __('Delivery Mode')), ['class' => 'form-label'] }}<span
                                        class="text-danger">*</span>
                                    <select name="delivery_mode" disabled id="delivery_mode" class="form-control">
                                        <option value="">{{ $receipt->mode }}</option>
                                    </select>
                                    @error('delivery_mode')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    {{ Form::label('mode_number', __('Mode Number'), ['class' => 'form-label']) }}
                                    {{ Form::text('mode_number', $receipt->mode_number, ['class' => 'form-control', 'disabled' => 'disabled', 'placeholder' => __('Referance.No')]) }}
                                    @error('mode_number')
                                        <span class="invalid-name" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    {{ Form::label('sender_type', __('SenderType')), ['class' => 'form-label'] }}<span
                                        class="text-danger">*</span>
                                    <select name="sender_type" id="sender_type" disabled class="form-control">
                                        <option value="">{{ $receipt->sender }}</option>
                                    </select>
                                    @error('sender_type')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    {{ Form::label('vip', __('VIP')), ['class' => 'form-label'] }}
                                    <select name="vip" id="vip" disabled class="form-control">
                                        <option>{{ $receipt->vip }}</option>
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
                            <div class="row g-3">
                                <div class="col-md-4 " id="contactDropdown" type="button" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    {{ Form::label('name', __('Name:'), ['class' => 'form-label']) }}<span
                                        class="text-danger">*</span>
                                    {{ Form::text('name', $receipt->name, ['class' => 'form-control', 'disabled' => 'disabled', 'placeholder' => __('Enter Name'), 'autocomplete' => 'off', 'oninput' => 'get_contact_name()']) }}
                                    <!-- dropdown div -->
                                    <div style="display: none;" class="dropdown-menu"
                                        id="autoComeplete-dropdown-menu" aria-labelledby="contactDropdown">
                                    </div>
                                    @error('name')
                                        <span class="invalid-name" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    {{ Form::label('department', __('Min/Department/others:')), ['class' => 'form-label', 'disabled' => 'disabled'] }}
                                    <select name="ministry_department" disabled id="ministry_department"
                                        class="form-control">
                                        <option value="">{{ $receipt->ministry->ministryname }}</option>
                                    </select>
                                    @error('department')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    {{ Form::label('designation', __('Designation:'), ['class' => 'form-label']) }}
                                    {{ Form::text('designation', $receipt->designation, ['class' => 'form-control', 'disabled' => 'disabled', 'placeholder' => __('Enter Designation')]) }}
                                    @error('designation')
                                        <span class="invalid-name" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    {{ Form::label('organitation', __('Organization:'), ['class' => 'form-label']) }}
                                    {{ Form::text('organitation', $receipt->organitation, ['class' => 'form-control', 'disabled' => 'disabled', 'placeholder' => __('Enter organitation')]) }}
                                    @error('organitation')
                                        <span class="invalid-name" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    {{ Form::label('email', __('Email:'), ['class' => 'form-label']) }}
                                    {{ Form::email('email', $receipt->email, ['class' => 'form-control', 'disabled' => 'disabled', 'placeholder' => __('Enter Email')]) }}
                                    @error('email')
                                        <span class="invalid-name" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    {{ Form::label('address', __('Address:'), ['class' => 'form-label']) }}
                                    {{ Form::text('address', $receipt->address, ['class' => 'form-control', 'disabled' => 'disabled', 'placeholder' => __('Enter Address')]) }}
                                    @error('address')
                                        <span class="invalid-name" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    {{ Form::label('pin_code', __('Pin Code:'), ['class' => 'form-label']) }}
                                    {{ Form::text('pin_code', $receipt->pin_code, ['class' => 'form-control', 'disabled' => 'disabled', 'placeholder' => __('Enter Pin')]) }}
                                    @error('pin_code')
                                        <span class="invalid-name" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    {{ Form::label('phone_number', __('Phone Number:'), ['class' => 'form-label']) }}
                                    {{ Form::text('phone_number', $receipt->phone_number, ['class' => 'form-control', 'disabled' => 'disabled', 'placeholder' => __('Enter Phone no')]) }}
                                    @error('phone_number')
                                        <span class="invalid-name" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    {{ Form::label('country', __('Country:')), ['class' => 'form-label'] }}
                                    <select name="country" disabled id="country" class="form-control">
                                        <option value="">{{ $receipt->Country->name }}</option>
                                    </select>
                                    @error('country')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    {{ Form::label('state', __('State:')), ['class' => 'form-label'] }}
                                    <select name="state" disabled id="state" class="form-control">
                                        <option value="">{{ $receipt->State->name }}</option>
                                    </select>
                                    @error('State')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    {{ Form::label('city', __('City:'), ['class' => 'form-label']) }}
                                    {{ Form::text('city', $receipt->city, ['class' => 'form-control', 'disabled' => 'disabled', 'placeholder' => __('Enter City')]) }}
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
                                    <select name="category" disabled id="category" class="form-control">
                                        <option value="">{{ $receipt->Category->name }}</option>
                                    </select>
                                    @error('category')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    {{ Form::label('subcategory', __('SubCategory')), ['class' => 'form-label'] }}
                                    <select name="subcategory" disabled id="subcategory" class="form-control">
                                        <option value="">{{ $receipt->subCategory->name }}</option>
                                    </select>
                                    @error('subcategory')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    {{ Form::label('subject', __('Subject'), ['class' => 'form-label']) }}<span
                                        class="text-danger">*</span>
                                    {{ Form::text('subject', $receipt->subject, ['class' => 'form-control', 'disabled' => 'disabled', 'placeholder' => __('Enter Subject')]) }}
                                    @error('subject')
                                        <span class="invalid-name" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    {{ Form::label('remarks', __('Remarks'), ['class' => 'form-label']) }}
                                    {{ Form::text('remarks', $receipt->remarks, ['class' => 'form-control', 'disabled' => 'disabled', 'placeholder' => __('Enter Remarks')]) }}
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
                                        <a href="{{ route('receeipt.convert', ['id' => encrypt($receipt->id)]) }}"
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

@include('receipt.user.put_in_file_in_view')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/mammoth/1.4.2/mammoth.browser.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/2.2.0/css/dataTables.dataTables.css" />
<script src="https://cdn.datatables.net/2.2.0/js/dataTables.js"></script>
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.0/dist/sweetalert2.all.min.js"></script>

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

<script>
    $(document).ready(function() {
        // Initialize DataTable
        $('#modal-file-datatable').DataTable();

        // Handle "Put in a file" button click
        $('#put-in-file-btn').on('click', function() {
            const receiptId = $(this).data('id');
            $('#selected-receipt-id').val(receiptId);
        });

        // Handle Create File button (button version)
        $(document).on('click', '#create-putin-file[data-url]', function() {
            const url = $(this).data('url');
            if (url) {
                window.location.href = url;
            }
        });

        // Handle "Attach" button click
        $('#attach-btn').on('click', function() {
            const receiptId = $('#selected-receipt-id').val();
            console.log(receiptId);

            const selectedOption = $('input[name="selectFileRow"]:checked').val();

            if (!selectedOption) {
                Swal.fire('Please select a file first.');
                return;
            }

            $.ajax({
                url: "{{ route('add.receipt.to.file') }}",
                method: "POST",
                data: {
                    _token: '{{ csrf_token() }}',
                    file_id: selectedOption,
                    receipt_id: receiptId
                },
                success: function(response) {
                    if (response.code == 200) {
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'success',
                            title: "The Receipt has been put in a file",
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.log("Error:", error);
                }
            });
        });
    });
</script>

@include('receipt.user.contactDetailsScript')

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
@endsection
