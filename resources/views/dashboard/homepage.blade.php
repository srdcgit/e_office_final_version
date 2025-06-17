@extends('layouts.admin')
@section('title')
{{ __('Dashboard') }}
@endsection
@section('content')
<!-- [ Main Content ] start -->
<div class="row">
    <!-- Analytic Cards Start -->
    @can('manage-user')
    <div class="col-xl-3 col-md-6 mb-4">
        <a href="{{ route('users.index') }}">
            <div class="card comp-card">
                <div class="card-body d-flex align-items-center">
                    <div class="flex-grow-1">
                        <h6 class="text-muted">{{ __('Total Users') }}</h6>
                        <h3>{{ $user }}</h3>
                    </div>
                    <div>
                        <i class="ti ti-users bg-primary text-white p-3 rounded-circle"></i>
                    </div>
                </div>
            </div>
        </a>
    </div>
    @endcan
    @can('manage-role')
    <div class="col-xl-3 col-md-6 mb-4">
        <a href="{{ route('roles.index') }}">
            <div class="card comp-card">
                <div class="card-body d-flex align-items-center">
                    <div class="flex-grow-1">
                        <h6 class="text-muted">{{ __('Total Roles') }}</h6>
                        <h3>{{ $role }}</h3>
                    </div>
                    <div>
                        <i class="ti ti-key bg-info text-white p-3 rounded-circle"></i>
                    </div>
                </div>
            </div>
        </a>
    </div>
    @endcan
    @can('manage-module')
    <div class="col-xl-3 col-md-6 mb-4">
        <a href="{{ route('modules.index') }}">
            <div class="card comp-card">
                <div class="card-body d-flex align-items-center">
                    <div class="flex-grow-1">
                        <h6 class="text-muted">{{ __('Total Modules') }}</h6>
                        <h3>{{ $modual }}</h3>
                    </div>
                    <div>
                        <i class="ti ti-layout bg-success text-white p-3 rounded-circle"></i>
                    </div>
                </div>
            </div>
        </a>
    </div>
    @endcan
    @can('manage-language')
    <div class="col-xl-3 col-md-6 mb-4">
        <a href="{{ route('languages.index') }}">
            <div class="card comp-card">
                <div class="card-body d-flex align-items-center">
                    <div class="flex-grow-1">
                        <h6 class="text-muted">{{ __('Total Languages') }}</h6>
                        <h3>{{ $languages }}</h3>
                    </div>
                    <div>
                        <i class="ti ti-world bg-danger text-white p-3 rounded-circle"></i>
                    </div>
                </div>
            </div>
        </a>
    </div>
    @endcan
    <!-- Analytic Cards End -->

    <div class="col-lg-12">
        @role('admin')
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title mb-0">{{ 'Users' }}</h4>
                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                        <label class="btn btn-light-primary active" id="option1">
                            <input type="radio" class="btn-check" name="options" autocomplete="off" checked>
                            {{ __('Month') }}
                        </label>
                        <label class="btn btn-light-primary" id="option2">
                            <input type="radio" class="btn-check" name="options" autocomplete="off">
                            {{ __('Year') }}
                        </label>
                    </div>
                </div>
                <div class="c-chart-wrapper mt-3">
                    <canvas class="chart" id="main-chart" height="300"></canvas>
                </div>
            </div>
        </div>
        @else
        <div class="card">
            <div class="card-body">
                <div class="card-header">
                    <h4 class="card-title mb-0">{{ 'File Inbox' }}</h4>
                </div>
                <div class="row mt-3">
                    <div class="col-sm-4">
                        <a href="{{ route('file.inbox') }}" id="inboxFilesLink">
                            <div class="card card-body bg-blue-400 has-bg-image">
                                <div class="media">
                                    <div class="mr-3 align-self-center">
                                        <i class="icon-unlink2 icon-3x opacity-75"></i>
                                    </div>
                                    <div class="media-body text-right">
                                        <h3 class="mb-0">{{ count($file_inbox) }}</h3>
                                        <span class="text-uppercase font-size-xs">Total Received Files</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-sm-4">
                        <a href="#" id="revertedFilesLink">
                            <div class="card card-body bg-blue-400 has-bg-image">
                                <div class="media">
                                    <div class="mr-3 align-self-center">
                                        <i class="icon-unlink2 icon-3x opacity-75"></i>
                                    </div>
                                    <div class="media-body text-right">
                                        <h3 class="mb-0">{{ count($file_revert) }}</h3>
                                        <span class="text-uppercase font-size-xs">Reverted Files</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <br>
                    <div id="notestable" style="display: none;">
                        <table class="table table-bordered table-hover">
                            <thead class="thead-light">
                                <tr>
                                    <th>{{ __('Sl No') }}</th>
                                    <th>{{ __('File Name') }}</th>
                                    <th>{{ __('Notes') }}</th>
                                    <th>{{ __('Department') }}</th>
                                    <th>{{ __('Section') }}</th>
                                    <th>{{ __('duedate Date') }}</th>
                                    <th>{{ __('remarks') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($file_revert as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->files->file_name }}</td>
                                    <td>{!! $item->notes->description !!}</td>
                                    <td>{{ $item->department->name }}</td>
                                    <td>{{ $item->section->name }}</td>
                                    <td>{{ $item->duedate }}</td>
                                    <td>{{ $item->remarks }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <script>
                        document.getElementById('revertedFilesLink').addEventListener('click', function(event) {
                            event.preventDefault();
                            var notesTable = document.getElementById('notestable');
                            if (notesTable.style.display === 'none') {
                                notesTable.style.display = 'block';
                            } else {
                                notesTable.style.display = 'none';
                            }
                        });
                    </script>

                    <div class="col-sm-4">
                        <a href="#" id="forwardFilesLink">
                            <div class="card card-body bg-blue-400 has-bg-image">
                                <div class="media">
                                    <div class="mr-3 align-self-center">
                                        <i class="icon-unlink2 icon-3x opacity-75"></i>
                                    </div>
                                    <div class="media-body text-right">
                                        <h3 class="mb-0">{{ count($file_forward) }}</h3>
                                        <span class="text-uppercase font-size-xs">Forwarded Files</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div id="forword" style="display: none;">
                    <table class="table table-bordered table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th>{{ __('Sl No') }}</th>
                                <th>{{ __('File Name') }}</th>
                                <th>{{ __('Notes') }}</th>
                                <th>{{ __('Department') }}</th>
                                <th>{{ __('Section') }}</th>
                                <th>{{ __('duedate Date') }}</th>
                                <th>{{ __('remarks') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($file_forward as $index => $items)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $items->files->file_name }}</td>
                                <td>{!! $items->notes->description !!}</td>
                                <td>{{ $items->department->name }}</td>
                                <td>{{ $items->section->name }}</td>
                                <td>{{ $items->duedate }}</td>
                                <td>{{ $items->remarks }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <script>
                    document.getElementById('forwardFilesLink').addEventListener('click', function(event) {
                        event.preventDefault();
                        var notesTable = document.getElementById('forword');
                        if (notesTable.style.display === 'none') {
                            notesTable.style.display = 'block';
                        } else {
                            notesTable.style.display = 'none';
                        }
                    });
                </script>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="card-header">
                    <h4 class="card-title mb-0">{{ 'Receipt Inbox' }}</h4>
                </div>
                <div class="row mt-3">
                    <div class="col-sm-4">
                        <a href="{{ route('receipt.inbox') }}">
                            <div class="card card-body bg-blue-400 has-bg-image">
                                <div class="media">
                                    <div class="mr-3 align-self-center">
                                        <i class="icon-unlink2 icon-3x opacity-75"></i>
                                    </div>
                                    <div class="media-body text-right">
                                        <h3 class="mb-0">{{ count($receipt_inbox) }}</h3>
                                        <span class="text-uppercase font-size-xs">Total Received Receipt</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endrole
    </div>
</div>
<!-- [ Main Content ] end -->
@endsection

@push('style')
@include('layouts.includes.datatable_css')
<link href="{{ asset('css/custom.css') }}" rel="stylesheet">
@endpush

@section('javascript')
@role('admin')
<script src="{{ asset('js/Chart.min.js') }}"></script>
<script src="{{ asset('js/coreui-chartjs.bundle.js') }}"></script>
<script src="{{ asset('js/main.js') }}" defer></script>
<script>
    $(document).on("click", "#option2", function() {
        getChartData('year');
    });

    $(document).on("click", "#option1", function() {
        getChartData('month');
    });

    $(document).ready(function() {
        getChartData('month');
    });

    function getChartData(type) {
        $.ajax({
            url: "{{ route('get.chart.data') }}",
            type: 'POST',
            data: {
                type: type,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(result) {
                mainChart.data.labels = result.labels;
                mainChart.data.datasets[0].data = result.data;
                mainChart.update();
            },
            error: function(data) {
                console.log(data.responseJSON);
            }
        });
    }
</script>
<script src="https://cdn.datatables.net/2.1.0/js/dataTables.bootstrap5.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script>
    new DataTable('#example');
</script>
@endrole
@endsection