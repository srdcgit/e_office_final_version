<?php

namespace App\Http\Controllers;

use App\DataTables\CategoryDataTable;
use App\Models\Category as ModelsCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Category\Models\Category;

class CategoryController extends Controller
{

    public function index(CategoryDataTable $table)
    {

        return $table->render('category.index');
    }

    public function create()
    {
        return view('category.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:40',
            'description' => 'required',
        ]);
        $userId = Auth::user()->id;
        $category = new ModelsCategory();
        $category->name = $request->input('name');
        $category->description = $request->input('description');
        $category->createdBy = $userId;
        $category->save();

        return redirect()->route('category.index');
    }

    public function edit(ModelsCategory $category)
    {
        return view('category.edit', compact('category'));
    }

    public function update(Request $request, ModelsCategory $category)
    {
        // return redirect()->back()->with('warning', __('This Action Is Not Allowed Because Of Demo Mode.'));
        $category = ModelsCategory::findOrFail($category['id']);
        $this->validate(
            $request,
            [
                'name' => 'required|max:40',
                'description' => 'required',
            ]
        );
        $input = $request->all();
        $category->modifiedBy = Auth::user()->id;
        $category->fill($input)->save();

        return redirect()->route('category.index')->with(
            'success',
            'category ' . $category->name . ' updated!'
        );
    }

    public function destroy($id)
    {
        // return redirect()->back()->with('warning', __('This Action Is Not Allowed Because Of Demo Mode.'));
        $category = ModelsCategory::where('id', $id)->firstorfail()->delete();
        return redirect()->route('category.index')->with('success', __('Category deleted successfully.'));
    }
}
