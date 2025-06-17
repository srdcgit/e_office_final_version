<?php

namespace App\Http\Controllers;

use App\Models\PersonalNotes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PersonalNotesController extends Controller
{
    public function create_notes(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
        ]);
        if ($validation->fails()) {
            return $validation->errors();
        } else {
            $store_pnotes = PersonalNotes::create([
                'user_id' => Auth::user()->id,
                'title' => $request->title,
                'description' => $request->description,
                'status' => 0
            ]);

            if ($store_pnotes) {
                return redirect()->route('home')->with(
                    'success',
                    'Todo List added successfully.'
                );
            }
        }
    }

    public function get_notes_details_by_id($id)
    {
        $pnotes_data = PersonalNotes::where('id', $id)->first();
        if ($pnotes_data) {
            return response()->json([
                'data' => $pnotes_data,
                'code' => 200
            ]);
        }
    }

    public function get_notes()
    {
        $notes = PersonalNotes::all()->map(function ($item) {
            return $item;
        });
        return response()->json([
            'data' => $notes->isEmpty() ? null : $notes,
        ]);
    }

    public function delete_notes(Request $request)
    {
        $result = PersonalNotes::where('id', $request->id)->delete();
        if ($result > 0) {
            return response()->json([
                'message' => "Deleted Successfully",
                'code' => 200
            ]);
        } else {
            return response()->json([
                'message' => "Operation failed",
                'code' => 500
            ]);
        }
    }

    public function update_pnotes(Request $request)
    {
        $update_notes = PersonalNotes::where('id', $request->id)->update([
            'user_id' => Auth::user()->id,
            'title' => $request->title,
            'description' => $request->description, 
            'status' => $request->status,
            'share_status' => $request->share_status
        ]);
        if ($update_notes > 0) {
            return redirect()->route('home')->with(
                'success',
                'Todo List added successfully.'
            );
        }
    }
}
