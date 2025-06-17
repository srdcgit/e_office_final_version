@extends('layouts.fileLayout')
@section('file_title', 'Receipt Index')

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

        .dataTables_info {
            position: absolute;
            bottom: 11px;
            left: 55px;
        }

        .dataTables_paginate {
            position: absolute;
            bottom: 11px;
            right: 10px;
        }

        html,
        body {
            overflow-x: hidden;
        }
    </style>



    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet"> --}}


    {{-- Right code  --}}
    <style>
        .btnn {
            border-radius: 0px !important;
            background-color: #676869 !important;
            color: #fff !important;
        }

        .bg-dark {
            background-color: rgb(77 77 77) !important;
        }

        .topbar a {
            height: 100% !important;
            display: inline-block !important;
        }

        .topbar a button {
            height: 100% !important;
            padding-block: 0px !important;
            /* padding:6px 15px !important; */
        }

        #filterToggle {
            width: 33px;
            height: 33px;
            display: flex;
            justify-content: center;
            align-items: center;
            background: silver;
        }
    </style>


    <div class="d-flex align-items-stretch p-1 bg-dark flex-wrap topbar"
        style="border-bottom: 1px solid #dee2e6; height: 40px;
padding-block: 0px !important; gap:1px">

        <a href=""><button class="btn btnn btn-sm shadow-sm">Send</button></a>
        <a href=""><button class="btn btnn btn-sm shadow-sm">Put in a file</button></a>
        <a href=""><button class="btn btnn btn-sm shadow-sm">Copy</button></a>

        <button class="btn btnn btn-sm shadow-sm">Generate Acknowledgement</button>
        <button class="btn btnn btn-sm shadow-sm">Close</button>

        <!-- Spacer -->
        <div class="ms-auto d-flex align-items-center gap-2 flex-wrap">



            <!-- Filter Icon -->
            <div class="dropdown d-inline-block">
                <button class="btn btn-light border" id="filterToggle" data-bs-toggle="dropdown">
                    {{-- <i class="fa fa-filter"></i> --}}
                    <i class="bi bi-funnel" style="font-weight:900;"></i>
                </button>

                <!-- Dropdown Filter Form -->
                <div class="dropdown-menu p-3 bg-light" id="filterForm" style="min-width: 300px;">

                    <div class="section">
                        <label class="section-title">Nature</label>
                        <label><input type="radio" class="c-pointer" id="both" name="nature" checked value="both">
                            Both</label>
                        <label><input type="radio" class="c-pointer" id="physical" name="nature" value="physical">
                            Physical</label>
                        <label><input type="radio" class="c-pointer" id="electronics" name="nature" value="electronics">
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
            {{-- <div class="dropdown">
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
            </div> --}}

            <div class="input-group input-group-sm" style="width: 200px;">
                <input type="text" id="receiptSearchInput" class="form-control" placeholder="Select User..."
                    aria-label="User">

                <!-- Dropdown Toggle Button -->
                <button class="btn btn-outline-light bg-light dropdown-toggle text-dark" type="button"
                    data-bs-toggle="dropdown" aria-expanded="false">

                </button>

                <!-- Dropdown Menu -->
                <ul class="dropdown-menu dropdown-menu-end p-2 bg-light " style="width: 200px;">
                    <li class="form-check">
                        <input class="form-check-input" type="checkbox" id="self" checked>
                        <label class="form-check-label" for="self">Self</label>
                    </li>
                    <li class="form-check">
                        <input class="form-check-input" type="checkbox" id="section">
                        <label class="form-check-label" for="section">Section</label>
                    </li>
                    <li class="form-check">
                        <input class="form-check-input" type="checkbox" id="hierarchy">
                        <label class="form-check-label" for="hierarchy">Hierarchy</label>
                    </li>

                </ul>
            </div>


        </div>
    </div>




    <div style="margin-top:-4px;">
        {{ $dataTable->table(['width' => '100%']) }}
    </div>
    <!-- Dialog Box HTML -->
    <div id="custom-dialog"
        style="display:none; position:absolute; background:#fff; border:1px solid #ccc; padding:10px; z-index:1000;">
        <p id="dialog-content"></p>
    </div>
    @include('receipt.user.put_in_file')


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Attach contextmenu event to dynamically generated links
            document.addEventListener('contextmenu', function(e) {
                if (e.target && e.target.classList.contains('custom-link')) {
                    e.preventDefault(); // Prevent the default right-click menu

                    // Fetch the data-id attribute
                    const receiptId = e.target.getAttribute('data-id');
                    const dialog = document.getElementById('custom-dialog');
                    const url = e.target.getAttribute('href'); // Get the link's URL
                    const content = `
                    <a href="${url}" target="_self" class="text-file" id="close-action-btn"
                    style="font-size: 12px; color: black; text-decoration: none;margin-left: 22px;">Open</a><br>
                    <div class="icon-file">
                    <div class="icon-text">
                    <a href="${url}" target="_blank"  id="close-action-btn" class="text-file"style="font-size: 12px; color: black;
                    text-decoration: none; margin-left: 5px;">
                       <i class="fa-regular fa-share-from-square" style="font-size: 12px;"></i>
                       <span style="margin-left:-6px;">Open in Tab</span></a><br>

                    <a href="{{ route('receipt.share', '') }}/${receiptId}" id="close-action-btn" class="text-file"
                     style="font-size: 12px; color: black; text-decoration: none; margin-left: 5px;">
                    <i class="fa-solid fa-right-to-bracket" style="font-size: 12px; "></i>Send</a><br>

                    <a href="javascript:void(0);" data-url="${url}" id="copy-url-btn" class="text-file"
                    style="font-size: 12px; color: black; text-decoration: none; margin-left: 5px;">
                    <i class="fa-regular fa-copy" style="font-size: 12px;"></i> Copy</a><br>


                    <a href="${url}" target="_self" id="close-action-btn"  class="text-file"
                    style="font-size: 12px; color: black; text-decoration: none; margin-left: 5px; ">
                      <i class="fa-regular fa-pen-to-square" style="font-size: 12px; color: black;"></i>Generate Acknowledgement</a><br>



                    <a href="${url}" id="put-in-file-btn" data-toggle="modal" data-target="#put_in_file_modal" class="text-file"
                    style="font-size: 12px; color: black; text-decoration: none; margin-left: 5px;">
                    <i class="fa-regular fa-square-plus" style="font-size: 12px;"></i>Put in a File</a><br>

                    <a href="${url}" id="close-action-btn" target="_self" class="text-file">
                    <i class="fa-regular fa-folder" style="font-size: 12px;"></i> Close
                    </a>

                    <style>

                    #close-action-btn {
                    position: relative;
                    color: black;
                    text-decoration: none;
                    margin-left: 5px;
                    padding: 0px 0px;
                    display: inline-block;
                    border-radius: -3px;
                    overflow: hidden;
                    z-index: 1;
                    background-color: transparent;
                    transition: color 0.3s ease-in-out;
                    }


                    #close-action-btn::before {
                        content: '';
                        position: absolute;
                        top: 50%;
                        left: 50%;
                        width: 0;
                        height: 0;
                        background-color: #D3D3D3;

                    ;
                    z-index: -1;
                    border-radius: 50%;
                    transition: all 0.4s ease-in-out;
                    transform: translate(-50%, -50%);
                }

                    /* On hover, expand the background */
                    #close-action-btn:hover::before,
                    #close-action-btn:focus::before {
                        width: 200%; /* Expands the background beyond the button size */
                        height: 200%;
                    }

                    #close-action-btn:hover,
                    #close-action-btn:focus {
                        color: black; /* Change text and icon color */
                    }

                    /* Icon hover effect */
                    #close-action-btn:hover i,
                    #close-action-btn:focus i {
                        color: black;
                    }
                    </style>

                    <style>
                    #put-in-file-btn {
                    position: relative;
                    color: black;
                    text-decoration: none;
                    margin-left: 5px;
                    padding: 0px 0px;
                    display: inline-block;
                    border-radius: -3px;
                    overflow: hidden;
                    z-index: 1;
                    background-color: transparent;
                    transition: color 0.3s ease-in-out;
                    }

                   #put-in-file-btn::before {
                        content: '';
                        position: absolute;
                        top: 50%;
                        left: 50%;
                        width: 0;
                        height: 0;
                        background-color: #D3D3D3;
                    ;
                    z-index: -1;
                    border-radius: 50%;
                    transition: all 0.4s ease-in-out;
                    transform: translate(-50%, -50%);
                }
                    #put-in-file-btn:hover::before,
                    #put-in-file-btn:focus::before {
                        width: 200%; /* Expands the background beyond the button size */
                        height: 200%;
                    }

                    #put-in-file-btn:hover,
                    #put-in-file-btn:focus {
                        color: black; /* Change text and icon color */
                    }

                    /* Icon hover effect */
                    #put-in-file-btn:hover i,
                    #put-in-file-btn:focus i {
                        color: black;
                    }
                    </style>

                    </div>
                    </div>`
                    document.getElementById('dialog-content').innerHTML = content;
                    // Set dialog content dynamically
                    // document.getElementById('dialog-content').innerText = `Details for Receipt ID: ${receiptId}`;

                    // Position the dialog box near the mouse click
                    dialog.style.top = `${e.pageY}px`;
                    dialog.style.left = `${e.pageX}px`;
                    dialog.style.display = 'block';
                } else {
                    // Hide the dialog if the right-click happens elsewhere
                    closeDialog();
                }
            });

            // Hide the dialog when clicking elsewhere
            document.addEventListener('click', function(e) {
                if (!document.getElementById('custom-dialog').contains(e.target)) {
                    closeDialog();
                }


            });

            document.addEventListener('click', function(e) {
                if (document.getElementById('close-action-btn').contains(e.target)) {
                    closeDialog();
                }
            });
        });

        function closeDialog() {
            document.getElementById('custom-dialog').style.display = 'none';
        }

        // Handle copy to clipboard and show Swal alert
        document.addEventListener('click', function(e) {
            if (e.target && (e.target.id === 'copy-url-btn' || e.target.closest('#copy-url-btn'))) {
                const copyBtn = e.target.closest('#copy-url-btn');
                const copyText = copyBtn.getAttribute('data-url');

                navigator.clipboard.writeText(copyText).then(() => {
                    Swal.fire({
                        icon: 'success',
                        title: 'Copied!',
                        text: 'The link has been copied to clipboard.',
                        timer: 1500,
                        showConfirmButton: false
                    });
                }).catch(err => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Failed to copy the link.',
                    });
                });

                closeDialog(); // Optionally close the menu
            }
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
        $(document).ready(function() {
            let table = $('#receipts-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('receipt.index') }}",
                    data: function(d) {
                        // Search field values
                        d.search_value = $('#receiptSearchInput').val();
                        d.search_fields = [];

                        if ($('#searchComputerNo').is(':checked')) d.search_fields.push(
                            'computer_number');
                        if ($('#searchReceiptNo').is(':checked')) d.search_fields.push('letter_ref_no');
                        if ($('#searchSubject').is(':checked')) d.search_fields.push('subject');
                        if ($('#searchRemarks').is(':checked')) d.search_fields.push('remarks');

                        // Filter values
                        const selectedRadio = $('input[name="nature"]:checked').val();
                        if (selectedRadio === 'physical') {
                            d.receipt_status = $('#physical').val();
                        } else if (selectedRadio === 'electronics') {
                            d.receipt_status = $('#electronics').val();
                        }

                        d.creation_date_from = $('#date_from').val();
                        d.creation_date_to = $('#date_to').val();
                    }
                },
                columns: [{
                        data: 'checkbox',
                        name: 'checkbox',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'receipt_status',
                        name: 'receipt_status'
                    },
                    {
                        data: 'computer_number',
                        name: 'computer_number'
                    },
                    {
                        data: 'letter_ref_no',
                        name: 'letter_ref_no'
                    },
                    {
                        data: 'subject',
                        name: 'subject'
                    },
                    {
                        data: 'subcategory',
                        name: 'subcategory'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'remarks',
                        name: 'remarks'
                    },
                    {
                        data: 'receipt_file',
                        name: 'receipt_file'
                    },
                ]
            });

            // 🔁 Redraw on search input
            $('#receiptSearchInput').on('keyup', function() {
                table.draw();
            });

            // 🔁 Redraw on checkbox change
            $('.form-check-input').on('change', function() {
                table.draw();
            });

            // 🛠 Filter Modal Actions
            $('#filter-btn').on('click', function() {
                $('#exampleModal').modal('show');
                return false;
            });

            $('#module_filter').on('click', function() {
                table.ajax.reload();
                $('#exampleModal').modal('hide');
                return false;
            });

            // 🧠 Fix layout if table loads in modal/tab
            setTimeout(() => {
                $.fn.dataTable.tables({
                    visible: true,
                    api: true
                }).columns.adjust();
            }, 200);

            // ✅ Select All checkbox handling
            $('#select-all').on('click', function() {
                let isChecked = $(this).is(':checked');
                $('.row-checkbox').prop('checked', isChecked);
            });

            $(document).on('click', '.row-checkbox', function() {
                if (!$(this).is(':checked')) {
                    $('#select-all').prop('checked', false);
                } else if ($('.row-checkbox:checked').length === $('.row-checkbox').length) {
                    $('#select-all').prop('checked', true);
                }
            });
        });
    </script>
@endpush
