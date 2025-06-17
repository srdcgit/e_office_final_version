<?php

namespace App\Http\Controllers;

use App\DataTables\MinistryDataTable;
use App\Models\Ministry;
use Illuminate\Http\Request;

class MinistryController extends Controller
{
    public function index(MinistryDataTable $table)
    {
        return $table->render('ministry.index');
    }

    public function create()
    {
        return view('ministry.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'ministryname' => 'required|max:40',

        ]);
        $ministry = new Ministry();
        $ministry->ministryname = $request->input('ministryname');
        $ministry->save();

        return redirect()->route('ministry.index');
    }

    public function edit(Ministry $ministry)
    {
        return view('ministry.edit', compact('ministry'));
    }

    public function update(Request $request, Ministry $ministry)
    {

        $ministry = Ministry::findOrFail($ministry['id']);

        $this->validate(
            $request,
            [
                'ministryname' => 'required|max:40',

            ]
        );
        $input = $request->all();
        $ministry->fill($input)->save();

        return redirect()->route('ministry.index')->with(
            'success',
            'ministryname ' . $ministry->ministryname . 'updated!'
        );
    }

    public function destroy($id)
    {

        $ministry = Ministry::where('id', $id)->firstorfail()->delete();
        return redirect()->route('ministry.index')->with('success', __('ministry deleted successfully.'));
    }
}
