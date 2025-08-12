@extends('layouts.admin')
@section('title', __('File '))
@section('breadcrumb')
<ul class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Dashboard') }}</a></li>
    <li class="breadcrumb-item">{{ __('File') }}
    </li>
</ul>
@endsection

@section('content')
<!-- @section('breadcrumb')
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Dashboard') }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('file.index') }}">{{ __('File') }}</a></li>
        <li class="breadcrumb-item">{{ __('Sent') }}</li>
    </ul>
@endsection -->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="sent-card-body">
                <div class="table-responsive py-5 pb-4 dropdown_2">
                    <div class="container-fluid">
                        {{ $dataTable->table(['width' => '100%']) }}

                        <!-- Pull Back Reason Modal -->
                        <div class="modal fade" id="pullBackModal" tabindex="-1" aria-labelledby="pullBackModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="pullBackModalLabel">Pull Back Reason</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                <div class="mb-3">
                                  <label for="pullback-reason" class="form-label">Reason (optional)</label>
                                  <textarea id="pullback-reason" class="form-control" rows="3"></textarea>
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-danger" id="confirm-pullback">Pull Back</button>
                              </div>
                            </div>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
@push('style')
@include('layouts.includes.datatable_css')
<link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome.css') }}">
@endpush
@push('scripts')
@include('layouts.includes.datatable_js')
{{ $dataTable->scripts() }}
<script>
    document.addEventListener('click', function(e) {
        const target = e.target.closest('.pullback-btn');
        if (!target) return;
        const id = target.getAttribute('data-id');
        const modal = new bootstrap.Modal(document.getElementById('pullBackModal'));
        document.getElementById('confirm-pullback').onclick = function() {
            const reason = document.getElementById('pullback-reason').value;
            fetch(`{{ route('fileshares.pullback', ':id') }}`.replace(':id', id), {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: new URLSearchParams({ reason })
            }).then(async res => {
                if (res.ok) {
                    modal.hide();
                    window.LaravelDataTables['file-table'].ajax.reload();
                } else {
                    const data = await res.json().catch(()=>({message:'Failed'}));
                    alert(data.message || 'Failed to pull back the file');
                }
            }).catch(() => alert('Failed to pull back the file'))
        }
        modal.show();
    });
</script>
@endpush