<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\User;
use App\Models\Notes;
use App\Models\Receipt;
use App\Models\Section;
use App\Models\Template;
use App\Models\Category;
use App\Models\Document;
use App\Models\Fileshare;
use App\Models\Department;
use App\Models\Subcategory;
use App\Models\Yellownotes;
use Illuminate\Http\Request;
use App\Models\Correspondence;
use App\DataTables\FileDataTable;
use Illuminate\Support\Facades\Auth;
use App\DataTables\FilesentDataTable;
use App\DataTables\FileinboxDataTable;
use App\DataTables\FilesearchDataTable;
use App\DataTables\GreennotesdataTable;
use App\DataTables\YellownotesdataTable;

class FileController extends Controller
{
    // protected $url = 'file';
    public function index(FileDataTable $table)
    {
        $files = File::where('createdBy', Auth::user()->id)
            ->orderBy('id', 'DESC')
            ->get();
        $url = 'file';
        if (\Auth::user()->hasRole('admin')) {
            return $table->render('file.index');
        } else {
            return $table->render('file.user.userIndex', compact('url'));
        }
    }

    public function create()
    {
        $url = 'file';
        $categories = Category::all();
        $department = Department::all();
        $file = File::all();
        $url = 'file';
        if (\Auth::user()->hasRole('admin')) {
            return view('file.create', compact('file', 'categories', 'department'));
        } else {
            return view('file.user.create', compact('url', 'file', 'categories', 'department'));
        }
    }
    public function store(Request $request)
    {
        $request->validate([
            'file_name' => 'required|max:40',
            'fileno' => 'required',
            'description' => 'required',
            'metatags' => 'required',
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'department_id' => 'required',
        ]);
        $userId = Auth::id();
        $document = new File();
        $document->createdBy = $userId;
        $document->file_name = $request->input('file_name');
        $document->file_type = $request->input('nature');
        $document->fileno = $request->input('fileno');
        $document->description = $request->input('description');
        $document->category_id = $request->input('category_id');
        $document->subcategory_id = $request->input('subcategory_id');
        $document->department_id = $request->input('department_id');
        $document->section_id = $request->input('section_id');
        $document->metatags = $request->input('metatags');
        $document->save();

        return redirect()->route('file.notes', $document->id)->with('success', 'File saved successfully.');
        // $publicPath = public_path('documents/' . $request->input('file_name'));
        // if (!file_exists($publicPath)) {

        //     if (mkdir($publicPath, 0755, true)) {

        //     } else {
        //         return redirect()->route('file.index')->with('error', 'Failed to create folder.');
        //     }
        // } else {
        //     return redirect()->route('file.index')->with('error', 'Folder already exists.');
        // }
    }

    public function edit(File $file)
    {
        $url = 'file';
        $categories = Category::all();
        $subcategory = Subcategory::all();
        $department = Department::all();
        $section = Section::all();
        return view('file.edit', compact('url', 'file', 'categories', 'subcategory', 'department', 'section'));
    }
    public function update(Request $request, File $File)
    {
        $file = File::findOrFail($File['id']);

        $request->validate([
            'file_name' => 'required|max:40',
            'fileno' => 'required',
            'description' => 'required',
            'metatags' => 'required',
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'department_id' => 'required',
        ]);

        $input = $request->all();
        $file->modifiedBy = Auth::user()->id;
        $file->fill($input)->save();

        return redirect()->route('file.index')->with(
            'success',
            'file ' . $file->name . ' updated!'
        );
    }

    public function destroy($id)
    {
        $file = File::find($id);
        $file->status = 0;
        $file->deletedBy = Auth::user()->id;
        $file->deleted_at = date('Y-m-d H:i:s');
        $file->save();

        return redirect()->route('file.index')->with('success', __('Document deleted successfully.'));
    }

    public function subcategory(Request $request)
    {
        $subcategory = Subcategory::where('category_id', $request->category_id)->get();

        if (count($subcategory) > 0) {
            return response()->json($subcategory);
        }
    }

    public function getsection(Request $request)
    {
        $section = Section::where('department_id', $request->department_id)->get();
        if (count($section) > 0) {
            return response()->json($section);
        }
    }

    public function gettemplate(Request $request)
    {
        $template = Template::where('subcategory_id', $request->sub_id)->get();
        if (count($template) > 0) {
            return response()->json($template);
        }
    }

    public function getdescription(Request $request)
    {
        $template = Template::where('id', $request->tem_id)->first();
        return response()->json($template);
    }

    public function file_notes($id)
    {
        $receipt = Receipt::all();
        $file = File::findOrFail($id);
        // dd($file);
        $gnotes = Notes::where('file_id', $id)->orderBy('id', 'DESC')->first();
        $ynotes = Yellownotes::where('file_id', $id)->orderBy('id', 'DESC')->first();
        $greennote = Notes::where('file_id', $id)->get();
        $correspondence = Correspondence::where('file_id', $id)->get();
        $document = Document::all();
        $categories = Category::all();
        $template = Template::all();
        $notes = Notes::where('file_id', $id)->first();
        $file_share =  Fileshare::where('file_id', $id)->latest()->first();
        $url = 'file';
        // dd($file_share);
        // $file_read_status = Fileshare::where('id', $file_share_id)
        //     ->where('file_id', $id)
        //     ->where('recever_id', Auth::id())
        //     ->latest('id')
        //     ->first();
        // if ($file_read_status) {
        //     $file_read_status->read_status = 1;
        //     $file_read_status->save();
        // }
        // dd($file_share);
        if ($file || $file_share) {
            if (\Auth::user()->hasRole('admin')) {
                return view('file.notes', compact('url', 'file_share', 'id', 'file', 'receipt', 'gnotes', 'ynotes', 'greennote', 'correspondence', 'document', 'template', 'categories', 'notes'));
            } else {
                return view('file.user.notes', compact('url', 'file_share', 'id', 'file', 'receipt', 'gnotes', 'ynotes', 'greennote', 'correspondence', 'document', 'template', 'categories', 'notes'));
            }
        } else {
            if (\Auth::user()->hasRole('admin')) {
                return view('file.notes', compact('url', 'file_share', 'id', 'file', 'receipt', 'gnotes', 'ynotes', 'greennote', 'correspondence', 'document', 'template', 'categories', 'notes'));
            } else {
                return view('file.user.notes', compact('url', 'file_share', 'id', 'file', 'receipt', 'gnotes', 'ynotes', 'greennote', 'correspondence', 'document', 'template', 'categories', 'notes'));
            }
        }
    }

    public function file_inbox_notes($id, $file_share_id)
    {
        $url = 'file';
        $receipt = Receipt::all();
        $file = File::findOrFail($id);
        $gnotes = Notes::where('file_id', $id)->orderBy('id', 'DESC')->first();
        $ynotes = Yellownotes::where('file_id', $id)->orderBy('id', 'DESC')->first();
        $greennote = Notes::where('file_id', $id)->get();
        $correspondence = Correspondence::where('file_id', $id)->get();
        $document = Document::all();
        $categories = Category::all();
        $template = Template::all();
        $notes = Notes::where('file_id', $id)->first();
        $file_share =  Fileshare::where('file_id', $id)->latest()->first();
        $file_read_status = Fileshare::where('id', $file_share_id)
            ->where('file_id', $id)
            ->where('recever_id', Auth::id())
            ->latest('id')
            ->first();
        if ($file_read_status) {
            $file_read_status->read_status = 1;
            $file_read_status->save();
        }
        // dd($file_share);
        if ($file || $file_share) {
            return view('file.notes', compact('url', 'file_share', 'id', 'file', 'receipt', 'gnotes', 'ynotes', 'greennote', 'correspondence', 'document', 'template', 'categories', 'notes'));
        } else {
            return view('file.notes', compact('url', 'id', 'file', 'receipt', 'gnotes', 'ynotes', 'greennote', 'correspondence', 'document', 'template', 'categories', 'notes'));
        }
    }

    public function viewfile($id, $file_share_id)
    {
        $url = 'file';
        $viewfile = Fileshare::find($file_share_id);
        $gnotes = Notes::where('file_id', $viewfile->file_id)->orderBy('id', 'DESC')->first();
        $categories = Category::all();
        $file_share =  Fileshare::where('file_id', $id)->latest()->first();
        $revert_file = Fileshare::where('sender_id', $viewfile->recever_id)->where('recever_id', $viewfile->sender_id)->latest()->first();
        $file = File::where('id', $viewfile->file_id)->first();
        $department = Department::all();
        $notes = Notes::where('id', $viewfile->gnotes_id)->first();
        $approvedNote = Notes::where('file_id', $viewfile->file_id)->where('approval_notes_status', 1)->get();
        $correspondence = Correspondence::where('file_id', $viewfile->file_id)->get();
        $check_revert = Fileshare::where('file_id', $id)->where('id', $file_share_id)->latest()->first();
        // dd($check_revert);
        $file_read_status = Fileshare::where('id', $file_share_id)
            ->where('file_id', $id)
            ->where('recever_id', Auth::id())
            ->latest('id')
            ->first();
        // dd($file_read_status);
        if ($file_read_status) {
            $file_read_status->read_status = 1;
            $file_read_status->save();
        }
        return view('file.shareviewfile', compact('url', 'check_revert', 'file_share', 'categories', 'gnotes', 'revert_file', 'viewfile', 'notes', 'correspondence', 'approvedNote', 'file', 'department'));
    }

    // public function store_notes(Request $request)
    // {
    //     // dd($request->all());
    //     $userId = Auth::id();
    //     $greennote = Notes::where('file_id', $request->file_id)->orderBy('id', 'DESC')->first();
    //     $yellownote = Yellownotes::where('file_id', $request->file_id)->orderBy('id', 'DESC')->first();

    //     if ($request->gdescription != null && ($greennote == null || $request->gdescription != $greennote->description)) {
    //         $notes = new Notes();
    //         $notes->createdBy = $userId;
    //         $notes->file_id = $request->file_id;
    //         $notes->description = $request->gdescription;
    //         $notes->save();
    //     }

    //     if ($request->ydescription != null && $yellownote == null) {
    //         $notes = new Yellownotes();
    //         $notes->file_id = $request->file_id;
    //         $notes->createdBy = $userId;
    //         $notes->description = $request->ydescription;
    //         $notes->save();
    //     }

    //     // if ($request->tdescription != null) {
    //     //     $tdescription = new Notes();
    //     //     $tdescription->createdBy = $userId;
    //     //     $tdescription->file_id = $request->file_id;
    //     //     $tdescription->description = $request->tdescription;
    //     //     $tdescription->save();
    //     //     // dd($tdescription);
    //     // }
    //     return redirect()->back()->with('status', 'Note saved successfully');
    // }
    public function store_notes(Request $request)
    {
        $userId = Auth::id();

        $greennote = Notes::where('file_id', $request->file_id)->orderBy('id', 'DESC')->first();
        $yellownote = Yellownotes::where('file_id', $request->file_id)->orderBy('id', 'DESC')->first();
        if ($request->gdescription != null) {
            if ($greennote == null) {

                $notes = new Notes();
            } else {

                $notes = $greennote;
            }
            $notes->createdBy = $userId;
            $notes->file_id = $request->file_id;
            $notes->description = $request->gdescription;
            $notes->save();
        }
        if ($request->ydescription != null) {
            if ($yellownote == null) {

                $notes = new Yellownotes();
            } else {

                $notes = $yellownote;
            }
            $notes->createdBy = $userId;
            $notes->file_id = $request->file_id;
            $notes->description = $request->ydescription;
            $notes->save();
        }
        return redirect()->back()->with('status', 'Note saved successfully');
    }

    public function discardnote($id)
    {
        $gnote = Notes::find($id);
        $ynote = Yellownotes::find($id);
        if ($gnote) {
            $gnote->delete();
            return redirect()->back()->with('status', 'Note discarded successfully');
        } else {
            $ynote->delete();
            return redirect()->back()->with('status', 'Note discarded successfully');
        }
    }

    public function store_correspondance(Request $request)
    {
        $userId = Auth::id();
        // dd($request->receipt_id,$request->document_id);
        if ($request->receipt_id != null) {
            $count = count($request->receipt_id);
            for ($i = 0; $i < $count; $i++) {
                $correspondence = new Correspondence();
                $correspondence->createdBy = $userId;
                $correspondence->receipt_id = $request->receipt_id[$i];
                $correspondence->file_id = $request->file_id;
                $correspondence->save();
            }
        } elseif ($request->document_id != null) {
            $count = count($request->document_id);
            for ($i = 0; $i < $count; $i++) {
                $correspondence = new Correspondence();
                $correspondence->createdBy = $userId;
                $correspondence->doc_id = $request->document_id[$i];
                $correspondence->file_id = $request->file_id;
                $correspondence->save();
            }
        } elseif ($request->note_id != null) {
            $count = count($request->note_id);
            for ($i = 0; $i < $count; $i++) {
                $correspondence = new Correspondence();
                $correspondence->createdBy = $userId;
                $correspondence->notes_id = $request->note_id[$i];
                $correspondence->file_id = $request->file_id;
                $correspondence->save();
            }
        }
        return redirect()->back()->with('status', 'Correspondence save successfully');
    }

    public function fileshare($id)
    {
        $url = 'file';
        $notes = Notes::FindorFail($id);
        $file = File::where('id', $notes->file_id)->with(['Department', 'Section'])->first();
        $department = Department::all();
        $fileview = Fileshare::where('gnotes_id', $id)->get();

        return view('file.fileshare', compact('url', 'department', 'file', 'notes', 'fileview'));
    }

    public function notesactivity($id)
    {
        $userId = Auth::id();
        $notes = Notes::find($id);
        $notes->approval_notes_status = 1;
        $notes->approvedby = $userId;
        $notes->approved_date = date('Y-m-d H:i:s');
        $notes->update();
        return redirect()->back();
    }

    public function store_file_share(Request $request)
    {
        $request->validate([
            'department_id' => 'required|max:40',
            'notify' => 'required',
            'remarks' => 'required',
            'duedate' => 'required',
            'action' => 'required',
            'priority' => 'required',
        ]);
        $userId = Auth::id();
        $store_fileshare = Fileshare::create([
            'file_id' => $request->input('file_id'),
            'gnotes_id' => $request->input('notes_id'),
            'department_id' => $request->input('department_id'),
            'section_id' => $request->input('section_id'),
            'sender_id' => $userId,
            'notifyby' => $request->input('notify'),
            'share_file_status' => $request->input('status'),
            'remarks' => $request->input('remarks'),
            'recever_id' => $request->input('user'),
            'duedate' => $request->input('duedate'),
            'actiontype' => $request->input('action'),
            'priority' => $request->input('priority'),
            'createdBy' => $userId,
        ])->fresh();
        // dd($store_fileshare);
        if ($store_fileshare) {
            $note = Notes::find($request->input('notes_id'));
            if ($note) {
                $note->share_notes_status = $request->input('shareStatus');
                $note->save();

                $revert_file = Fileshare::where([
                    ['sender_id', $store_fileshare->recever_id],
                    ['recever_id', $store_fileshare->sender_id],
                    ['status', 1]
                ])->where('sender_id', $store_fileshare->recever_id)
                    ->where('recever_id', $store_fileshare->sender_id)
                    ->where('status', 1)
                    ->latest()
                    ->first();

                if ($revert_file) {
                    $store_fileshare->status = 3;
                }

                return redirect()->route('file.index')->with('success', __('Fileshare  successfully.'));
            } else {
                return redirect()->route('file.index')->with('error', __('Note not found.'));
            }
        }
    }
    public function getuser(Request $request)
    {
        $users = User::where('department_id', $request->department_id)
            ->where('section_id', $request->section_id)
            ->get();
        return response()->json($users);
    }

    public function forwardfile($id)
    {
        $url = 'file';
        $fileshares = Fileshare::find($id);
        // dd($fileshare);
        $department = Department::all();
        $file = File::where('id', $fileshares->file_id)->orderBy('id', 'DESC')->first();
        // dd($file);
        $notes = Notes::where('id', $fileshares->gnotes_id)->first();

        return view('file.shareviewfile', compact('url', 'fileshares', 'file', 'notes', 'department'));
    }

    public function forwardfilestore(Request $request)
    {
        $request->validate([
            'department_id' => 'required|max:40',
            'notify' => 'required',
            'remarks' => 'required',
            'duedate' => 'required|date',
            'action' => 'required',
            'priority' => 'required',
            'user' => 'required',
        ]);
        // dd($request->all());
        $userId = Auth::id();
        $forwardfile = new Fileshare();
        $forwardfile->file_id = $request->forward_id;
        $forwardfile->gnotes_id = $request->note_id;
        $forwardfile->department_id = $request->department_id;
        $forwardfile->section_id = $request->section_id;
        $forwardfile->notifyby = $request->notifyby;
        $forwardfile->remarks = $request->remarks;
        $forwardfile->duedate = $request->duedate;
        $forwardfile->sender_id = $userId;
        $forwardfile->status = 2;
        $forwardfile->recever_id = $request->user;
        $forwardfile->actiontype = $request->action;
        $forwardfile->priority = $request->priority;
        $forwardfile->createdBy = $userId;
        $forwardfile->save();
        $note = Notes::find($request->input('note_id'));
        // dd($note);
        if ($note) {
            $note->share_notes_status = $request->input('shareStatus');
            $note->save();
        } else {
            return redirect()->route('file.index')->with('error', __('Note not found.'));
        }
        // dd($forwardfile);
        return redirect()->route('file.index')->with('success', __('Fileforward  successfully.'));
    }

    public function commentstore(Request $request)
    {
        // dd($request->comment);
        // dd($id);
        $request->validate([
            'comment' => 'required',
        ]);

        $userId = Auth::id();
        $store = Fileshare::where('id', $request->share_Id)->first();
        $check_revert = Fileshare::where('file_id', $store->file_id)
            ->where('sender_id', Auth::user()->id)
            ->where('status', '>', 0)->get();
        // dd($check_revert->isEmpty());
        $store_fileshare = new Fileshare();
        $store_fileshare->file_id = $store->file_id;
        $store_fileshare->gnotes_id = $store->gnotes_id;
        $store_fileshare->department_id = $store->department_id;
        $store_fileshare->section_id = $store->section_id;
        $store_fileshare->notifyby = $store->notifyby;
        $store_fileshare->share_file_status = $store->share_file_status;
        $store_fileshare->remarks = $store->remarks;
        $store_fileshare->duedate = $store->duedate;
        $store_fileshare->actiontype = $store->actiontype;
        $store_fileshare->priority = $store->priority;
        $store_fileshare->status = $check_revert->isEmpty() ? 1 : 3;
        $store_fileshare->recever_id = $store->sender_id;
        $store_fileshare->comments = $request->comment;
        $store_fileshare->sender_id = Auth::user()->id;
        $store_fileshare->createdBy = $userId;
        $store_data = $store_fileshare->save();
        // $filesharestatusupdate_result = self::filesharestatusupdate($request, $id);

        if ($store_data) // && $filesharestatusupdate_result
        {
            return redirect()->route('file.index')->with('success', __('Comment add  successfully.'));
        } else {
            return redirect()->route('file.index')->with('error', __('Something Went wrong'));
        }
    }

    public function filesharestatusupdate(Request $request, $id)
    {
        $filestatus = Fileshare::find($id);
        if ($filestatus) {
            $filestatus->status = $request->status;
            return $filestatus->save();
        } else {
            return false;
        }
    }

    public function filesent(FilesentDataTable $table)
    {
        $files =  Fileshare::where('sender_id', Auth::user()->id)
            ->with(['files', 'sendto', 'section', 'department'])
            ->orderBy('id', 'DESC')
            ->get()
            ->map(function ($item) {
                $item->file_name = $item->files->file_name;
                $item->send_to = $item->sendto->name;
                $item->department = $item->department->name;
                $item->section = $item->section->name;
                return $item;
            });
        $url = 'file';
        if (\Auth::user()->hasRole('admin')) {
            return $table->render('file.sentfile');
        } else {
            $url = 'file';
            return $table->render('file.user.userSent', compact('url', 'files'));
        }
    }
    public function filesearch(FilesearchDataTable $table)
    {
        return $table->render('file.search');
    }
    public function greennotes(GreennotesdataTable $table)
    {
        return $table->render('file.greennotes');
    }
    public function yellownotes(YellownotesdataTable $table)
    {
        return $table->render('file.yellownotes');
    }

    public function fileinbox(FileinboxDataTable $table)
    {
        $subQuery = Fileshare::selectRaw('MAX(id) as id')
            ->where('recever_id', Auth::user()->id)
            ->groupBy('file_id')->get();

        $files = Fileshare::whereIn('id', $subQuery)
            ->latest()->get();

        if (\Auth::user()->hasRole('admin')) {
            return $table->render('file.inbox', compact('url', 'files'));
        } else {
            $url = 'file';
            return $table->render('file.user.userInbox', compact('url'));
        }
    }
}
