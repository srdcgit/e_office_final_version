@extends('layouts.fileLayout')
@section('file_title', 'Movement')

@section('file_content')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="https://pro.fontawesome.com/releases/v6.5.0/css/all.css" rel="stylesheet">
    <link href="https://pro.fontawesome.com/releases/v6.5.0/css/all.css" rel="stylesheet">
    <style>
        .dataTables_filter {
            display: none;
        }

        .dataTables_length {
            display: none;
        }

        .hiddn-box {
            border-right: 2px solid white !important;
            border-radius: 0px !important;
        }

        .hiddn-box:hover {
            border-right: 2px solid white !important;
            border-radius: 0px !important;
        }

        .c-pointer {
            cursor: pointer;
        }
    </style>

    <style>
        .movement-history-ribbon {
            position: relative;
            display: inline-block;
            background-color: #0d77ca;
            /* Bootstrap blue */
            color: #fff;
            font-weight: bold;
            padding: 8px 20px 8px 15px;
            font-size: 16px;
            clip-path: polygon(0 0, 90% 0, 100% 50%, 90% 100%, 0 100%);
            border-radius: 2px 0 0 2px;
            margin-bottom: -5px;
        }
    </style>





    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet"> --}}

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


    {{-- Right code  --}}
    {{-- <div class="d-flex align-items-center bg-dark text-white p-2 gap-2 flex-wrap"
        style="background-color: #474b4f !important;">
        <a href="{{ route('receipt.share', $receiptid) }}"><button class="btn text-light hiddn-box btn-sm">Send</button></a>
        <a href="javascript:void(0);"><button class="btn text-light hiddn-box btn-sm" id="put-in-file-btn"
                data-toggle="modal" data-target="#put_in_file_modal" data-id="{{ $receiptid }}">Put in a
                file</button></a>
        <a href="javascript:void(0);"><button class="btn text-light hiddn-box btn-sm"
                onclick="copyToClipboard('{{ route('receipt.details.view', $copyreceiptid) }}')">Copy</button></a>

        <button class="btn text-light hiddn-box btn-sm">Generate Acknowledgement</button>
        <button class="btn text-light hiddn-box ">Close</button>

        <!-- Spacer -->
        <div class="ms-auto d-flex align-items-center gap-2 flex-wrap">



            <!-- Filter Icon -->
            <div class="dropdown d-inline-block">
                <button class="btn btn-light border dropdown-toggle" id="filterToggle" data-bs-toggle="dropdown">
                    <i class="fa fa-filter"></i>
                </button>

                <!-- Dropdown Filter Form -->
                <div class="dropdown-menu p-3 bg-light" id="filterForm" style="min-width: 300px;">

                    <div class="section">
                        <label class="section-title">Nature</label>
                        <label><input type="radio" class="c-pointer" id="both" name="nature" checked
                                value="both">
                            Both</label>
                        <label><input type="radio" class="c-pointer" id="physical" name="nature" value="physical">
                            Physical</label>
                        <label><input type="radio" class="c-pointer" id="electronics" name="nature"
                                value="electronics">
                            Electronic</label>
                    </div>

                    <!-- Subject Category Section -->
                    <div class="section">
                        <label class="section-title">Subject Category & Reference</label>
                        <label for="category">Select Category</label>
                        <select name="category" class="c-pointer" id="category">
                            @foreach ($categories as $category)
                                <option value="{{ null }}">Select</option>
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <label for="vip">Select Vip</label>
                        <select name="vip" class="c-pointer" id="vip">
                            @foreach ($vips as $vip)
                                <option value="{{ null }}">Select</option>
                                <option value="{{ $vip->id }}">{{ $vip->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Date Section -->
                    <div class="section date-section">
                        <label class="section-title">Date</label>
                        <div class="date-inputs">
                            <div>
                                <label>Creation Date From</label>
                                <input type="date" id="date_from" class="date-input c-pointer">
                            </div>
                            <div>
                                <label>Creation Date To</label>
                                <input type="date" id="date_to" class="date-input c-pointer">
                            </div>
                        </div>
                    </div>

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="module_filter" class="btn btn-primary">Filter</button>

                </div>
            </div>


            <!-- Search Box with Dropdown -->
            <div class="input-group input-group-sm" style="width: 200px;">
                <input type="text" id="receiptSearchInput" class="form-control" placeholder="Search Here..."
                    aria-label="Search">

                <!-- Dropdown Toggle Button -->
                <button class="btn btn-outline-light bg-light dropdown-toggle text-dark" type="button"
                    data-bs-toggle="dropdown" aria-expanded="false">

                </button>

                <!-- Dropdown Menu -->
                <ul class="dropdown-menu dropdown-menu-end p-2 bg-light " style="width: 200px;">
                    <li class="form-check">
                        <input class="form-check-input" type="checkbox" id="searchComputerNo" checked>
                        <label class="form-check-label" for="searchComputerNo">Computer Number</label>
                    </li>
                    <li class="form-check">
                        <input class="form-check-input" type="checkbox" id="searchReceiptNo">
                        <label class="form-check-label" for="searchReceiptNo">Receipt Number</label>
                    </li>
                    <li class="form-check">
                        <input class="form-check-input" type="checkbox" id="searchSubject">
                        <label class="form-check-label" for="searchSubject">Subject</label>
                    </li>
                    <li class="form-check">
                        <input class="form-check-input" type="checkbox" id="searchRemarks">
                        <label class="form-check-label" for="searchRemarks">Remarks</label>
                    </li>
                </ul>
            </div>


            <!-- "Receipt View" label -->
            <span class="text-light small">Receipt View</span>

            <!-- Select User with radio buttons inside dropdown -->
            <div class="dropdown">
                <button class="btn btn-sm btn-outline-light dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    Select User
                </button>
                <div class="dropdown-menu p-3 bg-light" style="min-width: 250px;">

                    <label class="form-label mt-2">Scope</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="scope" id="self" checked>
                        <label class="form-check-label" for="self">Self</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="scope" id="section">
                        <label class="form-check-label" for="section">Section</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="scope" id="hierarchy">
                        <label class="form-check-label" for="hierarchy">Hierarchy</label>
                    </div>
                </div>
            </div>

        </div>
    </div> --}}

    {{-- Another bar  --}}
    @php
        $receipt = \App\Models\Receipt::find($receiptid);
    @endphp

    @if ($receipt)
        <div class="d-flex justify-content-between align-items-center bg-light p-1 border rounded mb-3">
            <div>
                <strong>Receipt Created</strong> / {{ $receipt->letter_ref_no }}
            </div>
            @php
                $recipt_type =
                    $receipt->receipt_status === 'Electronics'
                        ? 'E'
                        : ($receipt->receipt_status === 'Physical'
                            ? 'P'
                            : '');
            @endphp

            <div>
                <span><strong>{{ $recipt_type }}</strong></span>
                <span class="ms-3"><strong>Comp. No.:</strong> {{ $receipt->computer_number }}</span>
                <span class="ms-3"><strong>Receipt No.:</strong> {{ $receipt->letter_ref_no }}</span>
                {{-- <span class="ms-3 text-light p-1"
                    style="border-radius: 5px !important; background-color: #474b4f !important;">Subject:
                    {{ $receipt->subject }}</span> --}}

                <span class="btn btn-dark text-white"
                    style="width:300px; height:22px;margin-bottom:4px; border-radius: 5px !important; background-color: #474b4f !important; padding-block:0px; padding-inline:10px;white-space: nowrap; overflow: hidden; text-overflow:ellipsis;">Subject:
                    {{ $receipt->subject ?? 'N/A' }}</span>
            </div>




        </div>
    @endif
    {{-- Another BAr ends here  --}}



    <div style="margin-top:-8px;">
        <div class="movement-history-ribbon">
            Movement History
        </div>
        {{-- {{ $dataTable->table(['width' => '100%']) }} --}}
        {!! $dataTable->table(['class' => 'table table-bordered table-striped']) !!}
    </div>

    <!-- Modal -->
    <div class="modal fade" id="userDetailModal" tabindex="-1" aria-labelledby="userDetailModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="userDetailModalLabel">User Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="userDetailContent">
                    Loading...
                </div>
            </div>
        </div>
    </div>

    {{-- Put in file modal  --}}
    @include('receipt.user.put_in_file_in_view')
    <script>
        $(document).on('click', '.receiver', function() {
            var userId = $(this).data('id');

            $.ajax({
                url: 'receipt_sent/user-details/' + userId,
                type: 'GET',
                success: function(data) {
                    $('#userDetailContent').html(data);
                    $('#userDetailModal').modal('show');
                },
                error: function() {
                    $('#userDetailContent').html(
                        '<p class="text-danger">Unable to load user details.</p>');
                    $('#userDetailModal').modal('show');
                }
            });
        });
    </script>



@endsection

@push('style')
    @include('layouts.includes.datatable_css')
    <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome.css') }}">
@endpush
@push('scripts')
    @include('layouts.includes.datatable_js')


    <script>
        $(function() {
            $('#receipt-movement-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('movements.index') }}',
                    data: function(d) {
                        d.receipt_id = '{{ request('receipt_id') }}'; // Pass to server
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'from',
                        name: 'fromUser.name'
                    },
                    // {
                    //     data: 'receipt_no',
                    //     name: 'receipt.letter_ref_no'
                    // },
                    {
                        data: 'to',
                        name: 'toUser.name'
                    },
                    {
                        data: 'remark_combined',
                        name: 'remark_combined',
                        orderable: false, // optional: you can sort by created_at if needed
                        searchable: false // optional: adjust as per your requirements
                    },
                    {
                        data: 'action',
                        name: 'action'
                    }
                ]
            });
        });
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
@endpush
