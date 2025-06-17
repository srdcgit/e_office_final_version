<?php

namespace App\Http\Controllers;

use App\DataTables\DepartmentDataTable;
use App\Models\Department as ModelsDepartment;
use Illuminate\Http\Request;
use Spatie\Department\Models\Department;

class DepartmentController extends Controller
{

    public function index(DepartmentDataTable $table)
    {

        return $table->render('department.index');
    }

    public function create()
    {
        return view('department.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:40',
        ]);

        $departmentname = new ModelsDepartment();
        $departmentname->name = $request->input('name');
        $departmentname->save();

        return redirect()->route('department.index');
    }

    public function edit(ModelsDepartment $department)
    {
        return view('department.edit', compact('department'));
    }

    public function update(Request $request, ModelsDepartment $department)
    {
    
        $department = ModelsDepartment::findOrFail($department['id']);
        $this->validate(
            $request,
            [
                'name' => 'required|max:40',

            ]
        );
        $input = $request->all();
        $department->fill($input)->save();

        return redirect()->route('department.index')->with(
            'success',
            'name ' . $department->name . ' updated!'
        );
    }

    public function destroy($id)
    {
        $department = ModelsDepartment::where('id', $id)->firstorfail()->delete();
        return redirect()->route('department.index')->with('success', __('Department deleted successfully.'));
    }
}
