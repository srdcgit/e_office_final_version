<?php

namespace App\Http\Controllers;
use App\DataTables\VipDataTable;
use App\Models\Vip;
use Illuminate\Http\Request;

class VipController extends Controller
{
    public function index(VipDataTable $table)
    {
        return $table->render('vip.index');
    }

    public function create()
    {
        return view('vip.create');
    }
    
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:40',
            
        ]);
        $vip = new Vip();
        $vip->name = $request->input('name');
        $vip->save();

        return redirect()->route('vip.index');
    }

    public function edit(Vip $vip)
    {
        return view('vip.edit', compact('vip'));
    }

    public function update(Request $request, Vip $vip)
    {
     
        $vip = Vip::findOrFail($vip['id']);
        
        $this->validate(
            $request,
            [
                'name' => 'required|max:40',
             
            ]
        );
        $input = $request->all();
        $vip->fill($input)->save();
     
        return redirect()->route('vip.index')->with(
            'success',
            'vip ' . $vip->vip . 'updated!'
        );
    }

    public function destroy($id)
    {
        
        $mode = Vip::where('id', $id)->firstorfail()->delete();
        return redirect()->route('vip.index')->with('success', __('deliverymode deleted successfully.'));
    }
}