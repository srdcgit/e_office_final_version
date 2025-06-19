@extends('layouts.fileLayout')
@section('file_title', 'File Notes')
@section('file_content')

<div class="row">
    <div class="col-lg-12">
        <div id="resizable-container" style="display: flex; width: 100%; min-height: 500px;">
            {{-- coloumn 1  --}}
            <div id="left-panel" style="flex: 1 1 0; min-width: 200px; background: #f6fff6; transition: flex-basis 0.2s;">
                <button id="expand-left" class="expand-btn" title="Expand Left Panel">
                    <i class="fas fa-expand"></i>
                </button>
                @include('file.ckeditor')
            </div>
            <div id="divider" style="width: 16px; cursor: ew-resize; display: flex; align-items: center; justify-content: center; background: #eee; border-left: 1px solid #ccc; border-right: 1px solid #ccc; position: relative; z-index: 2;">
                <span style="display: block; width: 28px; height: 28px; background: #fffbe6; border-radius: 50%; box-shadow: 0 1px 4px #ccc; display: flex; align-items: center; justify-content: center; border: 1px solid #e0c97f;">
                    <i class="fas fa-grip-lines-vertical" style="color: #bfa13a;"></i>
                </span>
            </div>
            {{-- coloumn 2  --}}
            <div id="right-panel" style="flex: 1 1 0; min-width: 200px; background: #fff; transition: flex-basis 0.2s;">
                <div class="card">
                    <div class="notes-card-header">
                        <h5>{{ __('List Of Correspondences') }} </h5>
                        @if($file_share != null)
                        @if($file_share->status >= 1 && $file_share->sender_id != Auth::user()->id && $file_share->actiontype == \App\Models\Fileshare::EDIT)
                        <div class="dropdown ">
                            <button class="btn btn-secondary dropdown-toggle mt-0 p-1" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ __('All') }}
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item" href="#" id="showReceipt">{{ __('Receipt') }}</a></li>
                                <li><a class="dropdown-item" href="#" id="shownotes">{{ __('Previous Notes') }}</a></li>
                                <li><a class="dropdown-item" href="#" id="file">{{ __('Document Details') }}</a></li>
                            </ul>
                        </div>
                        @endif
                        @else
                        <div class="dropdown ">
                            <button class="btn btn-secondary dropdown-toggle mt-0 p-1" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ __('All') }}
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item" href="#" id="showReceipt">{{ __('Receipt') }}</a></li>
                                <li><a class="dropdown-item" href="#" id="shownotes">{{ __('Previous Notes') }}</a></li>
                                <li><a class="dropdown-item" href="#" id="file">{{ __('Document Details') }}</a></li>
                            </ul>
                        </div>
                        @endif
                    </div>
                    <div class="corespondense-card-body h-66">
                        <div id="table">
                            <h4>Receipts</h4>
                            <table class="table table-bordered table-hover">
                                <thead class="thead-light">
                                    <tr>
                                        <th>{{ __('Receipt/Issue No') }}</th>
                                        <th>{{ __('Subject') }}</th>
                                        <th>{{ __('Attachment') }}</th>
                                        <th>{{ __('Issue On') }}</th>
                                        <th>{{ __('Remarks') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($correspondence as $correspondences)
                                    @if ($correspondences->receipt_id != null)
                                    <tr>
                                        <td>{{ $correspondences->receipt->dairy_date }}</td>
                                        <td>{{ $correspondences->receipt->subject }}</td>
                                        <td>{{ $correspondences->receipt->receved_date }}</td>
                                        <td>{{ $correspondences->receipt->letter_ref_no }}</td>
                                        <td>{{ $correspondences->receipt->remarks }}</td>
                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div id="documenttable">
                            <h4>Documents</h4>
                            <table class="table table-bordered table-hover">
                                <thead class="thead-light">
                                    <tr>
                                        <th>{{ __('File name') }}</th>
                                        <th>{{ __('Dtype') }}</th>
                                        <th>{{ __('Document name') }}</th>
                                        <th>{{ __('Metatitle') }}</th>
                                        <th>{{ __('Documentpath') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($correspondence as $correspondences)
                                    @if ($correspondences->doc_id != null && $correspondences->document != null)
                                    <tr>
                                        <td>{{ $correspondences->file->file_name }}</td>
                                        <td>{{ $correspondences->document->dtype }}</td>
                                        <td>{{ $correspondences->document->document_name }}</td>
                                        <td>{{ $correspondences->document->meta_title }}</td>
                                        <td>{{ $correspondences->document->documentpath }}</td>
                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div id="notesttable">
                            <h4>Notes</h4>
                            <table class="table table-bordered table-hover">
                                <thead class="thead-light">
                                    <tr>
                                        <th>{{ __('Notes name') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($correspondence as $correspondences)
                                    @if ($correspondences->notes_id != null)
                                    <tr>
                                        <td>{!! $correspondences->notes->description !!}</td>
                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div id="receipttable" style="display: none;">
                            <table class="table table-bordered table-hover">
                                <thead class="thead-light">
                                    <tr>
                                        <th>{{ __('Select') }}</th>
                                        <th>{{ __('Receipt/Issue No') }}</th>
                                        <th>{{ __('Subject') }}</th>
                                        <th>{{ __('Attachment') }}</th>
                                        <th>{{ __('Issue On') }}</th>
                                        <th>{{ __('Remarks') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{ Form::open(['route' => 'correspondance.store', 'method' => 'post']) }}
                                    @foreach ($receipt as $receipts)
                                    <tr>
                                        <td><input type="checkbox" name="receipt_id[]" value="{{ $receipts->id }}">
                                        </td>
                                        <td>{{ $receipts->dairy_date }}</td>
                                        <td>{{ $receipts->subject }}</td>
                                        <td>{{ $receipts->receved_date }}</td>
                                        <td>{{ $receipts->letter_ref_no }}</td>
                                        <td>{{ $receipts->remarks }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="col-md-2 mt-3" id="add" style="display: none;">
                                <input type="hidden" name="file_id" id="file" value="{{ $file->id }}">
                                <button type="submit" class="btn btn-primary btn-block">{{ __('Add Receipt') }}</button>
                            </div>
                            {!! Form::close() !!}
                        </div>

                        <div id="filettable" style="display: none;">
                            <button type="submit" onClick="refreshPage()" id="reload"
                                class="btn btn-primary">Refresh</button>
                            <table class="table table-bordered table-hover">
                                <thead class="thead-light">
                                    <tr>
                                        <th>{{ __('Select') }}</th>
                                        <th>{{ __('Dtype') }}</th>
                                        <th>{{ __('Document Name') }}</th>
                                        <th>{{ __('Metatitle') }}</th>
                                        <th>{{ __('Documentpath') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{ Form::open(['route' => 'correspondance.store', 'method' => 'post']) }}
                                    @if ($document != null)
                                    @foreach ($document as $documents)
                                    <tr>
                                        <td><input type="checkbox" name="document_id[]"
                                                value="{{ $documents->id }}">
                                        </td>
                                        <td>{{ $documents->dtype }}</td>

                                        @if ($documents->dtype == 'create')
                                        <td>{{ $documents->document_name }}</td>
                                        @elseif ($documents->dtype == 'upload')
                                        <td>{{ $documents->uploadmetatitle }}</td>
                                        @endif

                                        <td>{{ $documents->meta_title }}</td>
                                        <td>{{ $documents->documentpath }}</td>
                                    </tr>
                                    @endforeach
                                    @endif


                                </tbody>
                            </table>
                            <div class="col-md-2 mt-3" id="add">
                                <input type="hidden" name="file_id" id="file" value="{{ $file->id }}">
                                <button type="submit" class="btn btn-primary btn-block">
                                    <i class="fas fa-plus"></i> {{ __('Add Document') }}
                                </button>
                                <div class="row mt-2">
                                    <a href="{{ route('document.create') }}" class="btn btn-success btn-block"
                                        target="_blank">
                                        <i class="fas fa-file-alt"></i> {{ __('Create Document') }}
                                    </a>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                        <div id="greenNotesSection" style="display: none;">
                            <table class="table table-bordered table-hover">
                                <thead class="thead-light">
                                    <tr>
                                        <th>{{ __('Select') }}</th>
                                        <th>{{ __('Green Notes') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{ Form::open(['route' => 'correspondance.store', 'method' => 'post']) }}
                                    @foreach ($greennote as $greennotes)
                                    <tr>
                                        <td><input type="checkbox" name="note_id[]" value="{{ $greennotes->id }}">
                                        <td>{!! $greennotes->description !!}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="col-md-2 mt-3" id="add">
                                <input type="hidden" name="file_id" id="file" value="{{ $file->id }}">
                                <button type="submit" class="btn btn-primary btn-block">{{ __('Add Notes') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    #resizable-container {
        min-width: 400px;
        max-width: 100vw;
        height: 70vh;
        background: #f8f9fa;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        overflow: hidden;
    }
    #divider {
        min-width: 16px;
        max-width: 24px;
        background: #eee;
        cursor: ew-resize;
        user-select: none;
        z-index: 10;
        transition: background 0.2s;
    }
    #divider:hover span {
        background: #ffe066;
        border-color: #e0c97f;
    }
    #divider span {
        margin: 0 auto;
        transition: background 0.2s, border-color 0.2s;
    }
    #left-panel, #right-panel {
        transition: flex-basis 0.2s, width 0.2s;
        overflow: auto;
    }
    @media (max-width: 900px) {
        #resizable-container { flex-direction: column; height: auto; }
        #divider { display: none; }
        #left-panel, #right-panel { min-width: 100px; width: 100% !important; }
    }
    .expand-btn {
        position: absolute;
        top: 8px;
        right: 8px;
        z-index: 20;
        background: #fffbe6;
        border: 1px solid #e0c97f;
        border-radius: 50%;
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        box-shadow: 0 1px 4px #ccc;
    }
    #left-panel, #right-panel {
        position: relative;
    }
</style>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="{{ asset('assets/ckeditor/ckeditor.js') }}"></script>
<script>
$(document).ready(function() {
    CKEDITOR.replace('ydescription');

    // Resizable divider logic
    const container = document.getElementById('resizable-container');
    const left = document.getElementById('left-panel');
    const right = document.getElementById('right-panel');
    const divider = document.getElementById('divider');
    let isDragging = false;

    divider.addEventListener('mousedown', function(e) {
        isDragging = true;
        document.body.style.cursor = 'ew-resize';
        document.body.style.userSelect = 'none';
    });
    document.addEventListener('mousemove', function(e) {
        if (!isDragging) return;
        const rect = container.getBoundingClientRect();
        let offsetX = e.clientX - rect.left;
        // Minimum and maximum widths
        const min = 180;
        const max = rect.width - 180;
        if (offsetX < min) offsetX = min;
        if (offsetX > max) offsetX = max;
        left.style.flex = 'none';
        right.style.flex = 'none';
        left.style.width = offsetX + 'px';
        right.style.width = (rect.width - offsetX - divider.offsetWidth) + 'px';
    });
    document.addEventListener('mouseup', function(e) {
        if (isDragging) {
            isDragging = false;
            document.body.style.cursor = '';
            document.body.style.userSelect = '';
        }
    });

    // Existing dropdown functionality
    $('#showReceipt').on('click', function(event) {
        event.preventDefault();
        $('#receipttable').show();
        $('#table').hide();
        $('#add').show();
        $('#reload').hide();
        $('#documenttable').hide();
        $('#notesttable').hide();
        $('#greenNotesSection').hide();
        $('#filettable').hide();
    });
    $('#shownotes').on('click', function(event) {
        event.preventDefault();
        $('#receipttable').hide();
        $('#add').hide();
        $('#table').hide();
        $('#reload').hide();
        $('#documenttable').hide();
        $('#notesttable').hide();
        $('#greenNotesSection').show();
        $('#filettable').hide();
    });
    $('#file').on('click', function(event) {
        event.preventDefault();
        $('#receipttable').hide();
        $('#add').show();
        $('#table').hide();
        $('#reload').show();
        $('#documenttable').hide();
        $('#notesttable').hide();
        $('#filettable').show();
        $('#greenNotesSection').hide();
    });

    let expanded = null; // 'left', 'right', or null

    $('#expand-left').on('click', function() {
        if (expanded === 'left') {
            // Restore
            $('#left-panel').css({ width: '', flex: '1 1 0' });
            $('#right-panel').css({ width: '', flex: '1 1 0', display: '' });
            $('#divider').show();
            $(this).find('i').removeClass('fa-compress').addClass('fa-expand');
            expanded = null;
        } else {
            // Expand left
            $('#left-panel').css({ width: 'calc(100% - 16px)', flex: 'none' });
            $('#right-panel').css({ display: 'none' });
            $('#divider').hide();
            $(this).find('i').removeClass('fa-expand').addClass('fa-compress');
            $('#expand-right').find('i').removeClass('fa-compress').addClass('fa-expand');
            expanded = 'left';
        }
    });

    $('#expand-right').on('click', function() {
        if (expanded === 'right') {
            // Restore
            $('#right-panel').css({ width: '', flex: '1 1 0' });
            $('#left-panel').css({ width: '', flex: '1 1 0', display: '' });
            $('#divider').show();
            $(this).find('i').removeClass('fa-compress').addClass('fa-expand');
            expanded = null;
        } else {
            // Expand right
            $('#right-panel').css({ width: 'calc(100% - 16px)', flex: 'none' });
            $('#left-panel').css({ display: 'none' });
            $('#divider').hide();
            $(this).find('i').removeClass('fa-expand').addClass('fa-compress');
            $('#expand-left').find('i').removeClass('fa-compress').addClass('fa-expand');
            expanded = 'right';
        }
    });
});
</script>
<script>
    // Include jQuery library in your HTML
    $(document).ready(function() {
        $('#category').change(function() {
            var categoryId = $(this).val();
            $.ajax({
                url: "{{ url('get-subcategory') }}",
                type: 'GET',
                data: {
                    category_id: categoryId,
                },
                success: function(response) {
                    console.log(response);
                    var subcategories = response;
                    $('#subcategory').empty();
                    $('#subcategory').append(
                        '<option value="">Select Subcategory</option>');
                    $.each(subcategories, function(index, subcategory) {
                        $('#subcategory').append('<option value="' + subcategory
                            .id + '">' + subcategory.name + '</option>');
                    });
                },
                error: function(xhr, status, error) {

                }
            });
        });
        $('#subcategory').change(function() {
            var sub_id = $(this).val();
            $.ajax({
                url: "{{ url('get-template') }}",
                type: 'GET',
                data: {
                    sub_id: sub_id,
                },
                success: function(response) {
                    console.log(response);
                    var subcategory = response;
                    $('#template').empty();
                    $('#template').append('<option value="">Select Template</option>');
                    $.each(subcategory, function(index, subcategory) {
                        $('#template').append('<option value="' + subcategory.id +
                            '">' + subcategory.title + '</option>');
                    });
                },
                error: function(xhr, status, error) {

                }
            });
        });
    });
</script>
<script>
    $(document).ready(function() {
        var tdescriptionInstance = CKEDITOR.replace('gdescription');
        $('#upload').click(function() {
            $('#uploadtemplate').toggleClass('d-none');
        });
        $('#template').change(function() {
            var tem_id = $(this).val();
            $.ajax({
                url: "{{ url('get-description') }}",
                type: 'GET',
                data: {
                    tem_id: tem_id
                },
                success: function(response) {
                    if (response.description) {
                        tdescriptionInstance.setData(response.description);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching data:', error);
                }
            });
        });
    });
</script>
<script>
    function refreshPage() {
        window.location.reload();
    }
</script>
@endsection