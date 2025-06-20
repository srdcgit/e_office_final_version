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
        <a href=""><button class="btn btnn  btn-sm shadow-sm">Send</button></a>

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
                    style="flex: 1 1 0; min-width: 200px; background: #f6fff6; transition: flex-basis 0.2s;">
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
            <li><a class="dropdown-item" href="#" id="showReceipt">{{ __('Receipt') }}</a>
            </li>
            <li><a class="dropdown-item" href="#"
                    id="shownotes">{{ __('Previous Notes') }}</a></li>
            <li><a class="dropdown-item" href="#"
                    id="file">{{ __('Document Details') }}</a></li>
        </ul>
    </div> --}}
                        </div>


                        <div class="corespondense-card-body h-66" style="padding-left:0px;">

                            <div id="table">
                                <table class="table table-bordered table-hover">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>

                                                <div class="btn-group">
                                                    <button class="btn" id="dropdownMenuButton2"
                                                        style="background:#0a5fa0; padding-right:0px;">
                                                        <input type="checkbox" class="form-check-input" value=""
                                                            id="checkboxall">
                                                    </button>
                                                    <button type="button"
                                                        class="btn dropdown-toggle dropdown-toggle-split"
                                                        data-bs-toggle="dropdown" aria-expanded="false"
                                                        style="background:#0a5fa0;">
                                                        <span class="visually-hidden">Toggle Dropdown</span>
                                                    </button>
                                                    <ul class="dropdown-menu"
                                                        style="background:white; border:1px solid rgb(196, 196, 196);">
                                                        <li><a class="dropdown-item" href="#">Mark as PUC</a></li>
                                                        <li><a class="dropdown-item" href="#">Mark as FR</a>
                                                        </li>
                                                        <li><a class="dropdown-item" href="#">Unmark</a></li>
                                                        <li><a class="dropdown-item" href="#">Detach</a></li>
                                                        <li><a class="dropdown-item" href="#">Close</a></li>
                                                    </ul>
                                                </div>

                                            </th>
                                            <th></th>
                                            <th>Receipt/Issue No</th>
                                            <th>Subject</th>
                                            <th>Attachment</th>
                                            <th>Issue On</th>
                                            <th>Remarks</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @foreach ($correspondence as $correspondences)
                    @if ($correspondences->receipt_id != null)
                        <tr>
                            <td>{{ $correspondences->receipt->dairy_date }}</td>
                            <td>{{ $correspondences->receipt->subject }}</td>
                            <td>{{ $correspondences->receipt->receved_date }}</td>
                            <td>{{ $correspondences->receipt->letter_ref_no }}</td>
                            <td>{{ $correspondences->receipt->remarks }}</td>
                        </tr>
                    @endif
                @endforeach --}}
                                    </tbody>
                                </table>
                            </div>


                            {{-- code by sumit ends  --}}

                        </div>
                    </div>
                </div>
            </div>
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

                // Existing dropdown functionality
                $('#showReceipt').on('click', function(event) {
                    event.preventDefault();
                    $('#receipttable').show();
                    $('#table').hide();
                    $('#add').show();
                    $('#reload').hide();
                    $('#documenttable').hide();
                    $('#notesttable').hide();
                    $('#greenNotesSection').hide();
                    $('#filettable').hide();
                });
                $('#shownotes').on('click', function(event) {
                    event.preventDefault();
                    $('#receipttable').hide();
                    $('#add').hide();
                    $('#table').hide();
                    $('#reload').hide();
                    $('#documenttable').hide();
                    $('#notesttable').hide();
                    $('#greenNotesSection').show();
                    $('#filettable').hide();
                });
                $('#file').on('click', function(event) {
                    event.preventDefault();
                    $('#receipttable').hide();
                    $('#add').show();
                    $('#table').hide();
                    $('#reload').show();
                    $('#documenttable').hide();
                    $('#notesttable').hide();
                    $('#filettable').show();
                    $('#greenNotesSection').hide();
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
    @endsection
