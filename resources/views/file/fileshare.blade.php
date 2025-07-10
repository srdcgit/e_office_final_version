@extends('layouts.fileLayout')
@section('file_title', 'File Share')

@section('file_content')
    @php
        $file = $file ?? null;
    @endphp

    @if ($file)
        <div class="d-flex justify-content-between align-items-center bg-light p-2 border rounded mb-3">
            <div class="text-primary">
                <strong>File Created</strong> / {{ $file->fileno ?? '' }}
            </div>
            <div>
                <span class="ms-3"><strong>File No.:</strong> {{ $file->fileno ?? '' }}</span>
                <span class="ms-3 text-light p-1"
                    style="border-radius: 5px !important; background-color: #474b4f !important;">Subject:
                    {{ $file->description ?? '' }}</span>
            </div>
        </div>
    @endif

    <div class="row p-4">
        <div class="col-md-7">
            <div class="card p-3 mb-3">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label"><b>Organisation</b></label>
                        <select class="form-select" name="organisation" id="organisation">
                            <option selected>Choose One</option>
                            @if (isset($organisations))
                                @foreach ($organisations as $org)
                                    <option value="{{ $org->id }}">{{ $org->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label"><b>Secondary Dropdown</b></label>
                        <select class="form-select" name="secondary_dropdown" id="secondary_dropdown">
                            <option selected>Choose One</option>
                            <!-- Populate as needed -->
                        </select>
                    </div>
                </div>
                <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active text-dark" id="all-tab" data-bs-toggle="tab"
                            data-bs-target="#all-tab-pane" type="button" role="tab" aria-controls="all-tab-pane"
                            aria-selected="true">All</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link text-dark" id="preferred-tab" data-bs-toggle="tab"
                            data-bs-target="#preferred-tab-pane" type="button" role="tab"
                            aria-controls="preferred-tab-pane" aria-selected="false">Preferred List</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link text-dark" id="recent-tab" data-bs-toggle="tab"
                            data-bs-target="#recent-tab-pane" type="button" role="tab" aria-controls="recent-tab-pane"
                            aria-selected="false">Recent 10</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link text-dark" id="channel-tab" data-bs-toggle="tab"
                            data-bs-target="#channel-tab-pane" type="button" role="tab"
                            aria-controls="channel-tab-pane" aria-selected="false">In Channel</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link text-dark" id="subordinates-tab" data-bs-toggle="tab"
                            data-bs-target="#subordinates-tab-pane" type="button" role="tab"
                            aria-controls="subordinates-tab-pane" aria-selected="false">Sub-ordinates</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link text-dark" id="sendback-tab" data-bs-toggle="tab"
                            data-bs-target="#sendback-tab-pane" type="button" role="tab"
                            aria-controls="sendback-tab-pane" aria-selected="false">Send Back</button>
                    </li>
                </ul>
                <div class="tab-content mb-3" id="myTabContent">
                    <div class="tab-pane fade show active" id="all-tab-pane" role="tabpanel" aria-labelledby="all-tab"
                        tabindex="0">Reporting Officer</div>
                    <div class="tab-pane fade" id="preferred-tab-pane" role="tabpanel" aria-labelledby="preferred-tab"
                        tabindex="0">...</div>
                    <div class="tab-pane fade" id="recent-tab-pane" role="tabpanel" aria-labelledby="recent-tab"
                        tabindex="0">...</div>
                    <div class="tab-pane fade" id="channel-tab-pane" role="tabpanel" aria-labelledby="channel-tab"
                        tabindex="0">...</div>
                    <div class="tab-pane fade" id="subordinates-tab-pane" role="tabpanel"
                        aria-labelledby="subordinates-tab" tabindex="0">...</div>
                    <div class="tab-pane fade" id="sendback-tab-pane" role="tabpanel" aria-labelledby="sendback-tab"
                        tabindex="0">...</div>
                </div>
                <div class="row mb-2 align-items-center">
                    <div class="col-md-8">
                        <label class="form-label"><b>To</b> <span class="text-danger">*</span></label>
                        <select class="form-control" name="user" id="contactInput" style="width: 100%;"></select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label d-block"><b>Notify Through:</b></label>
                        <div class="row">
                            <div class="col">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="notify[]" id="notifyEmail"
                                        value="email">
                                    <label class="form-check-label" for="notifyEmail"><b>Email</b></label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="notify[]" id="notifySms"
                                        value="sms">
                                    <label class="form-check-label" for="notifySms"><b>SMS</b></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-1">
                    <div class="col-12">
                        <span class="form-text text-muted" style="font-style:italic"><b>Note :</b> Email/SMS will be sent
                            based on checkbox selection (Notify Through), irrespective of User Preference and Instance
                            Configuration.</span>
                    </div>
                </div> 
                <div class="mb-3">
                    <label class="form-label"><b>Remarks</b></label>
                    <textarea class="form-control" name="remark" id="remarkTextarea" rows="2" maxlength="1000"
                        placeholder="Add your remarks here..."></textarea>
                    <p class="mb-0">Total 1000 | <span id="charCount">1000</span> Character left</p>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label"><b>Set Due Date</b></label>
                        <input type="date" name="duedate" class="form-control" style="cursor: pointer;">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label"><b>Action</b></label>
                        <select class="form-select" name="action" style="cursor: pointer;">
                            <option selected>Choose One</option>
                            <option value="Call For Meeting">Call For Meeting</option>
                            <option value="FNA">FNA</option>
                            <option value="Give Time">Give Time</option>
                            <option value="Please CAll">Please CAll</option>
                            <option value="Please Discuss">Please Discuss</option>
                            <option value="Please Examine">Please Examine</option>
                            <option value="Please Examine Putup">Please Examine Putup</option>
                        </select>
                    </div>
                </div>
                <div class="text-end mt-3">
                    <button class="btn btn-primary" disabled>DSC Sign & Send</button>
                    <button type="submit" class="btn btn-success">Send</button>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="table-responsive mb-3">
                <table class="table table-bordered align-middle">
                    <thead class="table-secondary">
                        <tr>
                            <th><input type="checkbox" /></th>
                            <th>File Components</th>
                            <th>File No.</th>
                            <th>Description</th>
                            <th>Note</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="checkbox" checked /></td>
                            <td>{{ $file->component ?? 'File' }}</td>
                            <td>{{ $file->fileno ?? 'not found' }}</td>
                            <td>{{ $file->description ?? 'not found' }}</td>
                            <td>{!! $notes->description ?? 'not found' !!}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="card mb-3">
                <div class="card-header">Intimate To</div>
                <div class="card-body p-0">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th>S. No.</th>
                                <th>Employee Name</th>
                                <th>Marking Abbreviation</th>
                                <th>Section</th>
                                <th>Email</th>
                                <th>SMS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="6" class="text-center text-muted">No Record(s) Found</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#contactInput').select2({
                placeholder: 'Select User',
                allowClear: true
            });
            $('#organisation').change(function() {
                var organisationId = $(this).val();
                $.ajax({
                    url: "{{ url('get-secondary-dropdown') }}",
                    type: 'GET',
                    data: {
                        organisation_id: organisationId,
                    },
                    success: function(response) {
                        var secondaryDropdown = response;
                        $('#secondary_dropdown').empty();
                        $('#secondary_dropdown').html(
                            '<option value="">Select Secondary</option>');
                        $.each(secondaryDropdown, function(index, item) {
                            $('#secondary_dropdown').append('<option value="' + item
                                .id + '">' + item.name + '</option>');
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            });
            $('#secondary_dropdown').change(function() {
                var secondaryId = $(this).val();
                var organisationId = $('#organisation').val();
                $.ajax({
                    url: "{{ url('select-user-for-file-share') }}",
                    type: 'GET',
                    data: {
                        secondary_id: secondaryId,
                        organisation_id: organisationId
                    },
                    success: function(response) {
                        var users = response;
                        $('#contactInput').empty();
                        $('#contactInput').html('<option value="">Select User</option>');
                        $.each(users, function(index, user) {
                            $('#contactInput').append('<option value="' + user.id +
                                '">' + user.name + '</option>');
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            });
            // Character count for remarks
            const textarea = document.getElementById('remarkTextarea');
            const charCount = document.getElementById('charCount');
            const maxChars = 1000;
            textarea.addEventListener('input', function() {
                const remaining = maxChars - textarea.value.length;
                charCount.textContent = remaining;
            });
        });
    </script>
    <style>
        .card {
            margin-top: 2%;
        }

        .card-footer {
            margin-top: 1%;
            height: 8vh;
        }

        .select2-container .select2-selection--single {
            height: 38px;
            padding: 6px 12px;
        }

        .select2-container--default .select2-selection--multiple {
            min-height: 38px;
            padding: 6px 12px;
        }

        .form-check {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .form-check-input {
            margin-right: 10px;
        }

        .form-check-label {
            font-weight: bold;
        }
    </style>
@endsection
