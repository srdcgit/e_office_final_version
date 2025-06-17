@extends('layouts.admin')
@section('title', __('Create Department '))
@section('breadcrumb')
<ul class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Dashboard') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('department.index') }}">{{ __('Department') }}</a></li>
    <li class="breadcrumb-item">{{ __('Department') }}
    </li>
</ul>
@endsection
@section('content')

<!-- [ breadcrumb ] end -->
<!-- [ Main Content ] start -->
<div class="row">
    <div class="section-body">
        <div class="col-md-4 m-auto">
            <div class="card ">
                <div class="card-header">
                    <h5> {{ __('Create Department') }}</h5>
                </div>
                {{ Form::open(['url' => 'department', 'method' => 'post']) }}
                <div class="card-body">
                    <div class="form-group">
                        {{ Form::label('name', __('Department Name'), ['class' => 'form-label']) }}
                        {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => __('Enter Department Name')]) }}
                        @error('name')
                        <span class="invalid-name" role="alert">
                            <strong class="text-danger">{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="card-footer">
                    <div class="float-end">
                        <a href="{{ route('department.index') }}" class="btn btn-secondary mb-3">{{ __('Cancel') }}</a>
                        <button type="submit" class="btn btn-primary mb-3">{{ __('Save') }}</button>
                    </div>
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
<!-- [ sample-page ] end -->
</div>
<!-- [ Main Content ] end -->


@endsection
