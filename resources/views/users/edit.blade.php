@extends('layouts.admin')

@section('title', __('Edit User'))
@section('breadcrumb')
<ul class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Dashboard') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('users.index') }}">{{ __('Users') }}</a></li>
    <li class="breadcrumb-item">{{ __('Edit User') }}
    </li>
</ul>
@endsection

@section('content')

<!-- [ breadcrumb ] end -->
<!-- [ Main Content ] start -->
<div class="row">
    <div class="section-body">
        <div class="col-md-8 m-auto">
            <div class="card ">
                <div class="card-header">
                    <h5> {{ __('Edit User') }}</h5>
                </div>
                {!! Form::model($user, ['method' => 'PATCH', 'route' => ['users.update', $user->id]]) !!}
                <div class="card-body">
                    <div class="form-group">
                        {{ Form::label('name', __('Name'), ['class' => 'col-form-label']) }}
                        {!! Form::text('name', null, ['placeholder' => __('Name'), 'class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {{ Form::label('email', __('Email'), ['class' => 'col-form-label']) }}
                        {!! Form::text('email', null, ['placeholder' => __('Email'), 'class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {{ Form::label('phone', __('Phone'), ['class' => 'col-form-label']) }}
                        {!! Form::text('phone', null, ['placeholder' => __('Phone'), 'class' => 'form-control']) !!}
                    </div>
                    <div class="form-group ">
                        {{ Form::label('role', __('Role'), ['class' => 'col-form-label']) }}
                        {!! Form::select('roles', $roles, $userRole, ['class' => 'form-control', 'id' => 'choices-single-default','data-trigger']) !!}
                    </div>
                    <div class="form-group">
                        {{ Form::label('department_id', __('Department'),['class' => 'form-label']) }}
                        <select name="department_id" id="department" class="form-control">
                            <option value="">Select Department</option>
                            @foreach($department as $departments)
                            <option value="{{ $departments->id }}" @if($user->department_id == $departments->id) selected @endif>{{ $departments->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        {{ Form::label('section_id', __('Section'),['class' => 'form-label']) }}
                        <select name="section_id" id="section_id" class="form-control">
                            <option value="">Select Section</option>
                            @foreach($section as $sections)
                            <option value="{{ $sections->id }}" @if($user->section_id == $sections->id) selected @endif>{{ $sections->name }}</option>
                            @endforeach
                        </select>
                        @error('section_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="card-footer">
                    <div class="float-end">
                        <a href="{{ route('users.index') }}" class="btn btn-secondary mb-3">{{ __('Cancel') }}</a>
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

@push('scripts')
<script src="{{ asset('assets/js/plugins/choices.min.js') }}"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var genericExamples = document.querySelectorAll('[data-trigger]');
        for (i = 0; i < genericExamples.length; ++i) {
            var element = genericExamples[i];
            new Choices(element, {
                placeholderValue: 'This is a placeholder set in the config',
                searchPlaceholderValue: 'Select Option',
            });
        }
    });
</script>
@endpush