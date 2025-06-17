<?php

namespace App\Http\Controllers;

use App\DataTables\ShareDataTable;
use App\Models\Department;
use App\Models\User;
use App\Models\Role;
use App\Models\Share;
use App\Models\Document as ModelsDocument;
use App\Models\File as ModelsFile;
use Facade\FlareClient\Stacktrace\File;
use Illuminate\Support\Facades\File as FacadesFile;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade as Pdf;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Http\Request;
use App\Models\Section;

class ShareController extends Controller
{
    public function index(ShareDataTable $table)
    {
        return $table->render('share.index');
    }

    public function create()
    {
        $file = Share::where('status', '1')->get();

        return view('share.create', compact('file'));
    }

    public function edit(Share $share)
    {

        return view('share.edit', compact('share'));
    }

    public function update(Request $request, Share $share)
    {
        $share = new Share();
        $this->validate(
            $request,
            [
                'file_id' => 'required|max:40',
                'dtype' => 'required',
            ]
        );
        $input = $request->all();
        $share->file_name = $request->input('title');
        $share->modifyBy = Auth::user()->id;
        $share->fill($input)->save();
        return redirect()->route('document.index')->with(
            'success',
            'document ' . $share->name . ' updated!'
        );
    }

    public function destroy($id)
    {
        $document = Share::find($id);
        $document->status = 0;
        $document->deletedBy = Auth::user()->id;
        $document->deleted_at = date('Y-m-d H:i:s');
        $document->save();
        return redirect()->route('share.index')->with('success', __('Document deleted successfully.'));
    }

    public function share($id)
    {
        $share = ModelsDocument::find($id);
        $department = Department::all();
        $section = Section::all();
        $userId = User::all();
        $roll = Role::all();
        $document = ModelsDocument::findOrFail($id);

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
        $document->status = $request->input('status');
        $document->doc_id = $request->input('doc_id');
        $document->sharetype = $request->input('sharetype');
        if ($request->input('sharetype') === 'role') {
            $document->role_id = $request->input('role');
        } elseif ($request->input('sharetype') === 'user') {
            $document->department_id = $request->input('department_id');
            $document->section_id = $request->input('section_id');
            $document->receverid = $request->input('user');
        }
        $document->save();
        return redirect()->route('document.index')->with('success', 'Document saved successfully.');
    }

    public function getuser(Request $request)
    {
        $users = User::where('department_id', $request->department_id)
            ->where('section_id', $request->section_id)
            ->get();

        return response()->json($users);
    }
}
