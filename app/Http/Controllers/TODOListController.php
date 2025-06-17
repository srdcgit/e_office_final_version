<?php

namespace App\Http\Controllers;

use App\Models\TODOList;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TODOListController extends Controller
{
    public function create_todo(Request $request)
    {
        // dd($request->all());
        $validation = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'date' => 'required',
        ]);
        if ($validation->fails()) {
            return $validation->errors();
        } else {
            $store_todo = TODOList::create([
                'user_id' => Auth::user()->id,
                'title' => $request->title,
                'description' => $request->description,
                'date' => $request->date,
                'status' => 0
            ]);

            if ($store_todo) {
                return redirect()->route('home')->with(
                    'success',
                    'Todo List added successfully.'
                );
            }
        }
    }

    public function get_todo()
    {
        $todo_data = TODOList::where('status', 0)->take(4)->orderBy('id', 'DESC')->get()->map(function ($item) {
            $dateInput = $item->date; // Original date in 'Y-m-d H:i' format
            $dateTime = new DateTime($dateInput);

            // Format the date as 'dS M Y h:iA'
            $formattedDate = $dateTime->format('jS M Y h:i A');

            // Convert the time to uppercase for AM/PM
            // $formattedDate = strtoupper($formattedDate);
            $item->date = $formattedDate;
            return $item; // Output: 9th Sept 2024 12:09AM
        });
        return response()->json([
            'data' => $todo_data->isEmpty() ? null : $todo_data,
        ]);
    }

    public function get_todo_details_by_id($id)
    {
        $t_data = TODOList::where('id', $id)->first();
        if ($t_data) {
            return response()->json([
                'data' => $t_data,
                'code' => 200
            ]);
        }
    }

    public function delete_todo(Request $request)
    {

        $result = TODOList::where('id', $request->id)->delete();
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

    public function change_status(Request $request)
    {

        $todo = TODOList::where('id', $request->id)->first(); // Use `first()` to get a single record

        if ($todo) {
            $todo->status = 1; // Set the status to 1
            $result = $todo->save(); // Save the updated model

            if ($result) { // Check if the save operation was successful
                return response()->json([
                    'message' => "Done",
                    'code' => 200
                ]);
            } else {
                return response()->json([
                    'message' => "Operation failed",
                    'code' => 500
                ]);
            }
        } else {
            return response()->json([
                'message' => "Todo item not found",
                'code' => 404
            ]);
        }
    }

    public function update_todo(Request $request)
    {
        $update_todo = TODOList::where('id', $request->id)->update([
            'user_id' => Auth::user()->id,
            'title' => $request->title,
            'description' => $request->description,
            'date' => $request->date,
            'status' => 0
        ]);
        if ($update_todo > 0) {
            return redirect()->route('home')->with(
                'success',
                'Todo List added successfully.'
            );
        }
    }
}
