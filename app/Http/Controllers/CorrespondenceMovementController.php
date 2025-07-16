<?php

namespace App\Http\Controllers;

use App\Models\CorrespondenceMovement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\DataTables\CorrespondenceMovementDataTable;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class CorrespondenceMovementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\DataTables\CorrespondenceMovementDataTable  $dataTable
     * @param  int $file_notes_id
     * @return \Illuminate\Http\Response
     */
    public function index(CorrespondenceMovementDataTable $dataTable, $file_notes_id)
    {
        return $dataTable->with('file_notes_id', $file_notes_id)->render('file.user.correspondence_movement_datatable', ['file_notes_id' => $file_notes_id]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'file_notes_id' => 'required|integer',
            'correspondence_ids' => 'required|array',
            'remark' => 'required|string',
        ]);

        // Store movement
        CorrespondenceMovement::create([
            'file_notes_id' => $request->file_notes_id,
            'correspondence_ids' => $request->correspondence_ids,
            'remark' => $request->remark,
            'created_by' => Auth::id(),
        ]);

        // Delete correspondence
        \App\Models\Correspondence::whereIn('id', $request->correspondence_ids)->delete();

        return response()->json(['success' => true]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

   

    

    public function showModalSent($id)
    {
        $user = User::find($id);

        if (!$user) {
            return "<p class='text-danger'>User not found....</p>";
        }

        return view('file.user.usermodal', compact('user'));
    }

    public function showCorrespondenceDetail($id)
    {
        $correspondence = \App\Models\Correspondence::with(['receipt', 'document', 'file', 'notes', 'creator'])->find($id);

        if (!$correspondence) {
            return "<p class='text-danger'>Correspondence not found.</p>";
        }

        return view('file.user.correspondencemodal', compact('correspondence'));
    }
}
