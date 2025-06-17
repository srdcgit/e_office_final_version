@extends('layouts.fileLayout')
@section('file_title', 'Share Receipt')

@section('file_content')

    {{-- Another bar  --}}
    @php
        $receipt = \App\Models\Receipt::find($receiptid);
    @endphp

    @if ($receipt)
        <div class="d-flex justify-content-between align-items-center bg-light p-2 border rounded mb-3">
            <div class="text-primary">
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
                <span class="ms-3 text-light p-1" style="border-radius: 5px !important; background-color: #474b4f !important;">Subject: {{ $receipt->subject }}</span>
            </div>
        </div>
    @endif
    {{-- Another BAr ends here  --}}



    <div class="row">
        <div class="row">
            <div class="section-body">

                <br><br>

                {{-- demo code  --}}
                <div class="container border p-3 bg-light rounded">
                    <form action="{{ route('receiptshare.store') }}" method="post">
                        @csrf
                        <input type="hidden" name="receipt_id" value="{{ $receipt->id }}">

                        {{-- first row  --}}
                        <div class="row">
                            <div class="col">
                                <div class="row mb-3 align-items-center">
                                    <div class="col-md-6">
                                        <label class="form-label"><b>Organisation</b></label>
                                        <select class="form-select">
                                            <option selected>Choose One</option>
                                            @foreach ($inst as $in)
                                                <option value="{{ $in->organitation }}">{{ $in->organitation }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <select class="form-select">
                                            <option selected>Choose One</option>
                                        </select>
                                    </div>

                                    <div>
                                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link active text-dark" id="home-tab"
                                                    data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button"
                                                    role="tab" aria-controls="home-tab-pane"
                                                    aria-selected="true">All</button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link text-dark" id="profile-tab" data-bs-toggle="tab"
                                                    data-bs-target="#profile-tab-pane" type="button" role="tab"
                                                    aria-controls="profile-tab-pane" aria-selected="false">Preffered
                                                    List</button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link text-dark" id="contact-tab" data-bs-toggle="tab"
                                                    data-bs-target="#contact-tab-pane" type="button" role="tab"
                                                    aria-controls="contact-tab-pane" aria-selected="false">Recent
                                                    10</button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link text-dark" id="disabled-tab" data-bs-toggle="tab"
                                                    data-bs-target="#disabled-tab-pane" type="button" role="tab"
                                                    aria-controls="disabled-tab-pane" aria-selected="false">In
                                                    Channel</button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link text-dark" id="disabled-tab" data-bs-toggle="tab"
                                                    data-bs-target="#disabled-tab-pane" type="button" role="tab"
                                                    aria-controls="disabled-tab-pane"
                                                    aria-selected="false">Sub-ordinates</button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link text-dark" id="disabled-tab" data-bs-toggle="tab"
                                                    data-bs-target="#disabled-tab-pane" type="button" role="tab"
                                                    aria-controls="disabled-tab-pane" aria-selected="false">Send
                                                    Back</button>
                                            </li>
                                        </ul>
                                        <div class="tab-content" id="myTabContent">
                                            <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel"
                                                aria-labelledby="home-tab" tabindex="0">...</div>
                                            <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel"
                                                aria-labelledby="profile-tab" tabindex="0">...</div>
                                            <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel"
                                                aria-labelledby="contact-tab" tabindex="0">...</div>
                                            <div class="tab-pane fade" id="disabled-tab-pane" role="tabpanel"
                                                aria-labelledby="disabled-tab" tabindex="0">...</div>
                                        </div>
                                    </div>

                                    <div class="row mb-3 align-items-center">
                                        <div class="col-md-6">
                                            <label class="form-label"><b>To</b> <span class="text-danger">*</span></label>
                                            <select class="form-control" name="recever" id="contactInput"
                                                style="width: 100%;">
                                            </select>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label d-block"><b>Notify Through:</b></label>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="notifyEmail"
                                                    value="email">
                                                <label class="form-check-label" for="notifyEmail"><b>Email</b></label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="notifySms"
                                                    value="sms">
                                                <label class="form-check-label" for="notifySms"><b>SMS</b></label>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-text"><b>Note:</b> SMS will be sent based on checkbox
                                        selection (Notify Through) irrespctive of user preferences and instance
                                        Configuration.
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label"><b>Cc</b></label>
                                        <select class="form-control" name="cc[]" id="ccInput"
                                            multiple="multiple"></select>
                                        <div class="form-text"><b>Note:</b> Any changes in the main receipt will reflect in
                                            CC unless put inside a file.</div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label"><b>Remarks</b></label>
                                    <textarea class="form-control" name="remark" id="remarkTextarea" rows="2" maxlength="1000"
                                        placeholder="Add your remarks here..."></textarea>
                                    <p>Total: 1000 | <span id="charCount">1000</span> Characters left</p>
                                </div>


                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label class="form-label"><b>Set Due Date</b></label>
                                        <input type="date" name="duedate" class="form-control"
                                            style="cursor: pointer;">
                                    </div>
                                    <div class="col-md-4">
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

                                    {{-- Priority  --}}
                                    {{-- 1 = Immediate
                                2 = Most Immediate
                                3 = Out Today --}}
                                    <div class="col-md-4">
                                        <label class="form-label"><b>Priority</b></label>
                                        <select class="form-select" name="priority" style="cursor: pointer;">
                                            <option selected>Choose One</option>
                                            <option value="1">Immediate</option>
                                            <option value="2">Most Immediate</option>
                                            <option value="3">Out Today</option>
                                        </select>
                                    </div>
                                </div>
                            </div>


                            {{-- Second row  --}}
                            <div class="col">
                                <div class="table-responsive mb-3">
                                    <table class="table table-bordered align-middle">
                                        <thead class="table-secondary">
                                            <tr>
                                                <th><input type="checkbox" /></th>
                                                <th>File / Receipt Components</th>
                                                <th>Nature</th>
                                                <th>Comp. No.</th>
                                                <th>Receipt No.</th>
                                                <th>Subject</th>
                                                <th>Note</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <tr>
                                                <td><input type="checkbox" checked /></td>
                                                <td>{{ $receipt->component ?? 'Receipt' }}</td>
                                                <td>{{ $receipt->receipt_status ?? 'nature not found' }}</td>
                                                <td>{{ $receipt->computer_number ?? 'not found' }}</td>
                                                <td>{{ $receipt->letter_ref_no ?? 'not found' }}</td>
                                                <td>{{ $receipt->subject ?? 'not found' }}</td>
                                                <td>{{ $receipt->remarks ?? 'not found' }}</td>
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
                                                    <td colspan="6" class="text-center text-muted">No Record(s) Found
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>






                        <div class="text-end">
                            <button class="btn btn-primary" disabled>DSC Sign & Send</button>
                            <button type="submit" class="btn btn-success">Send</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <style>
            .card {
                margin-top: 2%;
            }

            .card-footer {
                margin-top: 1%;
                height: 8vh;
            }

            .switch {
                position: relative;
                display: inline-block;
                width: 60px;
                height: 34px;
            }

            .switch input {
                opacity: 0;
                width: 0;
                height: 0;
            }

            .slider {
                position: absolute;
                cursor: pointer;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background-color: #ccc;
                -webkit-transition: .4s;
                transition: .4s;
            }

            .slider:before {
                position: absolute;
                content: "";
                height: 26px;
                width: 26px;
                left: 4px;
                bottom: 4px;
                background-color: white;
                -webkit-transition: .4s;
                transition: .4s;
            }

            input:checked+.slider {
                background-color: #2196F3;
            }

            input:focus+.slider {
                box-shadow: 0 0 1px #2196F3;
            }

            input:checked+.slider:before {
                -webkit-transform: translateX(26px);
                -ms-transform: translateX(26px);
                transform: translateX(26px);
            }

            /* Rounded sliders */
            .slider.round {
                border-radius: 34px;
            }

            .slider.round:before {
                border-radius: 50%;
            }

            @media (min-width: 1400px) {

                .container,
                .container-lg,
                .container-md,
                .container-sm,
                .container-xl,
                .container-xxl {
                    max-width: 95% !important;
                }
            }
        </style>





        <script>
            $('#department').change(function() {
                var departmentId = $(this).val();
                $.ajax({
                    url: "{{ url('get-section') }}",
                    type: 'GET',
                    data: {
                        department_id: departmentId,
                    },
                    success: function(response) {
                        // console.log(response);
                        var sections = response;
                        $('#section').empty();
                        $('#section').html('<option value="">Select Section</option>');
                        $.each(sections, function(index, section) {
                            $('#section').append('<option value="' + section.id + '">' + section
                                .name + '</option>');
                        });
                    },
                    error: function(xhr, status, error) {

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
                        // console.log(response);
                        var users = response;
                        $('#user').empty();
                        $('#user').html('<option value="">Select User</option>');
                        $.each(users, function(index, user) {
                            $('#user').append('<option value="' + user.id + '">' + user.name +
                                '</option>');
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            });
        </script>

        {{-- Count Remark text area character  --}}
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const textarea = document.getElementById('remarkTextarea');
                const charCount = document.getElementById('charCount');
                const maxChars = 1000;

                textarea.addEventListener('input', function() {
                    const remaining = maxChars - textarea.value.length;
                    charCount.textContent = remaining;
                });
            });
        </script>



    @endsection
