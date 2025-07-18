@extends('layouts.fileLayout')
@section('title', __('View File '))
@section('breadcrumb')
<ul class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Dashboard') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('file.index') }}">{{ __('File') }}</a></li>
    <li class="breadcrumb-item">{{ __('View') }}
    </li>
</ul>
@endsection
@php use App\Models\Fileshare; @endphp
@section('file_content')
<div class="row">
    <div class="section-body">
        <div class="col-md-12 m-auto">
            <div class="card">
                <div class="card-header">
                    <h5>{{ __('View File') }}</h5>
                </div>
                <div class="share-view-card-body">
                    <div class="row" id="create-options">
                        <div class="col-md-6">
                            <div class="row">
                                <h5>File Description</h5>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">File Name</label>
                                        <input type="text" class="form-control"
                                            value="{{ $viewfile->files->file_name }}" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Department Name</label>
                                        <input type="text" class="form-control"
                                            value="{{ $viewfile->department->name ?? 'null' }}" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Section Name</label>
                                        <input type="text" class="form-control"
                                            value="{{ $viewfile->section->name ?? 'null' }}" disabled>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Notify</label>
                                        <input type="text" class="form-control" value="{{ $viewfile->notifyby }}"
                                            disabled>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">DueDate</label>
                                        <input type="text" class="form-control" value="{{ $viewfile->duedate }}"
                                            disabled>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Priority</label>
                                        <input type="text" class="form-control" value="{{ $viewfile->priority }}"
                                            disabled>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Remarks</label>
                                        <input type="text" class="form-control" value="{{ $viewfile->remarks }}"
                                            disabled>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6">
                            @if ($notes != null && $viewfile->actiontype == Fileshare::VIEW )
                            <div class="form-group" style="background-color:#CCFFCC;margin-bottom:20px">
                                <div
                                    style="color:#339933;font-size:20px;text-align:center;border-bottom:1px solid #c0c0c0">
                                    Green Notes:</div><br>
                                <label for="">{!! $notes->description !!}</label>
                            </div>
                            @else
                            <div class="card">
                                @if ($notes != null && Route::currentRouteName() == 'file.view' )
                                <div class="card-header">
                                    <h5>{{ __('Green Notes') }}</h5>
                                </div>
                                @else
                                <div class="card-header">
                                    <h5>{{ __('File Created') }}</h5>
                                </div>
                                @endif
                                {{ Form::open(['route' => 'store.notes', 'method' => 'post']) }}
                                <div class="card-body">
                                    <input type="hidden" name="file_id" value="{{ $file->id }}">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#greenNotesTab">{{ __('Green Notes') }}</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#yellowNotesTab">{{ __('Yellow Notes') }}</a>
                                        </li>
                                        {{-- <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#templateTab">{{ __('Template') }}</a>
                                        </li> --}}
                                        @if ($gnotes != null)
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('file.share', $gnotes->id) }}">{{ __('Send') }}</a>
                                        </li>
                                        @endif
                                    </ul>

                                    <div class="tab-content">
                                        <div id="greenNotesTab" class="tab-pane active">
                                            <br>
                                            @php
                                            $description = $gnotes->description ?? '';
                                            $id = $gnotes->id ?? '';
                                            @endphp
                                            <div class="form-group">
                                                <label for="gdescription">{{ __('Green Notes') }}</label>
                                                <button type="button" class="btn btn-primary float-right"
                                                    id="upload">{{ __('Upload From Template') }}</button>
                                                <div class="row d-none" id="uploadtemplate">
                                                    <br>
                                                    <div class="col-md-3">
                                                        {{ Form::label('category', __('Category')), ['class' => 'form-label'] }}
                                                        <select name="category_id" id="category" class="form-control">
                                                            <option value="">Select Category</option>
                                                            @foreach ($categories as $category)
                                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                            @endforeach
                                                        </select>

                                                        @error('category')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-3">
                                                        {{ Form::label('subcategory_id', __('SubCategory')), ['class' => 'form-label'] }}
                                                        <select name="subcategory_id" id="subcategory" class="form-control">
                                                            <option value="">Select SubCategory</option>
                                                        </select>
                                                        @error('subcategory')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-3">
                                                        {{ Form::label('template', __('Template')), ['class' => 'form-label'] }}
                                                        <select name="template" id="template" class="form-control">
                                                            <option value="">Select Template</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                {{ Form::textarea('gdescription', $description, ['class' => 'form-control ckeditor-textarea', 'id' => 'gdescription', 'rows' => '8']) }}
                                                @error('description')
                                                <span class="invalid-name" role="alert">
                                                    <strong class="text-danger">{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>


                                            @if($file_share != null && $file_share->status == 1 && $file_share->sender_id != Auth::user()->id )
                                            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                                            <a class="btn btn-secondary"
                                                href="{{ route('discard.notes', $id) }}">{{ __('Discard') }}</a>
                                            @endif
                                        </div>
                                        <div id="yellowNotesTab" class="tab-pane fade">
                                            <br>
                                            @php
                                            $ydescription = $ynotes->description ?? '';
                                            $yid = $ynotes->id ?? '';
                                            @endphp
                                            <div class="form-group">
                                                <label for="ydescription">{{ __('Yellow Notes') }}</label>
                                                {{ Form::textarea('ydescription', $ydescription, ['class' => 'form-control ckeditor-textarea', 'id' => 'ydescription', 'rows' => '8']) }}
                                                @error('description')
                                                <span class="invalid-name" role="alert">
                                                    <strong class="text-danger">{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                                                <a class="btn btn-secondary"
                                                    href="{{ route('discard.notes', $yid) }}">{{ __('Discard') }}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {!! Form::close() !!}
                            </div>
                            @endif
                        </div>
                        @if ($notes->share_notes_status == '1')
                        <div class="col-md-12 text-right mb-5">
                            @if ($notes->approval_notes_status != 1)
                            @if ($viewfile->status == '0')
                            <button type="button" id="revertstatus" class="btn btn-primary"
                                data-toggle="modal" data-target="#confirmModal" style="float: right;">
                                {{ __('Notes Approve') }}
                            </button>
                            @endif
                            <div class="col-md-5 text-right mb-2">
                                <button id="toggleNotesButton" class="btn btn-success" type="button"
                                    onclick="toggleNotesTable()">Show Previous Notes</button>
                                </button>
                            </div>
                            @endif
                        </div>
                        @endif
                        <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog"
                            aria-labelledby="confirmModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="confirmModalLabel">Confirm Approval</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to approve this note?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">No</button>
                                        <a href="{{ route('notes.activity', $notes->id) }}" type="submit"
                                            class="btn btn-primary">Yes, Approve</a>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="viewNotesModal" tabindex="-1" role="dialog"
                            aria-labelledby="viewNotesModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="viewNotesModalLabel">{{ __('View Notes') }}</h5>
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p id="modalDescription"></p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">{{ __('Close') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="commentModal" tabindex="-1" aria-labelledby="commentModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="commentModalLabel">Add Comment</h5>
                                        <button type="button" id="close_btn" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close">
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="commentForm">
                                            <div class="mb-3">
                                                <label for="commentText" class="form-label">Comment</label>
                                                <textarea class="form-control" id="commentText" name="comment " rows="3" required> </textarea>
                                            </div>
                                            <input type="hidden" id="share_id" value="{{ $viewfile->id }}">
                                            <div class="modal-footer">
                                                <button type="button" id="close_comment" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save Comment</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="notestable" style="display: none;">
                            <table class="table table-bordered table-hover">
                                <thead class="thead-light">
                                    <tr>
                                        <th>{{ __('Sl No') }}</th>
                                        <th>{{ __('Notes') }}</th>
                                        <th>{{ __('Created By') }}</th>
                                        <th>{{ __('Created Date') }}</th>
                                        <th>{{ __('Approved By') }}</th>
                                        <th>{{ __('Approved Date') }}</th>
                                        <th>{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($approvedNote as $index => $approvedNotes)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{!! Str::limit($approvedNotes->description, 20) !!}</td>
                                        <td>{{ $approvedNotes->user->name }}</td>
                                        <td>{{ date('d-m-Y', strtotime($approvedNotes->created_at)) }}</td>
                                        <td>{{ $approvedNotes->users->name }}</td>
                                        <td>
                                            {{ date('d-m-Y', strtotime($approvedNotes->approved_date)) }}
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-primary view-notes"
                                                data-toggle="modal" data-target="#viewNotesModal"
                                                data-description="{{ $approvedNotes->description }}">
                                                {{ __('View') }}
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @if($correspondence->isNotEmpty())
                        <div id="receipttable">
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
                                        <td><a href="{{ route('receipt.view', $correspondences->receipt->id) }}"
                                                target="_blank">{{ $correspondences->receipt->subject }} </a>
                                        </td>
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
                                        <th>{{ __('Document Name') }}</th>
                                        <th>{{ __('Metatitle') }}</th>
                                        <th>{{ __('Documentpath') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($correspondence as $correspondences)
                                    @if ($correspondences->doc_id != null)
                                    <tr>
                                        <td>{{ $correspondences->file->file_name }}</td>
                                        <td>{{ $correspondences->document->dtype }}</td>
                                        <td>{{ $correspondences->document->document_name }}</td>
                                        <td>{{ $correspondences->document->meta_title }}</td>
                                        <td><a href="{{ asset('public/' . $correspondences->document->documentpath) }}"
                                                target="_blank">View</a></td>
                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                        <h6>No Correspondence Found</h6>
                        @endif
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Add File</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        {{ Form::open(['route' => 'forward.filestore', 'method' => 'post']) }}
                                        <input type="text" name="note_id" value="{{ $notes->id }}">

                                        <div class="card-body">
                                            <div class="mb-8">
                                                {{ Form::label('department_id', __('Department'), ['class' => 'form-label']) }}
                                                <select name="department_id" id="department" class="form-select">
                                                    <option value="">Select Department</option>
                                                    @foreach ($department as $departments)
                                                    <option value="{{ $departments->id }}">
                                                        {{ $departments->name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                @error('department_id')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                {{ Form::label('section_id', __('Section'), ['class' => 'form-label']) }}
                                                <select name="section_id" id="section" class="form-select">
                                                    <option value="">Select Section</option>
                                                </select>
                                                @error('section_id')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                {{ Form::label('user', __('TO'), ['class' => 'form-label']) }}
                                                <select name="user" id="user" class="form-select">
                                                    <option value="">Select User</option>
                                                </select>
                                                @error('user_id')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Notify Through</label>
                                                <div class="form-check">
                                                    <input type="radio" name="notify" value="email"
                                                        class="form-check-input" checked>
                                                    <label class="form-check-label">Email</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="radio" name="notify" value="sms"
                                                        class="form-check-input">
                                                    <label class="form-check-label">SMS</label>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                {{ Form::label('remarks', __('Remarks'), ['class' => 'form-label']) }}
                                                {{ Form::textarea('remarks', null, ['class' => 'form-control', 'rows' => 3, 'placeholder' => '']) }}
                                                @error('remarks')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                {{ Form::label('duedate', __('Set Due Date'), ['class' => 'form-label']) }}
                                                {{ Form::date('duedate', null, ['class' => 'form-control']) }}
                                                @error('duedate')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                {{ Form::label('action', __('Action'), ['class' => 'form-label']) }}
                                                {{ Form::select('action', ['view' => 'View', 'edit' => 'Edit'], null, ['class' => 'form-select', 'placeholder' => 'Select Action']) }}
                                            </div>
                                            <div class="mb-3">
                                                {{ Form::label('priority', __('Priority'), ['class' => 'form-label']) }}
                                                {{ Form::select('priority', ['Low' => 'Low', 'Medium' => 'Medium', 'High' => 'High'], null, ['class' => 'form-select', 'placeholder' => 'Select Priority']) }}
                                                @error('priority')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="section-body">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4>{{ __('Send For Approval') }}</h4>
                                                </div>
                                                <div class="card-body">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio"
                                                            name="shareStatus" id="shareYes" value="1" checked>
                                                        <label class="form-check-label"
                                                            for="shareYes">{{ __('Yes') }}</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio"
                                                            name="shareStatus" id="shareNo" value="0">
                                                        <label class="form-check-label"
                                                            for="shareNo">{{ __('No') }}</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                        <input type="text" name="forward_id" value="{{ $file->id }}">
                                        <button type="submit"
                                            class="btn btn-primary mb-3">{{ __('Send') }}</button>
                                    </div>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                        <div class="card-footer">
                            <div class="float-end">
                                <form id="statusForm">
                                    @csrf
                                    <input type="hidden" name="status" id="status_id" value="1">
                                    <input type="hidden" name="share_id" id="share_id"
                                        value="{{ $viewfile->id }}">
                                    @if ($file_share->status != 1)
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                        id="revertButton"
                                        data-target="#commentModal">{{ 'Revert' }}</button>
                                    @endif
                                </form>
                                <br>
                                @if ($file_share->status != 1)
                                <a href="{{ route('forward.file', ['id' => $file->id]) }}" type="button"
                                    class="btn btn-primary" data-target="#exampleModal" data-toggle="modal"
                                    disabled>
                                    {{ __('Forward') }} </a>
                                @else
                                <p
                                    id="forward"
                                    class=" mb-3">Note:- <b>This File is reverted</b></p>
                                @endif
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>
<script type="text/javascript" src="{{ asset('assets/ckeditor/ckeditor.js') }}"></script>

<script>
    function toggleNotesTable() {
        var notesTable = document.getElementById('notestable');
        var toggleButton = document.getElementById('toggleNotesButton');
        if (notesTable.style.display === 'none') {
            notesTable.style.display = 'block';
            toggleButton.textContent = 'Hide Previous Notes';
        } else {
            notesTable.style.display = 'none';
            toggleButton.textContent = 'Show Previous Notes';
        }
    }
</script>

<script>
    CKEDITOR.replace('gdescription');
</script>

<script>
    $(document).ready(function() {
        $('#revertButton').click(function() {
            $('#commentModal').modal('show');
        });

        $('#close_comment').click(function() {
            $('#commentModal').modal('hide');
        });

        $('#close_btn').click(function() {
            $('#commentModal').modal('hide');
        });

        $('#commentForm').submit(function(event) {
            event.preventDefault();
            let commentText = $('#commentText').val();
            console.log(commentText);
            var share_id = $('#share_id').val();
            $.ajax({
                url: "{{ route('comments.store', $viewfile->id) }}",
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    comment: commentText,
                    status: $('#status_id').val(),
                    share_Id: share_id,
                },
                success: function(response) {
                    $('#commentModal').modal('hide');
                    window.location.href =
                        "{{ route('file.index') }}";
                },
                error: function(xhr) {
                    let errors = xhr.responseJSON.errors;
                    if (errors.comment) {
                        alert(errors.comment[0]);
                    }
                }
            });
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#notes').on('click', function(event) {
            event.preventDefault();
            $('#notestable').show();
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var viewButtons = document.querySelectorAll('.view-notes');
        viewButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                var description = this.getAttribute('data-description');
                document.getElementById('modalDescription').innerHTML = description;
            });
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#department').change(function() {
            var departmentId = $(this).val();
            $.ajax({
                url: "{{ url('get-section') }}",
                type: 'GET',
                data: {
                    department_id: departmentId,
                },
                success: function(response) {
                    var sections = response;
                    $('#section').empty();
                    $('#section').html('<option value="">Select Section</option>');
                    $.each(sections, function(index, section) {
                        $('#section').append('<option value="' + section.id + '">' +
                            section.name + '</option>');
                    });

                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });

        $('#section').change(function() {
            var sectionId = $(this).val();
            var departmentId = $('#department').val();
            $.ajax({
                url: "{{ url('get-user') }}",
                type: 'GET',
                data: {
                    section_id: sectionId,
                    department_id: departmentId
                },
                success: function(response) {
                    var users = response;
                    $('#user').empty();
                    $('#user').html('<option value="">Select User</option>');
                    $.each(users, function(index, user) {
                        $('#user').append('<option value="' + user.id + '">' + user
                            .name + '</option>');
                    });
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });
    });
</script>


@endsection