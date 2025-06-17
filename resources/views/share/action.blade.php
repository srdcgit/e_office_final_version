<div class="dropdown dash-h-item">
    <button class="custom_btn btn btn-primary dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        {{ __('Action') }}</button>

    <!-- <div class="dropdown-menu" x-placement="bottom-start">

        {{-- <div class="dropdown-divider"></div>  --}}
        <a href="{{ route('share.index') }}" class="dropdown-item  text-danger" data-toggle="tooltip" data-original-title="{{ __('Delete') }}" onclick="delete_record('delete-form-{{ $share->id }}')"><i class="ti ti-trash action-btn"></i>{{ __('Delete') }}</a>
        {!! Form::open(['method' => 'DELETE', 'route' => ['share.destroy', $share->id], 'id' => 'delete-form-' . $share->id]) !!}
        {!! Form::close() !!}
    </div> -->
</div>
