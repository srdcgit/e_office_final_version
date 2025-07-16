@extends('layouts.fileLayout')
@section('file_title', 'Correspondence Movements')

@section('file_content')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
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

        .movement-history-ribbon {
            position: relative;
            display: inline-block;
            background-color: #0d77ca;
            color: #fff;
            font-weight: bold;
            padding: 8px 20px 8px 15px;
            font-size: 16px;
            clip-path: polygon(0 0, 90% 0, 100% 50%, 90% 100%, 0 100%);
            border-radius: 2px 0 0 2px;
            margin-bottom: -5px;
        }

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
        <a href="{{ route('home') }}">
            <button class="btn btnn btn-dark btn-sm shadow-sm">
                <i class="fa fa-home"></i>
            </button>
        </a>
        {{-- <span class="btn btnn btn-sm shadow-sm">Correspondence Movements</span> --}}
        <a href="javascript:void(0);">
            <button class="btn btnn btn-sm shadow-sm" onclick="copyToClipboard(window.location.href)">Copy Link</button>
        </a>
        <a href="{{ url()->previous() }}">
            <button class="btn btnn btn-sm shadow-sm">Back</button>
        </a>
    </div>

    <div style="">
        <div class="movement-history-ribbon">
            Movement History
        </div>
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

    <!-- Correspondence Detail Modal -->
    <div class="modal fade" id="correspondenceDetailModal" tabindex="-1" aria-labelledby="correspondenceDetailModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="correspondenceDetailModalLabel">Correspondence Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="correspondenceDetailContent">
                    Loading...
                </div>
            </div>
        </div>
    </div>
    
    <script>
        $(document).on('click', '.receiver', function() {
            var userId = $(this).data('id');
            console.log('User Id ' + userId);
            var userDetailsUrl = @json(route('correspondence-movements.user-details', ['id' => 'USER_ID_PLACEHOLDER']));
            var url = userDetailsUrl.replace('USER_ID_PLACEHOLDER', userId);
            $.ajax({
                url: url,
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

        var correspondenceDetailsUrl = @json(route('correspondence-movements.correspondence-details', ['id' => 'CORRESPONDENCE_ID_PLACEHOLDER']));

        $(document).on('click', '.correspondence-id', function() {
            var correspondenceId = $(this).data('id');
            var url = correspondenceDetailsUrl.replace('CORRESPONDENCE_ID_PLACEHOLDER', correspondenceId);

            $.ajax({
                url: url,
                type: 'GET',
                success: function(data) {
                    $('#correspondenceDetailContent').html(data);
                    $('#correspondenceDetailModal').modal('show');
                },
                error: function() {
                    $('#correspondenceDetailContent').html('<p class="text-danger">Unable to load correspondence details.</p>');
                    $('#correspondenceDetailModal').modal('show');
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
    {!! $dataTable->scripts() !!}
@endpush
