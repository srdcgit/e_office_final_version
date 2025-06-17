@extends('layouts.fileLayout')
@section('file_title', 'Receipt Sent')

@section('file_content')
    {{ $dataTable->table(['width' => '100%']) }}



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


    <!-- Pull Back Reason Modal -->
    <div class="modal fade" id="pullbackModal" tabindex="-1" aria-labelledby="pullbackModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Pull Back Reason</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <textarea id="pullback-reason" class="form-control remark-textarea" rows="4" placeholder="Enter your reason"></textarea>
                    <p>Total: 1000 | <span class="char-count">1000</span> Characters left</p>
                    <input type="hidden" id="pullback-id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirm-pullback">Pull Back</button>
                </div>
            </div>
        </div>
    </div>
  

    <!-- Script -->

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
    <script>
        $(document).on('click', '.pullback-btn', function() {
            const id = $(this).data('id');
            $('#pullback-id').val(id);
            $('#pullback-reason').val('');
            $('#pullbackModal').modal('show');
        });



        $('#confirm-pullback').on('click', function() {
            const id = $('#pullback-id').val();
            const reason = $('#pullback-reason').val().trim();

            if (!reason) {
                Swal.fire('Required', 'Please enter a reason for pulling back.', 'warning');
                return;
            }

            Swal.fire({
                title: 'Are you sure?',
                text: "You are about to pull back this receipt.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, pull back it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        url: '{{ route("receiptshares.pullback", ":id") }}'.replace(':id', id),
                        type: 'POST',
                        data: {
                            reason: reason,
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            $('#pullbackModal').modal('hide');
                            Swal.fire('Success', response.message, 'success');
                            $('#shares-table').DataTable().ajax.reload();
                        },
                        error: function() {
                            Swal.fire('Error', 'Failed to pull back the receipt.', 'error');
                        }
                    });
                }
            });
        });
    </script>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const textarea = document.querySelector('.remark-textarea');
        const charCount = document.querySelector('.char-count');
        const maxChars = 1000;

        if (textarea && charCount) {
            textarea.addEventListener('input', function () {
                const remaining = maxChars - textarea.value.length;
                charCount.textContent = remaining;
            });
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
    {{ $dataTable->scripts() }}
@endpush
