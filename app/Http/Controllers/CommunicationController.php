<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Communication;
use App\DataTables\CommunicationDataTable;

class CommunicationController extends Controller
{
    public function index(CommunicationDataTable $table)
    {
        return $table->render('communication.index');
    }

    public function create()
    {
        return view('communication.create');
    }
    
    public function store(Request $request)
    {
        $this->validate($request, [
            'communication' => 'required|max:40',
            
        ]);
        $communication = new Communication();
        $communication->communication = $request->input('communication');
        $communication->save();

        return redirect()->route('communication.index');
    }

    public function edit(Communication $communication)
    {
        return view('communication.edit', compact('communication'));
    }

    public function update(Request $request, Communication $communication)
    {
     
        $communication = Communication::findOrFail($communication['id']);
        
        $this->validate(
            $request,
            [
                'communication' =>'required|max:40',
             
            ]
        );
        $input = $request->all();
        $communication->fill($input)->save();
     
        return redirect()->route('communication.index')->with(
            'success',
            'communication ' . $communication->communication . 'updated!'
        );
    }

    public function destroy($id)
    {
        
        $communication = Communication::where('id', $id)->firstorfail()->delete();
        return redirect()->route('communication.index')->with('success', __('communication deleted successfully.'));
    }
}
