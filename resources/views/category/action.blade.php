<div class="dropdown dash-h-item">
    <button class="custom_btn btn btn-primary dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        {{ __('Action') }}</button>

    <div class="dropdown-menu" x-placement="bottom-start">
        <a href="{{ route('category.edit', $category->id) }}" class=" dropdown-item">
            <i class="ti ti-edit action-btn"></i>{{ __('Edit') }}
        </a>
        {{--  <div class="dropdown-divider"></div>  --}}
        <a href="{{ route('category.index') }}" class="dropdown-item  text-danger" data-toggle="tooltip"
            data-original-title="{{ __('Delete') }}" onclick="delete_record('delete-form-{{ $category->id }}')"><i
                class="ti ti-trash action-btn"></i>{{ __('Delete') }}</a>
        {!! Form::open(['method' => 'DELETE', 'route' => ['category.destroy', $category->id], 'id' => 'delete-form-' . $category->id]) !!}
        {!! Form::close() !!}
    </div>
</div>
