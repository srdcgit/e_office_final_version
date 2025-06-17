@extends('layouts.admin')
@section('title', __('Receipt Index sss'))
@section('breadcrumb')
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Dashboard') }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('document.index') }}">{{ __('Receipt') }}</a></li>
        <li class="breadcrumb-item">{{ __('Index') }}</li>
    </ul>
@endsection
@section('content')
   
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive py-5 pb-4 dropdown_2">
                        <div class="container-fluid">
                            {{ $dataTable->table(['width' => '100%']) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // When the document is ready
        $(document).ready(function() {
            // Handle click on "Select All" checkbox
            $('#select-all').on('click', function() {
                const rows = $('#receipts-table').DataTable().rows({
                    'search': 'applied'
                }).nodes();
                $('input[type="checkbox"].row-checkbox', rows).prop('checked', this.checked);
            });

            // If any checkbox is unchecked, uncheck the "Select All" checkbox
            $('#receipts-table tbody').on('change', 'input.row-checkbox', function() {
                if (!this.checked) {
                    $('#select-all').prop('checked', false);
                }

                // If all checkboxes are checked, also check "Select All"
                if ($('#receipts-table tbody input.row-checkbox:checked').length === $(
                        '#receipts-table tbody input.row-checkbox').length) {
                    $('#select-all').prop('checked', true);
                }
            });
        });
    </script>


@endsection
@push('style')
    @include('layouts.includes.datatable_css')
    <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome.css') }}">
    <style>
        .dataTables_filter {
            display: none;
        }

        .dataTables_length {
            display: none;
        }
    </style>
@endpush
@push('scripts')
    @include('layouts.includes.datatable_js')
    {{ $dataTable->scripts() }}
@endpush
