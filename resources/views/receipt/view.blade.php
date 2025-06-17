@extends('layouts.fileLayout')
@section('title', __('View Receipt'))
@section('file_content')
<div class="row">
    <div class="section-body">
        <div class="col-md-12 m-auto">
            <div class="card">
                <div class="card-header">
                    <h5>{{ __('View Receipt') }}</h5>
                </div>
                <div class="view-receipt-card-body">
                    <div class="row" id="create-options">
                        <div class="row">
                            <div class="col-md-3 mb-2">
                                <div class="form-group">
                                    <label class="form-label">Department Name</label>
                                    <input type="text" class="form-control"
                                        value="@if ($receipt->ministry) {{ $receipt->ministry->ministryname }} @endif"
                                        disabled>
                                </div>
                            </div>
                            <div class="col-md-3 mb-2">
                                <div class="form-group">
                                    <label class="form-label">DairyDate</label>
                                    <input type="text" class="form-control"
                                        value="@if ($receipt->dairy_date) {{ $receipt->dairy_date }} @endif"
                                        disabled>
                                </div>
                            </div>
                            <div class="col-md-3 mb-2">
                                <div class="form-group">
                                    <label class="form-label">Receipt File</label>
                                    <input type="text" class="form-control"
                                        value="@if ($receipt->receipt_file) {{ $receipt->receipt_file }} @endif"
                                        disabled>
                                </div>
                            </div>
                            <div class="col-md-3 mb-2">
                                <div class="form-group">
                                    <label class="form-label">Receipt Status</label>
                                    <input type="text" class="form-control"
                                        value="@if ($receipt->receipt_status) {{ $receipt->receipt_status }} @endif"
                                        disabled>
                                </div>
                            </div>
                            <div class="col-md-3 mb-2">
                                <div class="form-group">
                                    <label class="form-label">Form Of Communication</label>
                                    <input type="text" class="form-control"
                                        value="@if ($receipt->communication) {{ $receipt->communication->communication }} @endif"
                                        disabled>
                                </div>
                            </div>
                            <div class="col-md-3 mb-2">
                                <div class="form-group">
                                    <label class="form-label">Language</label>
                                    <input type="text" class="form-control"
                                        value="@if ($receipt->language) {{ $receipt->language }} @endif"
                                        disabled>
                                </div>
                            </div>
                            <div class="col-md-3 mb-2">
                                <div class="form-group">
                                    <label class="form-label">Receved Date</label>
                                    <input type="text" class="form-control"
                                        value="@if ($receipt->receved_date) {{ $receipt->receved_date }} @endif"
                                        disabled>
                                </div>
                            </div>
                            <div class="col-md-3 mb-2">
                                <div class="form-group">
                                    <label class="form-label">Letter Date</label>
                                    <input type="text" class="form-control"
                                        value="@if ($receipt->letter_date) {{ $receipt->letter_date }} @endif"
                                        disabled>
                                </div>
                            </div>
                            <div class="col-md-3 mb-2">
                                <div class="form-group">
                                    <label class="form-label">Letter Refference No</label>
                                    <input type="text" class="form-control"
                                        value="@if ($receipt->letter_ref_no) {{ $receipt->letter_ref_no }} @endif"
                                        disabled>
                                </div>
                            </div>
                            <div class="col-md-3 mb-2">
                                <div class="form-group">
                                    <label class="form-label">Delivery Mode</label>
                                    <input type="text" class="form-control"
                                        value="@if ($receipt->receipt) {{ $receipt->receipt->mode }} @endif"
                                        disabled>
                                </div>
                            </div>
                            <div class="col-md-3 mb-2">
                                <div class="form-group">
                                    <label class="form-label">Mode Number</label>
                                    <input type="text" class="form-control"
                                        value="@if ($receipt->mode_number) {{ $receipt->mode_number }} @endif"
                                        disabled>
                                </div>
                            </div>
                            <div class="col-md-3 mb-2">
                                <div class="form-group">
                                    <label class="form-label">Sender Type</label>
                                    <input type="text" class="form-control"
                                        value="@if ($receipt->sender) {{ $receipt->sender->sendertype }} @endif"
                                        disabled>
                                </div>
                            </div>
                            <div class="col-md-3 mb-2">
                                <div class="form-group">
                                    <label class="form-label">Vip</label>
                                    <input type="text" class="form-control"
                                        value="@if ($receipt->Vip) {{ $receipt->Vip->name }} @endif"
                                        disabled>
                                </div>
                            </div>

                            <div class="col-md-3 mb-2">
                                <div class="form-group">
                                    <label class="form-label">Name</label>
                                    <input type="text" class="form-control"
                                        value="@if ($receipt->name) {{ $receipt->name }} @endif"
                                        disabled>
                                </div>
                            </div>
                            <div class="col-md-3 mb-2">
                                <div class="form-group">
                                    <label class="form-label">Designation</label>
                                    <input type="text" class="form-control"
                                        value="@if ($receipt->designation) {{ $receipt->designation }} @endif"
                                        disabled>
                                </div>
                            </div>
                            <div class="col-md-3 mb-2">
                                <div class="form-group">
                                    <label class="form-label">Organitation</label>
                                    <input type="text" class="form-control"
                                        value="@if ($receipt->organitation) {{ $receipt->organitation }} @endif"
                                        disabled>
                                </div>
                            </div>
                            <div class="col-md-3 mb-2">
                                <div class="form-group">
                                    <label class="form-label">Email</label>
                                    <input type="text" class="form-control"
                                        value="@if ($receipt->email) {{ $receipt->email }} @endif"
                                        disabled>
                                </div>
                            </div>
                            <div class="col-md-3 mb-2">
                                <div class="form-group">
                                    <label class="form-label">Pincode</label>
                                    <input type="text" class="form-control"
                                        value="@if ($receipt->pin_code) {{ $receipt->pin_code }} @endif"
                                        disabled>
                                </div>
                            </div>
                            <div class="col-md-3 mb-2">
                                <div class="form-group">
                                    <label class="form-label">Phone Number</label>
                                    <input type="text" class="form-control"
                                        value="@if ($receipt->phone_number) {{ $receipt->phone_number }} @endif"
                                        disabled>
                                </div>
                            </div>
                            <div class="col-md-3 mb-2">
                                <div class="form-group">
                                    <label class="form-label">Country</label>
                                    <input type="text" class="form-control"
                                        value="@if ($receipt->Country) {{ $receipt->Country->name }} @endif"
                                        disabled>
                                </div>
                            </div>
                            <div class="col-md-3 mb-2">
                                <div class="form-group">
                                    <label class="form-label">State</label>
                                    <input type="text" class="form-control"
                                        value="@if ($receipt->State) {{ $receipt->State->name }} @endif"
                                        disabled>
                                </div>
                            </div>
                            <div class="col-md-3 mb-2">
                                <div class="form-group">
                                    <label class="form-label">City</label>
                                    <input type="text" class="form-control"
                                        value="@if ($receipt->city) {{ $receipt->city }} @endif"
                                        disabled>
                                </div>
                            </div>
                            <div class="col-md-3 mb-2">
                                <div class="form-group">
                                    <label class="form-label">Category</label>
                                    <input type="text" class="form-control"
                                        value="@if ($receipt->Category) {{ $receipt->Category->name }} @endif"
                                        disabled>
                                </div>
                            </div>
                            <div class="col-md-3 mb-2">
                                <div class="form-group">
                                    <label class="form-label">Subcategory</label>
                                    <input type="text" class="form-control"
                                        value="@if ($receipt->Subcategory) {{ $receipt->Subcategory->name }} @endif"
                                        disabled>
                                </div>
                            </div>
                            <div class="col-md-3 mb-2">
                                <div class="form-group">
                                    <label class="form-label">Subject</label>
                                    <input type="text" class="form-control" value="@if ($receipt->subject)
                                            {{ $receipt->subject }}
                                        @endif"
                                        disabled>
                                </div>
                            </div>
                            <div class="col-md-3 mb-2">
                                <div class="form-group">
                                    <label class="form-label">Remarks</label>
                                    <textarea class="form-control" disabled>@if ($receipt->remarks)
                                            {{ $receipt->remarks }}
                                        @endif</textarea>
                                </div>
                            </div>
                            <div class="col-md-3 mb-2">
                                <div class="form-group">
                                    <label class="form-label">Address</label>
                                    <textarea class="form-control" disabled>@if ($receipt->address)
                                            {{ $receipt->address }}
                                        @endif</textarea>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="card-footer">
                                <div class="float-end">
                                    <a href="{{ route('share.index') }}" data-bs-toggle="modal"
                        data-bs-target="#commentModal" class="btn btn-danger mb-3">{{ __('Revert') }}
                        </a>
                        <button type="submit" class="btn btn-primary mb-3">{{ __('Foreward') }}</button>
                    </div>
                </div> --}}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#description'))
        .then(editor => {
            console.log(editor);
        })
        .catch(error => {
            console.error(error);
        });
</script>
<script>
    $(document).ready(function() {
        $('#commentForm').submit(function(event) {
            event.preventDefault();
            let commentText = $('#commentText').val();
            var share_id = $('#share_id').val();
            // console.log(share_id);
            $.ajax({
                url: "{{ route('comments.store') }}",
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    comment: commentText,
                    share_Id: share_id
                },
                success: function(response) {
                    $('#commentModal').modal('hide');
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

@endsection