@extends('layouts.admin')
@section('title', __('Create Ministry '))
@section('breadcrumb')
<ul class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Dashboard') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('ministry.index') }}">{{ __('Ministry') }}</a></li>
    <li class="breadcrumb-item">{{ __('Ministry') }}
    </li>
</ul>
@endsection
@section('content')
<div class="row">
    <div class="section-body">
        <div class="col-md-4 m-auto">
            <div class="card ">
                <div class="card-header">
                    <h5> {{ __('Create Ministry') }}</h5>
                </div>
                {{ Form::open(['url' => 'ministry', 'method' => 'post']) }}
                <div class="card-body">
                    <div class="form-group">
                        {{ Form::label('ministryname', __('Ministry'), ['class' => 'form-label']) }}
                        {{ Form::text('ministryname', null, ['class' => 'form-control', 'placeholder' => __('Enter Ministry')]) }}
                        @error('ministryname')
                        <span class="invalid-name" role="alert">
                            <strong class="text-danger">{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="card-footer">
                    <div class="float-end">
                        <a href="{{ route('ministry.index') }}" class="btn btn-secondary mb-3">{{ __('Cancel') }}</a>
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
</div>
</div>
@endsection

