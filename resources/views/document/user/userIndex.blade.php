@extends('layouts.fileLayout')
@section('file_title', 'Document Index')

@section('file_content')
{{ $dataTable->table(['width' => '100%']) }}
@endsection

@push('style')
@include('layouts.includes.datatable_css')
<link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome.css') }}">

@endpush
@push('scripts')
@include('layouts.includes.datatable_js')
{{ $dataTable->scripts() }}
@endpush