@extends('layouts.fileLayout')
@section('file_title', 'File Notes')
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

        /* code by sumit */

        .notes-card-header {
            align-items: end !important;
            padding-bottom: 2px !important;
            padding-left: 0px !important;
            background: unset !important;
            height: 40px;
        }

        .left-part {
            width: fit-content;
            padding-left: 20px;
            padding-right: 50px;
            height: 100%;
            background: #0D77CA;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            clip-path: polygon(0 0, 90% 0, 100% 100%, 80% 100%, 0 100%);
        }

        .right-part {
            height: 100%;
            display: flex;
            align-items: center;
        }

        .right-part a {
            margin-right: 5px;
        }

        .right-part svg {
            width: 30px;
            height: 30px;
        }

        .left-part h5 {
            margin-bottom: 4px !important;
        }

        .toc-container {
            width: 180px;
            background: rgb(73, 70, 70);
            color: white;
            border-top-left-radius: 20px;
            border-bottom-left-radius: 20px;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            padding-block: 5px !important;
            margin-left: 5px;
            margin-bottom: 2px;
        }

        .toc-container span {
            margin-right: 10px;
        }

        .toc-container a {
            display: block;
            width: 25px;
            height: 25px;
            border-radius: 50%;
            background: black;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-right: 10px;
        }

        .toc-container a svg {
            width: 15px !important;
            height: 15px !important;
        }

        .bars-dropdown {
            width: 35px;
            height: 35px;
            margin-left: 2px !important;
            margin-bottom: 2px;
        }

        .bars-dropdown button {
            width: 100% !important;
            height: 100% !important;
            display: flex !important;
            justify-content: center !important;
            align-items: center !important;
            padding: 0px !important;
            border-radius: 0px;
        }

        .bars-dropdown button svg {
            width: 20px !important;
            height: 20px !important;
        }

        .bars-dropdown-menu svg {
            width: 20px !important;
            height: 20px !important;
        }

        .bars-dropdown-menu {
            background: rgb(73, 70, 70) !important;
        }

        .bars-dropdown-menu li:not(:last-child) {
            border-bottom: 1px solid rgb(134, 133, 133) !important;
        }

        .bars-dropdown-menu li a {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 10px;
            color: white !important;
            height: 100% !important;
        }

        #resizable-container {
            min-width: 400px;
            max-width: 100vw;
            height: 66vh !important;
            background: #f8f9fa;
            border-radius: 0px !important;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
            overflow: hidden;

        }

        #left-panel,
        #right-panel {
            border-bottom: 7px solid #636363 !important;
        }

        #right-panel .card {
            height: 100% !important;
        }

        #right-panel .corespondense-card-body {
            height: 100% !important;
        }

        #right-panel .corespondense-card-body .table-responsive {
            max-height: 350px !important;
        }

        .dataTables_filter {
            display: none;
            /* Hide default search box since we have our own */
        }

        .dataTables_length {
            margin-bottom: 1rem;
        }

        .table-responsive {
            padding: 1rem;
        }

        .dataTables_info {
            font-size: 0.875rem;
            color: #6c757d;
        }

        .pagination {
            margin: 0;
        }

        .select-checkbox {
            width: 30px;
        }

        /* Add this to your existing styles */
        #available-receipts-table .receipt-checkbox {
            margin: 0;
            vertical-align: middle;
        }

        #available-receipts-table thead th:first-child {
            width: 40px;
            text-align: center;
        }

        .dropdown-menu {
    min-width: 150px;
}
.dropdown-item {
    display: block;
    padding: 8px 16px;
    color: #333; 
    text-decoration: none;
    cursor: pointer;
}

    </style>
    <div class="d-flex align-items-center p-1 gap-2 bg-dark flex-wrap" style="border-bottom: 1px solid #dee2e6;">
        <a href="{{ route('file.index') }}">
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
        <a href="{{ route('movements.index') }}">
            <button class="btn btnn  btn-sm shadow-sm">Movement</button>
        </a>
        <button class="btn btnn  btn-sm shadow-sm">Copy</button>
        @if ($gnotes != null)
            <a href="{{ route('file.share', $gnotes->id) }}"><button class="btn btnn  btn-sm shadow-sm">Send</button></a>
        @endif
        <a href="javascript:void(0);"><button id="put-in-file-btn" data-toggle="modal" data-target="#put_in_file_modal"
                data-id="" class="btn btnn  shadow-sm">Put in a file</button></a>

        <a href=""><button class="btn btnn  btn-sm shadow-sm">Edit</button></a>


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

    <div class="receipt-info-bar" style="background:#e0e0e0; margin-bottom: 5px;">
        <ul class="receipt-info-bar-ul">
            @php
                $file_type = $file->file_type;
                if ($file_type == 'Electronic') {
                    $file_type = 'E';
                } elseif ($file_type == 'Physical') {
                    $file_type = 'P';
                }
            @endphp
            <li>{{ $file_type ?? 'N/A' }}</li>
            <li>File No.: {{ $file->fileno ?? 'N/A' }}</li>
            <li>File Name: {{ $file->file_name ?? 'N/A' }}</li>
            <li><button class="btn btn-dark text-white"
                    style="width:300px; height:22px;margin-bottom:4px; padding-block:0px; padding-inline:10px;white-space: nowrap; overflow: hidden; text-overflow:ellipsis;">Description:
                    {{ $file->description ?? 'N/A' }}</button></li>
        </ul>
    </div>


    <div class="row">
        <div class="col-lg-12">
            <div id="resizable-container" style="display: flex; width: 100%; min-height: 500px;">
                {{-- coloumn 1  --}}
                <div id="left-panel"
                    style="flex: 1 1 0; min-width: 200px; background: #b8dbb8; transition: flex-basis 0.2s;">
                    <button id="expand-left" class="expand-btn" title="Expand Left Panel">
                        <i class="fas fa-expand"></i>
                    </button>
                    @include('file.ckeditor')
                </div>
                <div id="divider"
                    style="width: 16px; cursor: ew-resize; display: flex; align-items: center; justify-content: center; background: #eee; border-left: 1px solid #ccc; border-right: 1px solid #ccc; position: relative; z-index: 2;">
                    <span
                        style="display: block; width: 28px; height: 28px; background: #fffbe6; border-radius: 50%; box-shadow: 0 1px 4px #ccc; display: flex; align-items: center; justify-content: center; border: 1px solid #e0c97f;">
                        <i class="fas fa-grip-lines-vertical" style="color: #bfa13a;"></i>
                    </span>
                </div>
                {{-- coloumn 2  --}}
                <div id="right-panel" style="flex: 1 1 0; min-width: 200px; background: #fff; transition: flex-basis 0.2s;">
                    <div class="card">
                        {{-- My code  --}}
                        {{-- <div class="notes-card-header">
                            <h5>{{ __('List Of Correspondences') }} </h5>
                            @if ($file_share != null)
                                @if ($file_share->status >= 1 && $file_share->sender_id != Auth::user()->id && $file_share->actiontype == \App\Models\Fileshare::EDIT)
                                    <div class="dropdown ">
                                        <button class="btn btn-secondary dropdown-toggle mt-0 p-1" type="button"
                                            id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                            {{ __('All') }}
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                            <li><a class="dropdown-item" href="#"
                                                    id="showReceipt">{{ __('Receipt') }}</a></li>
                                            <li><a class="dropdown-item" href="#"
                                                    id="shownotes">{{ __('Previous Notes') }}</a></li>
                                            <li><a class="dropdown-item" href="#"
                                                    id="file">{{ __('Document Details') }}</a></li>
                                        </ul>
                                    </div>
                                @endif
                            @else
                                <div class="dropdown ">
                                    <button class="btn btn-secondary dropdown-toggle mt-0 p-1" type="button"
                                        id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                        {{ __('All') }}
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        <li><a class="dropdown-item" href="#"
                                                id="showReceipt">{{ __('Receipt') }}</a></li>
                                        <li><a class="dropdown-item" href="#"
                                                id="shownotes">{{ __('Previous Notes') }}</a></li>
                                        <li><a class="dropdown-item" href="#"
                                                id="file">{{ __('Document Details') }}</a></li>
                                    </ul>
                                </div>
                            @endif
                        </div>
                        <div class="corespondense-card-body h-66">
                            <div id="table">
                                <h4>Receipts</h4>
                                <table class="table table-bordered table-hover">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>{{ __('Receipt/Issue No') }}</th>
                                            <th>{{ __('Subject') }}</th>
                                            <th>{{ __('Attachment') }}</th>
                                            <th>{{ __('Issue On') }}</th>
                                            <th>{{ __('Remarks') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($correspondence as $correspondences)
                                            @if ($correspondences->receipt_id != null)
                                                <tr>
                                                    <td>{{ $correspondences->receipt->dairy_date }}</td>
                                                    <td>{{ $correspondences->receipt->subject }}</td>
                                                    <td>{{ $correspondences->receipt->receved_date }}</td>
                                                    <td>{{ $correspondences->receipt->letter_ref_no }}</td>
                                                    <td>{{ $correspondences->receipt->remarks }}</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div id="documenttable">
                                <h4>Documents</h4>
                                <table class="table table-bordered table-hover">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>{{ __('File name') }}</th>
                                            <th>{{ __('Dtype') }}</th>
                                            <th>{{ __('Document name') }}</th>
                                            <th>{{ __('Metatitle') }}</th>
                                            <th>{{ __('Documentpath') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($correspondence as $correspondences)
                                            @if ($correspondences->doc_id != null && $correspondences->document != null)
                                                <tr>
                                                    <td>{{ $correspondences->file->file_name }}</td>
                                                    <td>{{ $correspondences->document->dtype }}</td>
                                                    <td>{{ $correspondences->document->document_name }}</td>
                                                    <td>{{ $correspondences->document->meta_title }}</td>
                                                    <td>{{ $correspondences->document->documentpath }}</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div id="notesttable">
                                <h4>Notes</h4>
                                <table class="table table-bordered table-hover">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>{{ __('Notes name') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($correspondence as $correspondences)
                                            @if ($correspondences->notes_id != null)
                                                <tr>
                                                    <td>{!! $correspondences->notes->description !!}</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div id="receipttable" style="display: none;">
                                <table class="table table-bordered table-hover">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>{{ __('Select') }}</th>
                                            <th>{{ __('Receipt/Issue No') }}</th>
                                            <th>{{ __('Subject') }}</th>
                                            <th>{{ __('Attachment') }}</th>
                                            <th>{{ __('Issue On') }}</th>
                                            <th>{{ __('Remarks') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{ Form::open(['route' => 'correspondance.store', 'method' => 'post']) }}
                                        @foreach ($receipt as $receipts)
                                            <tr>
                                                <td><input type="checkbox" name="receipt_id[]"
                                                        value="{{ $receipts->id }}">
                                                </td>
                                                <td>{{ $receipts->dairy_date }}</td>
                                                <td>{{ $receipts->subject }}</td>
                                                <td>{{ $receipts->receved_date }}</td>
                                                <td>{{ $receipts->letter_ref_no }}</td>
                                                <td>{{ $receipts->remarks }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="col-md-2 mt-3" id="add" style="display: none;">
                                    <input type="hidden" name="file_id" id="file" value="{{ $file->id }}">
                                    <button type="submit"
                                        class="btn btn-primary btn-block">{{ __('Add Receipt') }}</button>
                                </div>
                                {!! Form::close() !!}
                            </div>

                            <div id="filettable" style="display: none;">
                                <button type="submit" onClick="refreshPage()" id="reload"
                                    class="btn btn-primary">Refresh</button>
                                <table class="table table-bordered table-hover">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>{{ __('Select') }}</th>
                                            <th>{{ __('Dtype') }}</th>
                                            <th>{{ __('Document Name') }}</th>
                                            <th>{{ __('Metatitle') }}</th>
                                            <th>{{ __('Documentpath') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{ Form::open(['route' => 'correspondance.store', 'method' => 'post']) }}
                                        @if ($document != null)
                                            @foreach ($document as $documents)
                                                <tr>
                                                    <td><input type="checkbox" name="document_id[]"
                                                            value="{{ $documents->id }}">
                                                    </td>
                                                    <td>{{ $documents->dtype }}</td>

                                                    @if ($documents->dtype == 'create')
                                                        <td>{{ $documents->document_name }}</td>
                                                    @elseif ($documents->dtype == 'upload')
                                                        <td>{{ $documents->uploadmetatitle }}</td>
                                                    @endif

                                                    <td>{{ $documents->meta_title }}</td>
                                                    <td>{{ $documents->documentpath }}</td>
                                                </tr>
                                            @endforeach
                                        @endif


                                    </tbody>
                                </table>
                                <div class="col-md-2 mt-3" id="add">
                                    <input type="hidden" name="file_id" id="file" value="{{ $file->id }}">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        <i class="fas fa-plus"></i> {{ __('Add Document') }}
                                    </button>
                                    <div class="row mt-2">
                                        <a href="{{ route('document.create') }}" class="btn btn-success btn-block"
                                            target="_blank">
                                            <i class="fas fa-file-alt"></i> {{ __('Create Document') }}
                                        </a>
                                    </div>
                                </div>
                                {!! Form::close() !!}
                            </div>
                            <div id="greenNotesSection" style="display: none;">
                                <table class="table table-bordered table-hover">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>{{ __('Select') }}</th>
                                            <th>{{ __('Green Notes') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{ Form::open(['route' => 'correspondance.store', 'method' => 'post']) }}
                                        @foreach ($greennote as $greennotes)
                                            <tr>
                                                <td><input type="checkbox" name="note_id[]"
                                                        value="{{ $greennotes->id }}">
                                                <td>{!! $greennotes->description !!}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="col-md-2 mt-3" id="add">
                                    <input type="hidden" name="file_id" id="file" value="{{ $file->id }}">
                                    <button type="submit"
                                        class="btn btn-primary btn-block">{{ __('Add Notes') }}</button>
                                </div>
                            </div>
                        </div> --}}
                        {{-- My Codes Ends  --}}

                        {{-- code by sumit --}}

                        <div class="notes-card-header">
                            <div class="left-part">
                                <h5>Table of Correspondences (TOC)</h5>
                            </div>

                            <div class="right-part">

                                <a href="#">
                                    <svg viewBox="0 0 1024 1024" class="icon" version="1.1"
                                        xmlns="http://www.w3.org/2000/svg" fill="#000000">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                        <g id="SVGRepo_iconCarrier">
                                            <path d="M512 512m-480 0a480 480 0 1 0 960 0 480 480 0 1 0-960 0Z"
                                                fill="#eebe87"></path>
                                            <path
                                                d="M678.4 780.8H345.6c-25.6 0-44.8-19.2-44.8-44.8V249.6c0-25.6 19.2-44.8 44.8-44.8h332.8c25.6 0 44.8 19.2 44.8 44.8v486.4c0 25.6-19.2 44.8-44.8 44.8z"
                                                fill="#FF9D1C"></path>
                                            <path
                                                d="M633.6 608H390.4c-19.2 0-32-12.8-32-32V294.4c0-19.2 12.8-32 32-32H640c19.2 0 32 12.8 32 32V576c-6.4 19.2-19.2 32-38.4 32z"
                                                fill="#FFCA83"></path>
                                            <path d="M512 697.6m-38.4 0a38.4 38.4 0 1 0 76.8 0 38.4 38.4 0 1 0-76.8 0Z"
                                                fill="#FFFFFF"></path>
                                        </g>
                                    </svg>
                                </a>

                                <a href="#">
                                    <svg viewBox="0 0 1024 1024" class="icon" version="1.1"
                                        xmlns="http://www.w3.org/2000/svg" fill="#ffffff" stroke="#ffffff">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                        <g id="SVGRepo_iconCarrier">
                                            <path d="M512 512m-480 0a480 480 0 1 0 960 0 480 480 0 1 0-960 0Z"
                                                fill="#ffeedb"></path>
                                            <path
                                                d="M678.4 780.8H345.6c-25.6 0-44.8-19.2-44.8-44.8V249.6c0-25.6 19.2-44.8 44.8-44.8h332.8c25.6 0 44.8 19.2 44.8 44.8v486.4c0 25.6-19.2 44.8-44.8 44.8z"
                                                fill="#FF9D1C"></path>
                                            <path
                                                d="M633.6 608H390.4c-19.2 0-32-12.8-32-32V294.4c0-19.2 12.8-32 32-32H640c19.2 0 32 12.8 32 32V576c-6.4 19.2-19.2 32-38.4 32z"
                                                fill="#FFCA83"></path>
                                            <path d="M512 697.6m-38.4 0a38.4 38.4 0 1 0 76.8 0 38.4 38.4 0 1 0-76.8 0Z"
                                                fill="#FFFFFF"></path>
                                        </g>
                                    </svg>
                                </a>


                                <div class="toc-container">
                                    <span>TOC</span>

                                    <a href="#">
                                        <svg fill="#ffffff" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" stroke="#ffffff">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                            </g>
                                            <g id="SVGRepo_iconCarrier">
                                                <path d="m4 3v2h11v-2zm0 6h7v-2h-7zm0 4h4v-2h-4zm-3 2h1.4v-14h-1.4z"></path>
                                            </g>
                                        </svg>

                                    </a>
                                </div>


                                <div class="dropdown bars-dropdown">
                                    <button class="btn " type="button" id="dropdownMenu2" data-bs-toggle="dropdown"
                                        aria-expanded="false" style="background:rgb(73, 70, 70);">
                                        <svg fill="#ffffff" height="200px" width="200px" version="1.1" id="Layer_1"
                                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                            viewBox="0 0 1792.00 1792.00" xml:space="preserve" stroke="#ffffff"
                                            transform="matrix(-1, 0, 0, -1, 0, 0)rotate(0)">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                            </g>
                                            <g id="SVGRepo_iconCarrier">
                                                <title>fiction</title>
                                                <path
                                                    d="M1673.9,1363.2L1673.9,1363.2c0,52.3-42.4,94.3-94.3,94.3H212.7c-52.3,0-94.3-42.4-94.3-94.3l0,0 c0-52.3,42.4-94.3,94.3-94.3h1366.8C1631.5,1268.5,1673.9,1310.9,1673.9,1363.2z">
                                                </path>
                                                <path
                                                    d="M1673.9,895.6L1673.9,895.6c0,52.3-42.4,94.3-94.3,94.3H213c-52.3,0-94.3-42.4-94.3-94.3l0,0c0-52.3,42.4-94.3,94.3-94.3 h1366.6C1631.5,800.8,1673.9,843.2,1673.9,895.6z">
                                                </path>
                                                <path
                                                    d="M1673.9,427.9L1673.9,427.9c0,52.3-42.4,94.3-94.3,94.3H212.7c-52.3,0-94.3-42.4-94.3-94.3l0,0c0-52.3,42.4-94.3,94.3-94.3 h1366.8C1631.5,333.2,1673.9,375.6,1673.9,427.9z">
                                                </path>
                                            </g>
                                        </svg>
                                    </button>
                                    <ul class="dropdown-menu bars-dropdown-menu" aria-labelledby="dropdownMenu2">
                                        <li>
                                            <a href="#" class="dropdown-item btn">TOC
                                                <svg fill="#ffffff" viewBox="0 0 16 16"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" stroke="#ffffff">
                                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                    </g>
                                                    <g id="SVGRepo_iconCarrier">
                                                        <path
                                                            d="m4 3v2h11v-2zm0 6h7v-2h-7zm0 4h4v-2h-4zm-3 2h1.4v-14h-1.4z">
                                                        </path>
                                                    </g>
                                                </svg>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#" class="dropdown-item btn">Recent
                                                <svg viewBox="0 0 24 24" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg" stroke="#ffffff">
                                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                        stroke-linejoin="round"></g>
                                                    <g id="SVGRepo_iconCarrier">
                                                        <path
                                                            d="M4 12C4 16.4183 7.58172 20 12 20C16.4183 20 20 16.4183 20 12C20 7.58172 16.4183 4 12 4C9.61061 4 7.46589 5.04751 6 6.70835C5.91595 6.80358 5.83413 6.90082 5.75463 7M12 8V12L14.5 14.5M5.75391 4.00391V7.00391H8.75391"
                                                            stroke="#ffffff" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round"></path>
                                                    </g>
                                                </svg>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#" class="dropdown-item btn">All
                                                <svg fill="#ffffff" viewBox="0 0 1920 1920"
                                                    xmlns="http://www.w3.org/2000/svg" stroke="#ffffff">
                                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                        stroke-linejoin="round"></g>
                                                    <g id="SVGRepo_iconCarrier">
                                                        <g fill-rule="evenodd">
                                                            <path
                                                                d="M1251.654 0c44.499 0 88.207 18.07 119.718 49.581l329.223 329.224c31.963 31.962 49.581 74.54 49.581 119.717V1920H169V0Zm-66.183 112.941H281.94V1807.06h1355.294V564.706H1185.47V112.94Zm112.94 23.379v315.445h315.445L1298.412 136.32Z">
                                                            </path>
                                                            <path
                                                                d="M900.497 677.67c26.767 0 50.372 12.65 67.991 37.835 41.901 59.068 38.965 121.976 23.492 206.682-5.308 29.14.113 58.617 16.263 83.125 22.814 34.786 55.68 82.673 87.981 123.219 23.718 29.93 60.198 45.854 97.13 40.885 23.718-3.276 52.292-5.986 81.656-5.986 131.012 0 121.186 46.757 133.045 89.675 6.55 25.976 3.275 48.678-10.165 65.506-16.715 22.701-51.162 34.447-101.534 34.447-55.793 0-74.202-9.487-122.767-24.96-27.445-8.81-55.906-10.617-83.69-3.275-55.453 14.456-146.936 36.48-223.284 46.983-40.772 5.647-77.816 26.654-102.438 60.875-55.454 76.8-106.842 148.518-188.273 148.518-21.007 0-40.32-7.567-56.244-22.701-23.492-23.492-33.544-49.581-28.574-79.85 13.778-92.95 128.075-144.79 196.066-182.625 16.037-8.923 28.687-22.589 36.592-39.53l107.86-233.223c7.68-16.377 10.051-34.56 7.228-52.518-12.537-79.059-31.06-211.99 18.748-272.075 10.955-13.44 26.09-21.007 42.917-21.007Zm20.556 339.953c-43.257 126.607-119.718 264.282-129.996 280.32 92.273-43.37 275.916-65.28 275.916-65.28-92.386-88.998-145.92-215.04-145.92-215.04Z">
                                                            </path>
                                                        </g>
                                                    </g>
                                                </svg>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#" class="dropdown-item btn">Previous Notes
                                                <svg fill="#ffffff" version="1.1" id="Layer_1"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512"
                                                    xml:space="preserve" stroke="#ffffff">
                                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                        stroke-linejoin="round"></g>
                                                    <g id="SVGRepo_iconCarrier">
                                                        <g>
                                                            <g>
                                                                <path
                                                                    d="M248.37,288.353l-27.119,47.05l-18.862-32.724c14.796-14.199,23.318-33.834,23.318-54.791 c0-41.93-34.113-76.043-76.043-76.043s-76.043,34.113-76.043,76.043c0,32.361,20.296,60.202,49.099,71.11L52.387,441.027h194.634 h35.107h54.24L248.37,288.353z M104.038,247.889c0-25.158,20.468-45.626,45.626-45.626s45.626,20.468,45.626,45.626 c0,9.914-3.182,19.337-8.885,27.059l-19.147-33.22l-29.017,50.343C118.483,286.993,104.038,269.044,104.038,247.889z M105.027,410.609L105.027,410.609l62.23-107.97l10.26,17.801l26.178,45.419l25.793,44.75H105.027z M264.597,410.609 l-25.793-44.75l9.565-16.596l35.359,61.345H264.597z">
                                                                </path>
                                                            </g>
                                                        </g>
                                                        <g>
                                                            <g>
                                                                <rect x="98.592" y="66.401" width="191.567"
                                                                    height="30.417"></rect>
                                                            </g>
                                                        </g>
                                                        <g>
                                                            <g>
                                                                <rect x="120.341" y="117.096" width="148.071"
                                                                    height="30.417"></rect>
                                                            </g>
                                                        </g>
                                                        <g>
                                                            <g>
                                                                <path
                                                                    d="M501.715,10.293c-13.702-13.703-35.997-13.703-49.699,0l-63.27,63.27V0H0.008v512h388.738V172.96L501.715,59.991 C515.417,46.29,515.417,23.995,501.715,10.293z M30.426,481.583V30.417H358.33v73.563L235.312,226.997v49.699h49.699 l73.319-73.319v278.206H30.426z M388.748,129.944L388.748,129.944L272.411,246.279h-6.682v-6.682L388.747,116.58l45.657-45.657 l6.683,6.683L388.748,129.944z M480.207,38.484l-17.614,17.614l-6.683-6.683l17.614-17.614c1.842-1.841,4.839-1.841,6.683,0 C482.049,33.643,482.049,36.641,480.207,38.484z">
                                                                </path>
                                                            </g>
                                                        </g>
                                                    </g>
                                                </svg>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#" class="dropdown-item btn">Migrated Notes
                                                <svg fill="#ffffff" version="1.1" id="Layer_1"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512"
                                                    xml:space="preserve" stroke="#ffffff">
                                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                        stroke-linejoin="round"></g>
                                                    <g id="SVGRepo_iconCarrier">
                                                        <g>
                                                            <g>
                                                                <path
                                                                    d="M248.37,288.353l-27.119,47.05l-18.862-32.724c14.796-14.199,23.318-33.834,23.318-54.791 c0-41.93-34.113-76.043-76.043-76.043s-76.043,34.113-76.043,76.043c0,32.361,20.296,60.202,49.099,71.11L52.387,441.027h194.634 h35.107h54.24L248.37,288.353z M104.038,247.889c0-25.158,20.468-45.626,45.626-45.626s45.626,20.468,45.626,45.626 c0,9.914-3.182,19.337-8.885,27.059l-19.147-33.22l-29.017,50.343C118.483,286.993,104.038,269.044,104.038,247.889z M105.027,410.609L105.027,410.609l62.23-107.97l10.26,17.801l26.178,45.419l25.793,44.75H105.027z M264.597,410.609 l-25.793-44.75l9.565-16.596l35.359,61.345H264.597z">
                                                                </path>
                                                            </g>
                                                        </g>
                                                        <g>
                                                            <g>
                                                                <rect x="98.592" y="66.401" width="191.567"
                                                                    height="30.417"></rect>
                                                            </g>
                                                        </g>
                                                        <g>
                                                            <g>
                                                                <rect x="120.341" y="117.096" width="148.071"
                                                                    height="30.417"></rect>
                                                            </g>
                                                        </g>
                                                        <g>
                                                            <g>
                                                                <path
                                                                    d="M501.715,10.293c-13.702-13.703-35.997-13.703-49.699,0l-63.27,63.27V0H0.008v512h388.738V172.96L501.715,59.991 C515.417,46.29,515.417,23.995,501.715,10.293z M30.426,481.583V30.417H358.33v73.563L235.312,226.997v49.699h49.699 l73.319-73.319v278.206H30.426z M388.748,129.944L388.748,129.944L272.411,246.279h-6.682v-6.682L388.747,116.58l45.657-45.657 l6.683,6.683L388.748,129.944z M480.207,38.484l-17.614,17.614l-6.683-6.683l17.614-17.614c1.842-1.841,4.839-1.841,6.683,0 C482.049,33.643,482.049,36.641,480.207,38.484z">
                                                                </path>
                                                            </g>
                                                        </g>
                                                    </g>
                                                </svg>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#" class="dropdown-item btn">Draft List
                                                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                                    fill="#ffffff" stroke="#ffffff">
                                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                        stroke-linejoin="round"></g>
                                                    <g id="SVGRepo_iconCarrier">
                                                        <g>
                                                            <path fill="none" d="M0 0L24 0 24 24 0 24z"></path>
                                                            <path
                                                                d="M20 2c.552 0 1 .448 1 1v3.757l-2 2V4H5v16h14v-2.758l2-2V21c0 .552-.448 1-1 1H4c-.552 0-1-.448-1-1V3c0-.552.448-1 1-1h16zm1.778 6.808l1.414 1.414L15.414 18l-1.416-.002.002-1.412 7.778-7.778zM13 12v2H8v-2h5zm3-4v2H8V8h8z">
                                                            </path>
                                                        </g>
                                                    </g>
                                                </svg>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#" class="dropdown-item btn">Draft Document
                                                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                                    fill="#ffffff" stroke="#ffffff">
                                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                        stroke-linejoin="round"></g>
                                                    <g id="SVGRepo_iconCarrier">
                                                        <g>
                                                            <path fill="none" d="M0 0L24 0 24 24 0 24z"></path>
                                                            <path
                                                                d="M20 2c.552 0 1 .448 1 1v3.757l-2 2V4H5v16h14v-2.758l2-2V21c0 .552-.448 1-1 1H4c-.552 0-1-.448-1-1V3c0-.552.448-1 1-1h16zm1.778 6.808l1.414 1.414L15.414 18l-1.416-.002.002-1.412 7.778-7.778zM13 12v2H8v-2h5zm3-4v2H8V8h8z">
                                                            </path>
                                                        </g>
                                                    </g>
                                                </svg>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#" class="dropdown-item btn">References
                                                <svg fill="#ffffff" height="200px" width="200px" version="1.1"
                                                    id="XMLID_195_" xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 24 24"
                                                    xml:space="preserve" stroke="#ffffff">
                                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                        stroke-linejoin="round"></g>
                                                    <g id="SVGRepo_iconCarrier">
                                                        <g id="notes">
                                                            <g>
                                                                <path
                                                                    d="M16.4,24H2V0h20v18.4L16.4,24z M4,22h10v-6h6V2H4v2h16v2H4V22z M16,18v3.6l3.6-3.6H16z M11,18H6v-2h5V18z M18,14H6v-2h12 V14z M16,10H6V8h10V10z">
                                                                </path>
                                                            </g>
                                                        </g>
                                                    </g>
                                                </svg>
                                            </a>
                                        </li>

                                    </ul>

                                </div>
                            </div>



                            {{-- <div class="dropdown ">
                                <button class="btn btn-secondary dropdown-toggle mt-0 p-1" type="button"
                                    id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ __('All') }}
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li><a class="dropdown-item" href="#"
                                            id="shownotes">{{ __('Previous Notes') }}</a></li>
                                    <li><a class="dropdown-item" href="#"
                                            id="file">{{ __('Document Details') }}</a></li>
                                </ul>
                            </div> --}}
                        </div>


                        <div class="corespondense-card-body h-66" id="toc" style="padding-left:0px;">

                            <div class="table-responsive" style="overflow-y:scroll !important;">
                                {{ $dataTable->table() }}
                            </div>

                            <div class="d-flex justify-content-end mt-3 p-3">
                                <button class="btn font-bold text-light" style="background: #ab6c14;"
                                    data-bs-toggle="modal" data-bs-target="#attachReceiptModal">Add Receipt</button>
                            </div>

                            <br>
                            {{-- code by sumit ends  --}}

                        </div>

                        {{-- Recent Section --}}
                        <div class="corespondense-card-body h-66" id="recent-section"
                            style="padding-left:0px; display:none;">
                            <div class="table-responsive" style="overflow-y:scroll !important;">
                                <table class="table table-bordered table-hover">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Receipt/Issue No</th>
                                            <th>Subject</th>
                                            <th>Attachment</th>
                                            <th>Issue On</th>
                                            <th>Remarks</th>
                                            <th>Created By</th>
                                            <th>Created At</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($correspondence as $correspondences)
                                            @if ($correspondences->receipt_id != null && $correspondences->created_at >= now()->subDays(7))
                                                <tr>
                                                    <td>{{ $correspondences->receipt->letter_ref_no ?? 'N/A' }}</td>
                                                    <td>{{ $correspondences->receipt->subject ?? 'N/A' }}</td>
                                                    <td>{{ $correspondences->receipt->receved_date ?? 'N/A' }}</td>
                                                    <td>{{ $correspondences->receipt->dairy_date ?? 'N/A' }}</td>
                                                    <td>{{ $correspondences->receipt->remarks ?? 'N/A' }}</td>
                                                    <td>{{ $correspondences->creator->name ?? 'N/A' }}</td>
                                                    <td>{{ $correspondences->created_at->format('d-m-Y H:i:s') }}</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>

                        {{-- All Section --}}
                        <div class="corespondense-card-body h-66" id="all-section"
                            style="padding-left:0px; display:none; flex-direction: column;">
                            @php
                                $receipts = $correspondence->where('receipt_id', '!=', null);
                            @endphp
                            @if ($receipts->count() > 0)
                                <div style="flex-grow: 1; overflow: auto;">
                                    <object data="{{ route('file.mergeReceipts', $file->id) }}" type="application/pdf"
                                        width="100%" height="100%">
                                        <p>Your browser does not support PDFs. <a
                                                href="{{ route('file.mergeReceipts', $file->id) }}">Download the PDF</a>.
                                        </p>
                                    </object>
                                </div>
                            @else
                                <div class="d-flex align-items-center justify-content-center" style="flex-grow: 1;">
                                    <div class="alert alert-info">No receipts found.</div>
                                </div>
                            @endif

                        </div>

                        {{-- Previous Notes Section --}}
                        <div class="corespondense-card-body h-66" id="previous-notes-section"
                            style="padding-left:0px; display:none;">
                            <div class="table-responsive" style="overflow-y:scroll !important;">
                                <table class="table table-bordered table-hover">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Notes Description</th>
                                            <th>Created By</th>
                                            <th>Created At</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($correspondence as $correspondences)
                                            @if ($correspondences->notes_id != null)
                                                <tr>
                                                    <td>{!! $correspondences->notes->description ?? 'N/A' !!}</td>
                                                    <td>{{ $correspondences->creator->name ?? 'N/A' }}</td>
                                                    <td>{{ $correspondences->created_at->format('d-m-Y H:i:s') }}</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>

                        {{-- Migrated Notes Section --}}
                        <div class="corespondense-card-body h-66" id="migrated-notes-section"
                            style="padding-left:0px; display:none;">
                            <div class="table-responsive" style="overflow-y:scroll !important;">
                                <table class="table table-bordered table-hover">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Migrated Notes</th>
                                            <th>Created By</th>
                                            <th>Created At</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($greennote as $greennotes)
                                            <tr>
                                                <td>{!! $greennotes->description !!}</td>
                                                <td>{{ $greennotes->user->name ?? 'N/A' }}</td>
                                                <td>{{ $greennotes->created_at->format('d-m-Y H:i:s') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>

                        {{-- Draft List Section --}}
                        <div class="corespondense-card-body h-66" id="draft-list-section"
                            style="padding-left:0px; display:none;">
                            <div class="table-responsive" style="overflow-y:scroll !important;">
                                <table class="table table-bordered table-hover">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Draft Title</th>
                                            <th>Status</th>
                                            <th>Created By</th>
                                            <th>Created At</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td colspan="4" class="text-center">No drafts available</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>

                        {{-- Draft Document Section --}}
                        <div class="corespondense-card-body h-66" id="draft-document-section"
                            style="padding-left:0px; display:none;">
                            <div class="table-responsive" style="overflow-y:scroll !important;">
                                <table class="table table-bordered table-hover">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Document Name</th>
                                            <th>Type</th>
                                            <th>Created By</th>
                                            <th>Created At</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($correspondence as $correspondences)
                                            @if ($correspondences->doc_id != null)
                                                <tr>
                                                    <td>{{ $correspondences->document->document_name ?? 'N/A' }}</td>
                                                    <td>{{ $correspondences->document->dtype ?? 'N/A' }}</td>
                                                    <td>{{ $correspondences->creator->name ?? 'N/A' }}</td>
                                                    <td>{{ $correspondences->created_at->format('d-m-Y H:i:s') }}</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>

                        {{-- References Section --}}
                        <div class="corespondense-card-body h-66" id="references-section"
                            style="padding-left:0px; display:none;">
                            <div class="table-responsive" style="overflow-y:scroll !important;">
                                <table class="table table-bordered table-hover">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Reference Type</th>
                                            <th>Reference Details</th>
                                            <th>Created By</th>
                                            <th>Created At</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td colspan="4" class="text-center">No references available</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>

        {{-- Attach Receipt Modal --}}
        <div class="modal fade" id="attachReceiptModal" tabindex="-1" aria-labelledby="attachReceiptModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header text-light" style="background: #2e75bb !important;">
                        <h5 class="modal-title" id="attachReceiptModalLabel">Attach Receipt(s)</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                {{-- Left Panel: Available Receipts --}}
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <b>Receipt(s)</b>
                                    <div class="d-flex gap-1">
                                        <select class="form-control form-control-sm" id="year-filter"
                                            style="width:100px;">
                                            <option value="2024">2024</option>
                                            {{-- Add other years if needed --}}
                                        </select>
                                        <input type="text" class="form-control form-control-sm"
                                            id="receipt-search-input" placeholder="Search Here...">
                                    </div>
                                </div>
                                <div class="table-responsive" style="max-height: 300px; overflow-y: auto;">
                                    <table class="table table-bordered" id="available-receipts-table">
                                        <thead class="table-primary">
                                            <tr>
                                                <th><input type="checkbox" id="select-all-receipts"></th>
                                                <th>Nature</th>
                                                <th>Comp. No.</th>
                                                <th>Receipt No.</th>
                                                <th>Subject</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($availableReceipts as $receipts)
                                                <tr data-id="{{ $receipts->id }}">
                                                    <td><input type="checkbox" class="receipt-checkbox"
                                                            value="{{ $receipts->id }}"></td>
                                                    @php
                                                        $nature = $receipts->receipt_status;
                                                        if ($nature === 'Electronics') {
                                                            $nature = 'E';
                                                        } elseif ($nature === 'Physical') {
                                                            $nature = 'P';
                                                        } else {
                                                            $nature = 'Null';
                                                        }
                                                    @endphp
                                                    <td>{{ $nature }}</td>
                                                    <td>{{ $receipts->computer_number ?? 'Null' }}</td>
                                                    <td>{{ $receipts->letter_ref_no ?? 'Null' }}</td>
                                                    <td>{{ $receipts->subject ?? 'Null' }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            <div class="col-md-6">
                                {{-- Right Panel: Selected Receipts --}}
                                <b>Selected Receipt(s)</b>
                                <div class="table-responsive" style="max-height: 300px; overflow-y: auto;">

                                    <table class="table table-bordered" id="selected-receipts-table">
                                        <thead class="table-primary">
                                            <tr>
                                                <th>Nature</th>
                                                <th>Comp. No.</th>
                                                <th>Receipt No.</th>
                                                <th>Subject</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {{-- Selected receipts will be added here --}}
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <label for="remarks">Remarks <span class="text-danger">*</span></label>
                                <textarea id="remarks" class="form-control" name="attachreceiptremark" rows="3" maxlength="1000"
                                    placeholder="Enter Remark"></textarea>
                                <small id="remarks-char-count">Total 1000 | 1000 Character left</small>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn text-light" style="background: #dd932c !important;"
                            id="attach-receipt-btn-modal">Attach</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- End Attach Receipt Modal --}}
    </div>
    <style>
        #resizable-container {
            min-width: 400px;
            max-width: 100vw;
            height: 70vh;
            background: #f8f9fa;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
            overflow: hidden;
        }

        #divider {
            min-width: 16px;
            max-width: 24px;
            background: #eee;
            cursor: ew-resize;
            user-select: none;
            z-index: 10;
            transition: background 0.2s;
        }

        #divider:hover span {
            background: #ffe066;
            border-color: #e0c97f;
        }

        #divider span {
            margin: 0 auto;
            transition: background 0.2s, border-color 0.2s;
        }

        #left-panel,
        #right-panel {
            transition: flex-basis 0.2s, width 0.2s;
            overflow-y: hidden;
            overflow-x: hidden;
        }

        @media (max-width: 900px) {
            #resizable-container {
                flex-direction: column;
                height: auto;
            }

            #divider {
                display: none;
            }

            #left-panel,
            #right-panel {
                min-width: 100px;
                width: 100% !important;
            }
        }

        .expand-btn {
            position: absolute;
            top: 8px;
            right: 8px;
            z-index: 20;
            background: #fffbe6;
            border: 1px solid #e0c97f;
            border-radius: 50%;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 1px 4px #ccc;
        }

        #left-panel,
        #right-panel {
            position: relative;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="{{ asset('assets/ckeditor/ckeditor.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.all.min.js"></script>
    {{-- <script type="text/javascript" src="https://cdn.datatables.net/select/1.3.4/js/dataTables.select.min.js"></script> --}}

    {{ $dataTable->scripts() }}

    <script>
        $(document).ready(function() {
            CKEDITOR.replace('ydescription');

            // Resizable divider logic
            const container = document.getElementById('resizable-container');
            const left = document.getElementById('left-panel');
            const right = document.getElementById('right-panel');
            const divider = document.getElementById('divider');
            let isDragging = false;

            divider.addEventListener('mousedown', function(e) {
                isDragging = true;
                document.body.style.cursor = 'ew-resize';
                document.body.style.userSelect = 'none';
            });
            document.addEventListener('mousemove', function(e) {
                if (!isDragging) return;
                const rect = container.getBoundingClientRect();
                let offsetX = e.clientX - rect.left;
                // Minimum and maximum widths
                const min = 180;
                const max = rect.width - 180;
                if (offsetX < min) offsetX = min;
                if (offsetX > max) offsetX = max;
                left.style.flex = 'none';
                right.style.flex = 'none';
                left.style.width = offsetX + 'px';
                right.style.width = (rect.width - offsetX - divider.offsetWidth) + 'px';
            });
            document.addEventListener('mouseup', function(e) {
                if (isDragging) {
                    isDragging = false;
                    document.body.style.cursor = '';
                    document.body.style.userSelect = '';
                }
            });

            // Function to hide all sections
            function hideAllSections() {
                $('#toc, #recent-section, #all-section, #previous-notes-section, #migrated-notes-section, #draft-list-section, #draft-document-section, #references-section')
                    .hide();
            }

            // Function to show specific section
            function showSection(sectionId) {
                hideAllSections();
                if (sectionId === 'all-section') {
                    $('#' + sectionId).css('display', 'flex');
                } else {
                    $('#' + sectionId).show();
                }
            }

            // Dropdown click handlers
            $('.bars-dropdown-menu .dropdown-item').on('click', function(e) {
                e.preventDefault();
                const text = $(this).text().trim();
                const svg = $(this).find('svg').clone();

                let ctext;
                if ($(this).text().trim() === 'TOC') {
                    ctext = 'Table of Correspondences (TOC)';
                } else {
                    ctext = $(this).text().trim();
                }
                // Update the TOC container only
                $('.toc-container span').text(text);
                $('.toc-container a svg').replaceWith(svg);
                $('.left-part h5').text(ctext);
                // Show appropriate section based on selection
                switch (text) {
                    case 'TOC':
                        showSection('toc');
                        break;
                    case 'Recent':
                        showSection('recent-section');
                        break;
                    case 'All':
                        showSection('all-section');
                        break;
                    case 'Previous Notes':
                        showSection('previous-notes-section');
                        break;
                    case 'Migrated Notes':
                        showSection('migrated-notes-section');
                        break;
                    case 'Draft List':
                        showSection('draft-list-section');
                        break;
                    case 'Draft Document':
                        showSection('draft-document-section');
                        break;
                    case 'References':
                        showSection('references-section');
                        break;
                    default:
                        showSection('toc'); // Default to TOC
                }
            });

            // TOC container click handler
            $('.toc-container a').on('click', function(e) {
                e.preventDefault();
                showSection('toc');
                $('.toc-container span').text('TOC');
                // Reset to original TOC SVG
                $('.toc-container a svg').replaceWith(`
                        <svg fill="#ffffff" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" stroke="#ffffff">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                            </g>
                            <g id="SVGRepo_iconCarrier">
                                <path d="m4 3v2h11v-2zm0 6h7v-2h-7zm0 4h4v-2h-4zm-3 2h1.4v-14h-1.4z"></path>
                            </g>
                        </svg>
                    `);
            });

            let expanded = null; // 'left', 'right', or null

            $('#expand-left').on('click', function() {
                if (expanded === 'left') {
                    // Restore
                    $('#left-panel').css({
                        width: '',
                        flex: '1 1 0'
                    });
                    $('#right-panel').css({
                        width: '',
                        flex: '1 1 0',
                        display: ''
                    });
                    $('#divider').show();
                    $(this).find('i').removeClass('fa-compress').addClass('fa-expand');
                    expanded = null;
                } else {
                    // Expand left
                    $('#left-panel').css({
                        width: 'calc(100% - 16px)',
                        flex: 'none'
                    });
                    $('#right-panel').css({
                        display: 'none'
                    });
                    $('#divider').hide();
                    $(this).find('i').removeClass('fa-expand').addClass('fa-compress');
                    $('#expand-right').find('i').removeClass('fa-compress').addClass('fa-expand');
                    expanded = 'left';
                }
            });

            $('#expand-right').on('click', function() {
                if (expanded === 'right') {
                    // Restore
                    $('#right-panel').css({
                        width: '',
                        flex: '1 1 0'
                    });
                    $('#left-panel').css({
                        width: '',
                        flex: '1 1 0',
                        display: ''
                    });
                    $('#divider').show();
                    $(this).find('i').removeClass('fa-compress').addClass('fa-expand');
                    expanded = null;
                } else {
                    // Expand right
                    $('#right-panel').css({
                        width: 'calc(100% - 16px)',
                        flex: 'none'
                    });
                    $('#left-panel').css({
                        display: 'none'
                    });
                    $('#divider').hide();
                    $(this).find('i').removeClass('fa-expand').addClass('fa-compress');
                    $('#expand-left').find('i').removeClass('fa-compress').addClass('fa-expand');
                    expanded = 'right';
                }
            });


            // New modal logic for attaching receipts
            function updateSelectedReceiptsTable() {
                $('#selected-receipts-table tbody').empty();
                $('#available-receipts-table tbody tr:hidden').each(function() {
                    const id = $(this).data('id');
                    const nature = $(this).find('td:eq(1)').text();
                    const compNo = $(this).find('td:eq(2)').text();
                    const receiptNo = $(this).find('td:eq(3)').text();
                    const subject = $(this).find('td:eq(4)').text();

                    const newRow = `
                    <tr data-id="${id}">
                        <td>${nature}</td>
                        <td>${compNo}</td>
                        <td>${receiptNo}</td>
                        <td>${subject}</td>
                        <td>
                            <div style="display: flex; gap: 1px; align-items: center;">
                                <button class="btn btn-sm btn-link move-up"><i class="bi bi-arrow-up" style="color: #ab6c14;"></i></button>
                                <button class="btn btn-sm btn-link move-down"><i class="bi bi-arrow-down" style="color: #ab6c14;"></i></button>
                                <button class="btn btn-sm btn-link remove-receipt text-danger"><i class="bi bi-x-lg"></i></button>
                            </div>
                        </td>
                    </tr>
                `;
                    $('#selected-receipts-table tbody').append(newRow);
                });
            }

            $('#available-receipts-table').on('change', '.receipt-checkbox', function() {
                const row = $(this).closest('tr');
                if (this.checked) {
                    row.hide();
                } else {
                    row.show();
                }
                updateSelectedReceiptsTable();
            });

            $('#select-all-receipts').on('change', function() {
                const isChecked = $(this).prop('checked');
                $('#available-receipts-table .receipt-checkbox').prop('checked', isChecked).trigger(
                    'change');
            });

            $('#selected-receipts-table').on('click', '.remove-receipt', function() {
                const row = $(this).closest('tr');
                const id = row.data('id');
                row.remove();
                const availableRow = $(`#available-receipts-table tr[data-id="${id}"]`);
                availableRow.show();
                availableRow.find('.receipt-checkbox').prop('checked', false);
            });

            $('#selected-receipts-table').on('click', '.move-up', function() {
                const row = $(this).closest('tr');
                row.prev().before(row);
            });

            $('#selected-receipts-table').on('click', '.move-down', function() {
                const row = $(this).closest('tr');
                row.next().after(row);
            });

            $('#receipt-search-input').on('keyup', function() {
                const value = $(this).val().toLowerCase();
                $("#available-receipts-table tbody tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });

            // Attach button click handler
            $('#attach-receipt-btn-modal').off('click').on('click', function() {
                const selectedIds = [];
                selectedTable.rows().every(function() {
                    const $row = $(this.node());
                    selectedIds.push($row.data('id'));
                });

                if (selectedIds.length === 0) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'No Receipts Selected',
                        text: 'Please select at least one receipt.',
                        confirmButtonColor: '#2e75bb'
                    });
                    return;
                }

                const remarks = $('#remarks').val();
                if (!remarks) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Remarks Required',
                        text: 'Please enter remarks.',
                        confirmButtonColor: '#2e75bb'
                    });
                    return;
                }

                // Disable the button to prevent double submission
                $(this).prop('disabled', true);

                // Show loading state
                Swal.fire({
                    title: 'Attaching Receipts',
                    text: 'Please wait...',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    willOpen: () => {
                        Swal.showLoading();
                    }
                });

                $.ajax({
                    url: '{{ route('correspondance.store') }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        receipt_id: selectedIds,
                        file_id: '{{ $file->id }}',
                        remarks: remarks
                    },
                    success: function(response) {
                        // Show success message
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: 'Receipts attached successfully!',
                            confirmButtonColor: '#2e75bb'
                        }).then((result) => {
                            // Clear the modal
                            $('#attachReceiptModal').modal('hide');

                            // Clear the selected table
                            selectedTable.clear().draw();

                            // Clear remarks
                            $('#remarks').val('');
                            $('#remarks-char-count').text(
                                'Total 1000 | 1000 Character left');

                            // Refresh the main table
                            if (typeof window.LaravelDataTables !== 'undefined' &&
                                window.LaravelDataTables.dataTableBuilder) {
                                window.LaravelDataTables.dataTableBuilder.ajax.reload();
                            } else {
                                location.reload(); // Fallback to page reload
                            }
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error('Error attaching receipts:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'An error occurred while attaching receipts.',
                            confirmButtonColor: '#2e75bb'
                        });
                    },
                    complete: function() {
                        // Re-enable the button
                        $('#attach-receipt-btn-modal').prop('disabled', false);
                    }
                });
            });

            // Clean up modal on hide
            $('#attachReceiptModal').on('hidden.bs.modal', function() {
                // Clear selected table
                if (typeof selectedTable !== 'undefined') {
                    selectedTable.clear().draw();
                }

                // Reset available table checkboxes
                $('#select-all-receipts').prop('checked', false);
                $('.receipt-checkbox').prop('checked', false);

                // Clear remarks
                $('#remarks').val('');
                $('#remarks-char-count').text('Total 1000 | 1000 Character left');

                // Re-enable the attach button if it was disabled
                $('#attach-receipt-btn-modal').prop('disabled', false);
            });

            // Character count for remarks textarea
            const maxChars = 1000;
            $('#remarks').on('input', function() {
                const currentLength = $(this).val().length;
                const charsLeft = maxChars - currentLength;
                $('#remarks-char-count').text(`Total 1000 | ${charsLeft} Character left`);
            });

            // Initialize Available Receipts DataTable
            const availableTable = $('#available-receipts-table').DataTable({
                pageLength: 5,
                lengthMenu: [
                    [5, 10, 25, -1],
                    [5, 10, 25, "All"]
                ],
                dom: '<"top"fl>rt<"bottom"ip>',
                order: [
                    [2, 'asc']
                ], // Sort by Comp. No by default
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search Here..."
                },
                columnDefs: [{
                    targets: 0,
                    orderable: false,
                    // Remove the select-checkbox class
                    className: 'text-center' // Just center align the checkbox column
                }]
            });

            // Initialize Selected Receipts DataTable
            const selectedTable = $('#selected-receipts-table').DataTable({
                pageLength: 5,
                lengthMenu: [
                    [5, 10, 25, -1],
                    [5, 10, 25, "All"]
                ],
                dom: '<"top"fl>rt<"bottom"ip>',
                order: [
                    [1, 'asc']
                ], // Sort by Comp. No by default
            });

            // Handle checkbox changes
            $('#available-receipts-table').on('change', '.receipt-checkbox', function() {
                const row = $(this).closest('tr');
                if (this.checked) {
                    const rowData = availableTable.row(row).data();
                    const id = row.data('id');

                    // Create new row for selected table
                    const newRow = [
                        rowData[1], // Nature
                        rowData[2], // Comp. No
                        rowData[3], // Receipt No
                        rowData[4], // Subject
                        `<div style="display: flex; gap: 1px; align-items: center;">
                                <button class="btn btn-sm btn-link move-up"><i class="bi bi-arrow-up" style="color: #ab6c14;"></i></button>
                                <button class="btn btn-sm btn-link move-down"><i class="bi bi-arrow-down" style="color: #ab6c14;"></i></button>
                                <button class="btn btn-sm btn-link remove-receipt text-danger"><i class="bi bi-x-lg"></i></button>
                            </div>`
                    ];

                    const newTr = selectedTable.row.add(newRow).draw().node();
                    $(newTr).attr('data-id', id);

                    // Hide row in available table
                    availableTable.row(row).remove().draw();
                }
            });

            // Handle "Select All" checkbox
            $('#select-all-receipts').on('change', function() {
                const isChecked = $(this).prop('checked');
                if (isChecked) {
                    availableTable.rows().every(function() {
                        const $row = $(this.node());
                        const checkbox = $row.find('.receipt-checkbox');
                        if (!checkbox.prop('checked')) {
                            checkbox.prop('checked', true).trigger('change');
                        }
                    });
                }
            });

            // Handle remove receipt
            $('#selected-receipts-table').on('click', '.remove-receipt', function() {
                const row = $(this).closest('tr');
                const id = row.data('id');

                // Get the original row data
                const rowData = selectedTable.row(row).data();

                // Create new row for available table
                const newRow = [
                    `<input type="checkbox" class="receipt-checkbox" value="${id}">`,
                    rowData[0], // Nature
                    rowData[1], // Comp. No
                    rowData[2], // Receipt No
                    rowData[3] // Subject
                ];

                const newTr = availableTable.row.add(newRow).draw().node();
                $(newTr).attr('data-id', id);

                // Remove from selected table
                selectedTable.row(row).remove().draw();
            });

            // Handle move up/down
            $('#selected-receipts-table').on('click', '.move-up, .move-down', function() {
                const row = $(this).closest('tr');
                const table = selectedTable;

                if ($(this).hasClass('move-up')) {
                    if (row.prev().length) {
                        row.insertBefore(row.prev());
                    }
                } else {
                    if (row.next().length) {
                        row.insertAfter(row.next());
                    }
                }

                table.draw(false);
            });

            // Override the default search box
            $('#receipt-search-input').on('keyup', function() {
                availableTable.search(this.value).draw();
            });

            // Year filter
            $('#year-filter').on('change', function() {
                availableTable.draw();
            });
        });
    </script>
    <script>
        // Include jQuery library in your HTML
        $(document).ready(function() {
            $('#category').change(function() {
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
                        $('#subcategory').append(
                            '<option value="">Select Subcategory</option>');
                        $.each(subcategories, function(index, subcategory) {
                            $('#subcategory').append('<option value="' + subcategory
                                .id + '">' + subcategory.name + '</option>');
                        });
                    },
                    error: function(xhr, status, error) {

                    }
                });
            });
            $('#subcategory').change(function() {
                var sub_id = $(this).val();
                $.ajax({
                    url: "{{ url('get-template') }}",
                    type: 'GET',
                    data: {
                        sub_id: sub_id,
                    },
                    success: function(response) {
                        console.log(response);
                        var subcategory = response;
                        $('#template').empty();
                        $('#template').append('<option value="">Select Template</option>');
                        $.each(subcategory, function(index, subcategory) {
                            $('#template').append('<option value="' + subcategory.id +
                                '">' + subcategory.title + '</option>');
                        });
                    },
                    error: function(xhr, status, error) {

                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            var tdescriptionInstance = CKEDITOR.replace('gdescription');
            $('#upload').click(function() {
                $('#uploadtemplate').toggleClass('d-none');
            });
            $('#template').change(function() {
                var tem_id = $(this).val();
                $.ajax({
                    url: "{{ url('get-description') }}",
                    type: 'GET',
                    data: {
                        tem_id: tem_id
                    },
                    success: function(response) {
                        if (response.description) {
                            tdescriptionInstance.setData(response.description);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching data:', error);
                    }
                });
            });
        });
    </script>
    <script>
        function refreshPage() {
            window.location.reload();
        }
    </script>
    <script>
        function updateSelectAllCheckbox() {
            var allChecked = true;
            var anyChecked = false;
            $('.correspondence-checkbox').each(function() {
                if (!$(this).prop('checked')) {
                    allChecked = false;
                } else {
                    anyChecked = true;
                }
            });
            $('.select-all-checkbox').prop('checked', allChecked && anyChecked);
        }

        $(document).on('click', '.select-all-checkbox', function() {
            $('.correspondence-checkbox').prop('checked', $(this).prop('checked'));
        });

        $(document).on('click', '.correspondence-checkbox', function() {
            updateSelectAllCheckbox();
        });

        // On DataTable redraw, update the select-all checkbox state
        $(document).on('draw.dt', function() {
            updateSelectAllCheckbox();
        });

        $(document).on('click', '.dropdown-toggle', function(e) {
            e.stopPropagation();
            var $menu = $(this).siblings('.dropdown-menu');
            $('.dropdown-menu').not($menu).hide(); // Hide other open menus
            $menu.toggle();
        });

        $(document).on('click', function() {
            $('.dropdown-menu').hide(); // Hide dropdown when clicking outside
        });

        // Function to get selected IDs
        window.getSelectedIds = function() {
            var selectedIds = [];
            $('.correspondence-checkbox:checked').each(function() {
                selectedIds.push($(this).val());
            });
            return selectedIds;
        }
    </script>
@endsection
