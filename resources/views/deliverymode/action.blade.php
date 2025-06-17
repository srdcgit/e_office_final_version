<div class="dropdown dash-h-item">
    <button class="custom_btn btn btn-primary dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        {{ __('Action') }}</button>

    <div class="dropdown-menu" x-placement="bottom-start">
        <a href="{{ route('deliverymode.edit', $deliverymode->id) }}" class=" dropdown-item">
            <i class="ti ti-edit action-btn"></i>{{ __('Edit') }}
        </a>
        {{--  <div class="dropdown-divider"></div>  --}}
        <a href="{{ route('deliverymode.index') }}" class="dropdown-item  text-danger" data-toggle="tooltip"
            data-original-title="{{ __('Delete') }}" onclick="delete_record('delete-form-{{ $deliverymode->id }}')"><i
                class="ti ti-trash action-btn"></i>{{ __('Delete') }}</a>
        {!! Form::open(['method' => 'DELETE', 'route' => ['deliverymode.destroy', $deliverymode->id], 'id' => 'delete-form-' . $deliverymode->id]) !!}
        {!! Form::close() !!}
    </div>
</div>
