<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Share;
use App\Models\Section;
use App\Models\Document;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Models\File as ModelsFile;
use App\DataTables\DocumentDataTable;
use App\DataTables\DocumentsharedataTable;
use App\DataTables\DocumentinboxdataTable;
use App\Models\Document as ModelsDocument;
use App\DataTables\DocumentsearchDataTable;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;

class DocumentController extends Controller
{
    public function index(DocumentDataTable $table)
    {
        if (\Auth::user()->hasRole('admin')) {
            return $table->render('document.index');
        } else {
            $url = 'document';
            return $table->render('document.user.userIndex', compact('url'));
        }
    }
    public function create()
    {
        $url = 'document';
        $file = ModelsFile::where('status', '1')->get();
        if (\Auth::user()->hasRole('admin')) {
            return view('document.create', compact('file'));
        } else {
            return view('document.user.create', compact('url', 'file'));
        }
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'dtype' => 'required',
        ]);
        $userId = \Auth::id();
        // $file = ModelsFile::findOrFail($request->file_id);
        $document = new ModelsDocument();
        $document->createdBy = $userId;
        $document->dtype = $request->input('dtype');
        if ($request->input('dtype') === 'create') {
            $document->document_name = $request->input('title');
            $document->description = $request->input('description');
            $document->meta_title = $request->input('metatitle');
            $pdf = FacadePdf::loadView('documents.pdf', [
                'description' => $document->description,
            ]);
            $pdfPath = 'documents/' . '/' . $request->input('title') . '.pdf';
            $directory = public_path('documents/');
            if (!is_dir($directory)) {
                mkdir($directory, 0755, true);
            }
            $pdf->save(public_path($pdfPath));
            $document->documentpath = $pdfPath;
        } elseif ($request->input('dtype') === 'upload' && $request->hasFile('documentpath')) {
            $document->uploadmetatitle = $request->input('uploadmetatitle');
            $documentName = $request->file('documentpath')->getClientOriginalName();
            $request->file('documentpath')->move(public_path('documents/upload'), $documentName);
            $pdfPath = 'documents/upload' . '/' . $documentName;
            $document->document_name = $documentName;
            $document->documentpath = $pdfPath;
        }
        $document->save();
        // dd($document);
        return redirect()->route('document.index')->with('success', 'Document saved successfully.');
    }

    public function edit(ModelsDocument $document)
    {
        $url = 'document';
        if (\Auth::user()->hasRole('admin')) {
            return view('document.edit', compact('document'));
        } else {
            return view('document.user.edit', compact('url', 'document'));
        }
    }
    public function view($id)
    {
        $share = Share::find($id);
        $document = ModelsDocument::where('id', $share->doc_id)->first();
        // dd($share);
        $url = 'document';
        if (\Auth::user()->hasRole('admin')) {
            return view('document.view', compact('document', 'share'));
        } else {
            return view('document.user.view', compact('url', 'document', 'share'));
        }
    }
    public function upload_document($id)
    {
        $share = Share::find($id);
        $document = ModelsDocument::where('id', $share->doc_id)->first();
        return view('document.uploadviewdocument', compact('share', 'document'));
    }
    public function commentstore(Request $request)
    {
        $request->validate([

            'comment' => 'required',
        ]);
        $store = Share::where('id', $request->share_Id)->first();
        $comment = new Share();
        $comment->sharetype = $store->sharetype;
        $comment->role_id = $store->role_id;
        $comment->doc_id = $store->doc_id;
        $comment->file_id = $store->file_id;
        $comment->receverid = $store->senderId;
        $comment->status = $store->status;
        $comment->department_id = $store->department_id;
        $comment->section_id = $store->section_id;
        $comment->comments = $request->comment;
        $comment->revert_status = $store->revert_status;
        $comment->senderId = Auth::user()->id;
        $comment->save();
        return response()->json(['success' => 'Comment added successfully']);
    }
    public function update(Request $request, ModelsDocument $document)
    {
        $document = new ModelsDocument();
        $this->validate(
            $request,
            [
                'dtype' => 'required',
            ]
        );
        $input = $request->all();
        $document->document_name = $request->input('document_name');
        $document->document_name = $request->input('documentpath');
        $document->comments = $request->input('comments');
        $document->modifyBy = Auth::user()->id;
        $document->fill($input)->save();
        return redirect()->route('document.index')->with(
            'success',
            'document ' . $document->name . ' updated!'
        );
    }

    public function destroy($id)
    {
        $document = ModelsDocument::find($id);
        $document->status = 0;
        $document->deletedBy = Auth::user()->id;
        $document->deleted_at = date('Y-m-d H:i:s');
        $document->save();
        return redirect()->route('document.index')->with('success', __('Document deleted successfully.'));
    }
    public function share($id)
    {
        $share = ModelsDocument::find($id);
        $department = Department::all();
        $section = Section::all();
        $userId = User::all();
        $roll = Role::all();
        return view('document.share', compact('id', 'share', 'department', 'section', 'userId', 'roll'));
    }
    public function store_share(Request $request)
    {
        $request->validate([
            'sharetype' => 'required',
        ]);

        $userId = Auth::id();
        $document = new Share();
        $document->senderId = $userId;
        $document->doc_id = $request->input('doc_id');
        $document->sharetype = $request->input('sharetype');
        if ($request->input('sharetype') === 'role') {
            $document->role_id = $request->input('role');
        } elseif ($request->input('sharetype') === 'user') {
            $document->priority = $request->input('priority');
            $document->duedate = $request->input('duedate');
            $document->comments = $request->input('comments');
            $document->department_id = $request->input('department_id');
            $document->section_id = $request->input('section_id');
            $document->receverid = $request->input('user');
        }
        $document->save();
        return redirect()->route('document.index')->with('success', 'Document Share successfully.');
    }
    public function getuser(Request $request)
    {
        $users = User::where('department_id', $request->department_id)
            ->where('section_id', $request->section_id)
            ->get();

        return response()->json($users);
    }
    public function getUserForFileShare(Request $request)
    {
        $users = User::where('department_id', $request->department_id)
            ->where('section_id', $request->section_id)
            ->where('id', '!=', auth()->id())
            ->get();

        return response()->json($users);
    }
    public function documentsent(DocumentsharedataTable $table)
    {
        if (\Auth::user()->hasRole('admin')) {
            return $table->render('document.sentdocument');
        } else {
            $url = 'document';
            return $table->render('document.user.userSent', compact('url'));
        }
    }

    public function documentinbox(DocumentinboxdataTable $table)
    {
        if (\Auth::user()->hasRole('admin')) {
            return $table->render('document.inbox');
        } else {
            $url = 'document';
            return $table->render('document.user.userInbox', compact('url'));
        }
    }

    public function documentsearch(DocumentsearchDataTable $table)
    {
        return $table->render('document.search');
    }

    //dashboard functions starts here

    public function get_documents()
    {
        $documents = Document::with('users')
            ->orderBy('id', 'DESC')
            ->get()
            ->take(4)
            ->map(function ($item) {
                $item->username = $item->users->name;
                return $item;
            });
        return response()->json([
            'data' => $documents->isEmpty() ? null : $documents,
            'code' => 200
        ]);
    }
}
