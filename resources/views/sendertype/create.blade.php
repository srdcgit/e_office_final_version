@extends('layouts.admin')
@section('title', __('Create Sendertype '))
@section('breadcrumb')
<ul class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Dashboard') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('permission.index') }}">{{ __('Sendertype') }}</a></li>
    <li class="breadcrumb-item">{{ __('Sendertype') }}
    </li>
</ul>
@endsection
@section('content')
<div class="row">
    <div class="section-body">
        <div class="col-md-4 m-auto">
            <div class="card ">
                <div class="card-header">
                    <h5> {{ __('Create Sendertype') }}</h5>
                </div>
                {{ Form::open(['url' => 'sendertype', 'method' => 'post']) }}
                <div class="card-body">
                    <div class="form-group">
                        {{ Form::label('sendertype', __('Sendertype'), ['class' => 'form-label']) }}
                        {{ Form::text('sendertype', null, ['class' => 'form-control', 'placeholder' => __('Enter Sendertype')]) }}
                        @error('sendertype')
                        <span class="invalid-name" role="alert">
                            <strong class="text-danger">{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="card-footer">
                    <div class="float-end">
                        <a href="{{ route('sendertype.index') }}" class="btn btn-secondary mb-3">{{ __('Cancel') }}</a>
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

