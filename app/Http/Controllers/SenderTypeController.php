<?php

namespace App\Http\Controllers;
use App\DataTables\SenderTypeDataTable;
use App\Models\Sendertype;
use Illuminate\Http\Request;

class SenderTypeController extends Controller
{
    public function index(SenderTypeDataTable $table)
    {
        return $table->render('sendertype.index');
    }

    public function create()
    {
        return view('sendertype.create');
    }
    
    public function store(Request $request)
    {
        $this->validate($request, [
            'sendertype' => 'required|max:40',
            
        ]);
        $sendertype = new Sendertype();
        $sendertype->sendertype = $request->input('sendertype');
        $sendertype->save();

        return redirect()->route('sendertype.index');
    }

    public function edit(Sendertype $sendertype)
    {
        return view('sendertype.edit', compact('sendertype'));
    }

    public function update(Request $request, Sendertype $sendertype)
    {
     
        $sendertype = Sendertype::findOrFail($sendertype['id']);
        
        $this->validate(
            $request,
            [
                'sendertype' => 'required|max:40',
             
            ]
        );
        $input = $request->all();
        $sendertype->fill($input)->save();
     
        return redirect()->route('sendertype.index')->with(
            'success',
            'sendertype ' . $sendertype->sendertype . 'updated!'
        );
    }

    public function destroy($id)
    {
        
        $sendertype = Sendertype::where('id', $id)->firstorfail()->delete();
        return redirect()->route('sendertype.index')->with('success', __('sendertype deleted successfully.'));
    }
}