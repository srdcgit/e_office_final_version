@php
use App\Models\Fileshare;
@endphp
<div class="notes-card">
    @if ($notes != null && Route::currentRouteName() == 'file.view' )
    <div class="notes-card-header">
        <h5>{{ __('Green Notes') }}</h5>
    </div>
    @else
    <div class="notes-card-header">
        <h5>{{ __('File Created') }}</h5>
    </div>
    @endif
    {{ Form::open(['route' => 'store.notes', 'method' => 'post']) }}
    <div class="notes-card-body">
        <input type="hidden" name="file_id" value="{{ $file->id }}">
        <ul class="notes-nav nav nav-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#greenNotesTab">{{ __('Green Notes') }}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#yellowNotesTab">{{ __('Yellow Notes') }}</a>
            </li>
            {{-- <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#templateTab">{{ __('Template') }}</a>
            </li> --}}
            @if ($gnotes != null)
            <li class="nav-item">
                <a class="nav-link" href="{{ route('file.share', $gnotes->id) }}">{{ __('Send') }}</a>
            </li>
            @endif
        </ul>

        <div class="tab-content">
            <div id="greenNotesTab" class="tab-pane active">
                <br>
                @php
                $description = $gnotes->description ?? '';
                $id = $gnotes->id ?? '';
                @endphp
                <div class="form-group">
                    <label for="gdescription">{{ __('Green Notes') }}</label>
                    <button type="button" class="btn btn-primary float-right"
                        id="upload">{{ __('Upload From Template') }}</button>
                    <div class="row d-none" id="uploadtemplate">
                        <br>
                        <div class="col-md-3">
                            {{ Form::label('category', __('Category')), ['class' => 'form-label'] }}
                            <select name="category_id" id="category" class="form-control">
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>

                            @error('category')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            {{ Form::label('subcategory_id', __('SubCategory')), ['class' => 'form-label'] }}
                            <select name="subcategory_id" id="subcategory" class="form-control">
                                <option value="">Select SubCategory</option>
                            </select>
                            @error('subcategory')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            {{ Form::label('template', __('Template')), ['class' => 'form-label'] }}
                            <select name="template" id="template" class="form-control">
                                <option value="">Select Template</option>
                            </select>
                        </div>
                    </div>
                    {{ Form::textarea('gdescription', $description, ['class' => 'form-control ckeditor-textarea', 'id' => 'gdescription', 'rows' => '8']) }}
                    @error('description')
                    <span class="invalid-name" role="alert">
                        <strong class="text-danger">{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                @if($file_share != null)
                    @if($file_share->status >= 1 && $file_share->sender_id != Auth::user()->id && $file_share->actiontype == \App\Models\Fileshare::EDIT)
                    <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                    <a class="btn btn-secondary" href="{{ route('discard.notes', $id) }}">{{ __('Discard') }}</a>
                    @elseif(Route::currentRouteName() == 'file.view')
                    <a class="btn btn-secondary" href="{{ route('discard.notes', $id) }}">{{ __('Discard') }}</a>
                    @endif
                @else
                    <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                    <a class="btn btn-secondary" href="{{ route('discard.notes', $id) }}">{{ __('Discard') }}</a>
                @endif

            </div>
            <div id="yellowNotesTab" class="tab-pane fade">
                <br>
                @php
                $ydescription = $ynotes->description ?? '';
                $yid = $ynotes->id ?? '';
                @endphp
                <div class="form-group">
                    <label for="ydescription">{{ __('Yellow Notes') }}</label>
                    {{ Form::textarea('ydescription', $ydescription, ['class' => 'form-control ckeditor-textarea', 'id' => 'ydescription', 'rows' => '8']) }}
                    @error('description')
                    <span class="invalid-name" role="alert">
                        <strong class="text-danger">{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                    <a class="btn btn-secondary"
                        href="{{ route('discard.notes', $yid) }}">{{ __('Discard') }}</a>
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
</div>