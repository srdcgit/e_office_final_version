@extends('layouts.admin')
@section('title', __('Edit Ministry '))
@section('breadcrumb')
<ul class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Dashboard') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('ministry.index') }}">{{ __('Ministry') }}</a></li>
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
                    <h5> {{ __('Edit Ministry') }}</h5>
                </div>
                {{ Form::model($ministry, ['route' => ['ministry.update', $ministry->id], 'method' => 'PUT']) }}

                <div class="card-body">
                    <div class="form-group">
                        <strong> {{ Form::label('ministryname', __('Ministryname'), ['class' => 'form-label']) }} </strong>
                        {{ Form::text('ministryname', null, ['class' => 'form-control', 'placeholder' => __('Enter Sendertype')]) }}
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
                        <button type="submit" class="btn btn-primary mb-3">{{ __('Update') }}</button>
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
