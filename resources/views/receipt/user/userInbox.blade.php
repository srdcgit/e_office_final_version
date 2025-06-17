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

        .c-pointer {
            cursor: pointer;
        }

        .sent-bar-border {
            border: solid transparent 1px;
            border-right-color: #fff !important;
        }
    </style>

    <div class="d-flex align-items-center bg-dark text-white p-2 gap-2 flex-wrap"
        style="background-color: #474b4f !important;">
        <a href="" class="sent-bar-border"><button class="btn text-light hiddn-box btn-sm">Put in a file</button></a>
        <!-- Attach Dropdown -->
        <div class="dropdown">
            <button class="btn text-light btn-sm dropdown-toggle sent-bar-border" type="button" id="moveToDropdown"
                data-bs-toggle="dropdown" aria-expanded="false">
                Move To
            </button>
            <ul class="dropdown-menu" aria-labelledby="moveToDropdown">
                <li class="dropdown dropend">
                    <a class="dropdown-item dropdown-toggle" href="#" id="myFolderDropdown" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        My Folder
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="myFolderDropdown">
                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                                data-bs-target="#createFolderModal">Create New Folder</a></li>
                        <li><a class="dropdown-item" href="#">Manage Folder</a></li>
                    </ul>
                </li>
                <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                        data-bs-target="#createFolderModal">Create New Folder</a></li>
                <li><a class="dropdown-item" href="#">Manage Folder</a></li>
            </ul>
        </div>


        <a href="" class="sent-bar-border"><button class="btn text-light hiddn-box btn-sm">Send</button></a>
        <a href="" class="sent-bar-border"><button class="btn text-light hiddn-box btn-sm">Send Back</button></a>
        <a href="" class="sent-bar-border"><button class="btn text-light hiddn-box btn-sm">Copy</button></a>
        <a href="{{ route('receipt.index') }}" class="sent-bar-border"><button
                class="btn text-light hiddn-box btn-sm">Close</button></a>


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

                        </select>
                        <label for="vip">Select Vip</label>
                        <select name="vip" class="c-pointer" id="vip">

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
    </div>
    <div style="margin-top:-8px;">
        {{ $dataTable->table(['width' => '100%']) }}
    </div>

    {{-- Folder Create  --}}
   <!-- Create Folder Modal -->
<div class="modal fade" id="createFolderModal" tabindex="-1" aria-labelledby="createFolderModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <form id="createFolderForm">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Create New Folder</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <input type="text" class="form-control" name="folder_name" placeholder="Enter folder name" required>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Create</button>
          </div>
        </div>
      </form>
    </div>
  </div>
  

    <!-- Dialog Box HTML -->
    <div id="custom-dialog"
        style="display:none; position:absolute; background:#fff; border:1px solid #ccc; padding:10px; z-index:1000;">
        <p id="dialog-content"></p>
    </div>

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
                    <i class="fa-solid fa-arrow-right" style="font-size: 12px;"></i>Send</a><br>

                    <a href="${url}" target="_self" id="close-action-btn" class="text-file"
                    style="font-size: 12px; color: black; text-decoration: none; margin-left: 5px;">
                    <i class="fa-solid fa-arrow-left" style="font-size: 12px;"></i>Send Back</a><br>

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
    </script>

    <!-- Modal -->
    <div class="modal fade" id="userDetailModal" tabindex="-1" aria-labelledby="userDetailModalLabel"
        aria-hidden="true">
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

    <!-- Script -->
    <script>
        $(document).on('click', '.sender', function() {
            var userId = $(this).data('id');

            $.ajax({
                url: 'receipt_inbox/user-details/' + userId,
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
    {{-- script for create folder  --}}
    <script>
        $('#createFolderForm').on('submit', function(e) {
            e.preventDefault();
            let folderName = $(this).find('input[name="folder_name"]').val();
// console.log(folderName);

            $.ajax({
                url: 'receipt/folders/create', // You'll define this route in Laravel
                type: 'POST',
                data: {
                    folder_name: folderName,
                    _token: '{{ csrf_token() }}'
                },
                success: function(res) {
                    alert('Folder created successfully');
                    $('#createFolderModal').modal('hide');
                    // Optionally reload the folders list or dropdown
                },
                error: function() {
                    alert('Error creating folder');
                }
            });
        });
        $('#createFolderForm').trigger('reset');
    </script>

@endsection

@push('style')
    @include('layouts.includes.datatable_css')
    <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome.css') }}">
@endpush
@push('scripts')
    @include('layouts.includes.datatable_js')
    {{ $dataTable->scripts() }}
@endpush
