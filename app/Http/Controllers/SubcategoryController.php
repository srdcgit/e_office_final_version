<?php

namespace App\Http\Controllers;

use App\DataTables\SubcategoryDataTable;
use App\Models\Subcategory as ModelsSubcategory;
use App\Models\Category as ModelsCategory;
use Illuminate\Http\Request;
use Spatie\Category\Models\Category;

class SubcategoryController extends Controller
{

    public function index(SubcategoryDataTable $table)
    {

        return $table->render('subcategory.index');
    }

    public function create()
    {
        $categories = ModelsCategory::all();
        return view('subcategory.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'category_id' => 'required|max:40',
            'name' => 'required',
        ]);

        $subcategory = new ModelsSubcategory();
        $subcategory->category_id = $request->input('category_id');
        $subcategory->name = $request->input('name');
        $subcategory->save();

        return redirect()->route('subcategory.index');
    }

    public function edit(ModelsSubcategory $subcategory)

    {
        $categories = ModelsCategory::all();
        return view('subcategory.edit', compact('subcategory', 'categories'));
    }

    public function update(Request $request, ModelsSubcategory $subcategory)
    {
        $subcategory = ModelsSubcategory::findOrFail($subcategory['id']);
        $this->validate(
            $request,
            [
                'category_id' => 'required|max:40',
                'name' => 'required',
            ]
        );
        $input = $request->all();
        $subcategory->fill($input)->save();

        return redirect()->route('subcategory.index')->with(
            'success',
            'subcategory ' . $subcategory->category_id . ' updated!'
        );
    }

    public function destroy($id)
    {
        $subcategory = ModelsSubcategory::where('id', $id)->firstorfail()->delete();
        return redirect()->route('subcategory.index')->with('success', __('SubCategory deleted successfully.'));
    }
}
