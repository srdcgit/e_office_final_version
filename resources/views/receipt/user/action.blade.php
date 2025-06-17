<div class="dropdown dash-h-item">
    <button class="custom_btn btn btn-primary dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-haspopup="true"
        aria-expanded="false">
        {{ __('Action') }}</button>

    <div class="dropdown-menu bg-light" x-placement="bottom-start">

        <a href="{{ route('receipt.details.view', encrypt($receipt->id)) }}" class="dropdown-item">
            <i style="padding-right: 4%;" class="fa fa-eye action-btn"></i>{{ __('View') }}
        </a>
        <a href="{{ route('receipt.edit', $receipt->id) }}" class="dropdown-item">
            <i style="padding-right: 4%;" class="fa fa-edit action-btn"></i>{{ __('Edit') }}
        </a>
        <a href="{{ route('receipt.share', $receipt->id) }}" class="dropdown-item">
            <i style="padding-right: 4%;" class="fa fa-share-alt"></i>{{ __('Share') }}
        </a>

        {{-- <div class="dropdown-divider"></div>  --}}
        <a href="javascript:void(0);" class="dropdown-item text-danger" data-toggle="tooltip"
            data-original-title="{{ __('Delete') }}" onclick="delete_record('delete-form-{{ $receipt->id }}')">
            <i style="padding-right: 4%;" class="fa fa-trash action-btn"></i>{{ __('Delete') }}
        </a>

        {!! Form::open([
            'method' => 'DELETE',
            'route' => ['receipt.destroy', $receipt->id],
            'id' => 'delete-form-' . $receipt->id,
            'style' => 'display:none',
        ]) !!}
        {!! Form::close() !!}

    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function delete_record(formId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(formId).submit();
            }
        });
    }
</script>

