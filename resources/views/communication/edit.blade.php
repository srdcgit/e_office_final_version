@extends('layouts.admin')
@section('title', __('Edit Communication '))
@section('breadcrumb')
<ul class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Dashboard') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('communication.index') }}">{{ __('Communication') }}</a></li>
    <li class="breadcrumb-item">{{ __('Edit') }}
    </li>
</ul>
@endsection
@section('content')
<div class="row">
    <div class="section-body">
        <div class="col-md-4 m-auto">
            <div class="card ">
                <div class="card-header">
                    <h5> {{ __('Edit Communication') }}</h5>
                </div>
                {{ Form::model($communication, ['route' => ['communication.update', $communication->id], 'method' => 'PUT']) }}

                <div class="card-body">
                    <div class="form-group">
                        <strong> {{ Form::label('communication', __('Communication'), ['class' => 'form-label']) }} </strong>
                        {{ Form::text('communication', null, ['class' => 'form-control', 'placeholder' => __('Enter Communication Name')]) }}
                        @error('communication')
                        <span class="invalid-name" role="alert">
                            <strong class="text-danger">{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                   
                </div>
                <div class="card-footer">
                    <div class="float-end">
                        <a href="{{ route('communication.index') }}" class="btn btn-secondary mb-3">{{ __('Cancel') }}</a>
                        <button type="submit" class="btn btn-primary mb-3">{{ __('Update') }}</button>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
