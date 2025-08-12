@php
    use App\Models\Fileshare;
@endphp
<div class="notes-card" id="mainContainer" style="background-color: #b8dbb8;  padding: 10px;">
    <div class="notes-buttons" style="margin-bottom: 10px;">
        <button type="button" class="btn btn-success" id="addGreenNote" style="margin-right: 10px;">
            <i class="fas fa-plus"></i> Add Green Note
        </button>
        <button type="button" class="btn btn-warning" id="addYellowNote">
            <i class="fas fa-plus"></i> Add Yellow Note
        </button>
        {{-- @if ($gnotes != null)
        <button type="button" class="btn btn-warning" id="addYellowNote">
            <a class="nav-link" href="{{ route('file.share', $gnotes->id) }}">{{ __('Send') }}</a>
        </button>
        @endif --}}
    </div>

    {{ Form::open(['route' => 'store.notes', 'method' => 'post']) }}
    <input type="hidden" name="file_id" value="{{ $file->id }}">

    <div id="greenNoteEditor" style="display: none; background-color: #b8dbb8; ">
        @php
            $description = $gnotes->description ?? '';
            $id = $gnotes->id ?? '';
        @endphp
        <div class="form-group">
            {{ Form::textarea('gdescription', $description, ['class' => 'form-control', 'id' => 'gdescription', 'rows' => '8', 'style' => 'background-color: #b8dbb8;']) }}
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
            <button type="button" class="btn btn-secondary closeEditor">{{ __('Close') }}</button>
        </div>
    </div>

    <div id="yellowNoteEditor" style="display: none; background-color: #f3e99f; ">
        @php
            $ydescription = $ynotes->description ?? '';
            $yid = $ynotes->id ?? '';
        @endphp
        <div class="form-group">
            {{ Form::textarea('ydescription', $ydescription, ['class' => 'form-control', 'id' => 'ydescription', 'rows' => '8', 'style' => 'background-color: #f3e99f;']) }}
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
            <button type="button" class="btn btn-secondary closeEditor">{{ __('Close') }}</button>
        </div>
    </div>
    {!! Form::close() !!}
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let greenEditor = null;
        let yellowEditor = null;
        const mainContainer = document.getElementById('mainContainer');
        const leftpanel = document.getElementById('left-panel');

        // Function to set CKEditor background color
        function setCKEditorStyles(editor, backgroundColor) {
            if (editor && editor.document && editor.document.$) {
                editor.document.$.body.style.backgroundColor = backgroundColor;
                editor.document.$.body.style.color = '#000000';

                // Add custom CSS to style the editor container
                const editorElement = editor.element.$;
                editorElement.style.backgroundColor = backgroundColor;

                // Style the CKEditor iframe container
                const editorContainer = editor.container.$;
                if (editorContainer) {
                    editorContainer.style.backgroundColor = backgroundColor;
                }
            }
        }

        // Add Green Note button click handler
        document.getElementById('addGreenNote').addEventListener('click', function() {
            document.getElementById('greenNoteEditor').style.display = 'block';
            document.getElementById('yellowNoteEditor').style.display = 'none';
            mainContainer.style.backgroundColor = '#b8dbb8';
            leftpanel.style.backgroundColor = '#b8dbb8';
            if (!greenEditor) {
                greenEditor = CKEDITOR.replace('gdescription', {
                    on: {
                        instanceReady: function(ev) {
                            setCKEditorStyles(greenEditor, '#b8dbb8');
                        }
                    }
                });
            }
            if (yellowEditor) {
                yellowEditor.destroy();
                yellowEditor = null;
            }
        });

        // Add Yellow Note button click handler
        document.getElementById('addYellowNote').addEventListener('click', function() {
            document.getElementById('yellowNoteEditor').style.display = 'block';
            document.getElementById('greenNoteEditor').style.display = 'none';
            mainContainer.style.backgroundColor = '#f3e99f';
            leftpanel.style.backgroundColor = '#f3e99f';
            if (!yellowEditor) {
                yellowEditor = CKEDITOR.replace('ydescription', {
                    on: {
                        instanceReady: function(ev) {
                            setCKEditorStyles(yellowEditor, '#f3e99f');
                        }
                    }
                });
            }
            if (greenEditor) {
                greenEditor.destroy();
                greenEditor = null;
            }
        });

        // Close button handlers
        document.querySelectorAll('.closeEditor').forEach(button => {
            button.addEventListener('click', function() {
                const parentEditor = this.closest('div[id$="Editor"]');
                parentEditor.style.display = 'none';
                if (parentEditor.id === 'greenNoteEditor' && greenEditor) {
                    greenEditor.destroy();
                    greenEditor = null;
                } else if (parentEditor.id === 'yellowNoteEditor' && yellowEditor) {
                    yellowEditor.destroy();
                    yellowEditor = null;
                }
            });
        });
    });
</script>
