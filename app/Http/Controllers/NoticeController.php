<?php

namespace App\Http\Controllers;

use App\DataTables\MinistryDataTable;
use App\DataTables\NoticeDataTable;
use App\Models\Notice;
use App\Models\NoticeDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class NoticeController extends Controller
{
    public function index(NoticeDataTable $table)
    {
        return $table->render('notice.index');
    }

    public function create()
    {
        return view('notice.create');
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'dtype' => 'required',
        ]);
        // Common data for creating a Notice
        $noticeData = [
            'user_id' => Auth::user()->id,
            'title' => $request->input($request->input('dtype') == 1 ? 'document_title' : 'title'),
            'meta_title' => Str::slug($request->input($request->input('dtype') == 1 ? 'document_metatitle' : 'metatitle')),
            'file_type' => $request->input('dtype'),
            'date' => now()->format('Y-m-d'),
            'description' => $request->input($request->input('dtype') == 1 ? 'upload_description' : 'description'),
        ];

        // Create the Notice
        $notice = Notice::create($noticeData)->fresh();

        if ($request->input('dtype') == 1) {
            // Handle file upload logic
            if ($request->hasFile('documentname')) {
                $document_name = $request->file('documentname')->getClientOriginalName();
                $document_path = $request->file('documentname')->move(public_path('documents/upload'), $document_name);

                // Create NoticeDocument record
                NoticeDocument::create([
                    'notice_id' => $notice->id,
                    'document_name' => $document_name,
                    'meta_name' => Str::slug($document_name),
                    'file_path' => 'documents/upload/' . $document_name,
                ]);
            }
        }
        return redirect()->route('notice.index');
    }

    public function get_notices()
    {
        $notice = Notice::with('notice_documents')->orderBy('id', 'desc')->take(4)->get()->map(function ($items) {
            $items->date = date('d-m-Y', strtotime($items->date));
            if (!$items->notice_documents->isEmpty()) {
                foreach ($items->notice_documents as $item) {
                    $items->file_path = $item->file_path;
                }
            }
            return $items;
        });
        return response()->json([
            'data' => $notice->isEmpty() ? null : $notice,
            'code' => 200
        ]);
    }

    public function get_notice_details_by_id($id)
    {
        $notice_data = Notice::where('id', $id)->first();
        if ($notice_data) {
            return response()->json([
                'data' => $notice_data,
                'code' => 200
            ]);
        }
    }
}
