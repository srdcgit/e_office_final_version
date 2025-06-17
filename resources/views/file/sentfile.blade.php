@extends('layouts.admin')
@section('title', __('File '))
@section('breadcrumb')
<ul class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Dashboard') }}</a></li>
    <li class="breadcrumb-item">{{ __('File') }}
    </li>
</ul>
@endsection

@section('content')
<!-- @section('breadcrumb')
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Dashboard') }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('file.index') }}">{{ __('File') }}</a></li>
        <li class="breadcrumb-item">{{ __('Sent') }}</li>
    </ul>
@endsection -->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="sent-card-body">
                <div class="table-responsive py-5 pb-4 dropdown_2">
                    <div class="container-fluid">
                        {{ $dataTable->table(['width' => '100%']) }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
@push('style')
@include('layouts.includes.datatable_css')
<link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome.css') }}">
@endpush
@push('scripts')
@include('layouts.includes.datatable_js')
{{ $dataTable->scripts() }}
@endpush