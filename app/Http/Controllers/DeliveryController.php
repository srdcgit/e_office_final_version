<?php

namespace App\Http\Controllers;
use App\DataTables\DeliverymodeDataTable;
use App\Models\Deliverymode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class DeliveryController extends Controller
{

    public function index(DeliverymodeDataTable $table)
    {
        
        return $table->render('deliverymode.index');
    }

    public function create()
    {
        return view('deliverymode.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'mode' => 'required|max:40',
            
        ]);
        $mode = new Deliverymode();
        $mode->mode = $request->input('mode');
        $mode->save();

        return redirect()->route('deliverymode.index');
    }

    public function edit(Deliverymode $deliverymode)
    {
        return view('deliverymode.edit', compact('deliverymode'));
    }

    public function update(Request $request, Deliverymode $deliverymode)
    {
     
        $mode = Deliverymode::findOrFail($deliverymode['id']);
        $this->validate(
            $request,
            [
                'mode' => 'required|max:40',
             
            ]
        );
        $input = $request->all();
        $mode->fill($input)->save();
        return redirect()->route('deliverymode.index')->with(
            'success',
            'mode ' . $mode->mode . 'updated!'
        );
    }

    public function destroy($id)
    {
        
        $mode = Deliverymode::where('id', $id)->firstorfail()->delete();
        return redirect()->route('deliverymode.index')->with('success', __('deliverymode deleted successfully.'));
    }
}
