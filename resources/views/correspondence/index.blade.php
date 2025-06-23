@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Correspondence List</h4>
                </div>
                <div class="card-body">
                    {!! $dataTable->table(['class' => 'table table-bordered dt-responsive nowrap']) !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    {!! $dataTable->scripts() !!}
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

        // Function to get selected IDs
        window.getSelectedIds = function() {
            var selectedIds = [];
            $('.correspondence-checkbox:checked').each(function() {
                selectedIds.push($(this).val());
            });
            return selectedIds;
        }
    </script>
@endpush 