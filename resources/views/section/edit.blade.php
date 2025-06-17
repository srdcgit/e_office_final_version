@extends('layouts.admin')
@section('title', __('Edit Section '))
@section('breadcrumb')
<ul class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Dashboard') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('section.index') }}">{{ __('section') }}</a></li>
    <li class="breadcrumb-item">{{ __('Edit') }}
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
                    <h5> {{ __('Edit Section') }}</h5>
                </div>
                {{ Form::model($section, ['route' => ['section.update', $section->id], 'method' => 'PUT']) }}
                <div class="card-body">
                    <div class="form-group">
                        {{ Form::label('department_id', __('Department')) }}
                        <select name="department_id" id="department_id" class="form-control">
                            <option value="">Select Department</option>
                            @foreach($department as $departments)
                            <option value="{{ $departments->id }}" @if($section->department_id == $departments->id) selected @endif>{{ $departments->name }}</option>
                            @endforeach
                        </select>
                        @error('department_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        {{ Form::label('name', __('Name'), ['class' => 'form-label']) }}
                        {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => __('Enter Name')]) }}
                        @error('name')
                        <span class="invalid-name" role="alert">
                            <strong class="text-danger">{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="card-footer">
                    <div class="float-end">
                        <a href="{{ route('section.index') }}" class="btn btn-secondary mb-3">{{ __('Cancel') }}</a>
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
