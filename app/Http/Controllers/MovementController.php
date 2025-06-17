<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\File;
use App\Models\Movement;
use App\Models\Vip;
use App\DataTables\ReceiptMovementDataTable;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use App\Models\Receipt;

class MovementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, ReceiptMovementDataTable $dataTable)
    {
        $vips = Vip::all();
        $categories = Category::all();
        $files = File::all();
        $url = 'movements';
        $receiptid = $request->input('receipt_id');
        // $decryptedId = Crypt::encrypt($receiptid);
        $receipt = Receipt::where('id', $receiptid)
        ->with(['subCategory', 'Category', 'communication', 'delivery', 'sender', 'Vip', 'ministry', 'Country', 'State'])
        ->first();
        $copyreceiptid = Crypt::encrypt($receiptid);
        // If AJAX, return JSON for DataTables
        if ($request->ajax()) {
            return $dataTable->with([
                'receipt_id' => $request->input('receipt_id'),
            ])->ajax();
        }
    
        // return $dataTable->render('movements.index', compact('vips', 'categories', 'files', 'url'));
        return $dataTable->render('movements.index', compact([
            'vips',
            'categories',
            'files',
            'url',
            'receiptid',
           'copyreceiptid',
           'receipt'
        ]));
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
        //
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

    public function get_sender_detail(Request $request)
    {
        Log::info($request->senderId);
        $sender = User::where('id', $request->senderId)->with('departments', 'sections')->first();
        if (!empty($sender)) {
            return response()->json([
                'data' => $sender,
                'code' => 200
            ]);
        } else {
            return response()->json([
                'message' => 'No data found',
                'code' => 500
            ]);
        }
    }
}
