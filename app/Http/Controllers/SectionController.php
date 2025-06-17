<?php

namespace App\Http\Controllers;

use App\DataTables\SectionDataTable;
use App\Models\Section as ModelsSection;
use App\Models\Department as ModelsDepartment;
use Illuminate\Http\Request;
use Spatie\Department\Models\Department;

class SectionController extends Controller
{

    public function index(SectionDataTable $table)
    {

        return $table->render('section.index');
    }

    public function create()
    {
        $department=ModelsDepartment::all();
        return view('section.create',compact('department'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'department_id'=>'required',
            'name' => 'required|max:40',
        ]);

        $section = new ModelsSection();
        $section->name = $request->input('name');
        $section->department_id =$request->input('department_id');
        $section->save();

        return redirect()->route('section.index');
    }

    public function edit(ModelsSection $section)
    {
        $department=ModelsDepartment::all();
        return view('section.edit', compact('section','department'));
    }

    public function update(Request $request, ModelsSection $section)
    {
        // return redirect()->back()->with('warning', __('This Action Is Not Allowed Because Of Demo Mode.'));
        $section = ModelsSection::findOrFail($section['id']);
        $this->validate(
            $request,
            [
                'department_id'=>'required',
                'name' => 'required|max:40',

            ]
        );
        $input = $request->all();
        $section->fill($input)->save();

        return redirect()->route('section.index')->with(
            'success',
            'section ' . $section->name . ' updated!'
        );
    }

    public function destroy($id)
    {
        // return redirect()->back()->with('warning', __('This Action Is Not Allowed Because Of Demo Mode.'));
        $section = ModelsSection::where('id', $id)->firstorfail()->delete();
        return redirect()->route('section.index')->with('success', __('Section deleted successfully.'));
    }
}
