<?php

namespace App\Http\Controllers;

use App\DataTables\TemplateDataTable;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Template;
use Illuminate\Http\Request;

class TemplateController extends Controller
{
    public function index(TemplateDataTable $table)
    {
        return $table->render('template.index');
    }

    public function create()
    {   $category = Category::all();
        $subcategory = Subcategory::all();
        return view('template.create', compact('category', 'subcategory'));
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'category_id' => 'required',
            'title' => 'required',
            'description' => 'required',
        ]);
        $template = new Template();
        $template->category_id = $request->input('category_id');
        $template->subcategory_id = $request->input('subcategory_id');
        $template->title = $request->input('title');
        $template->description = $request->input('description');
        $template->save();
        // dd($document);
        return redirect()->route('template.index')->with('success', 'Template saved successfully.');
    }

    public function edit(Template $template)
    {
        $category = Category::all();
        $subcategory = Subcategory::all();

        return view('template.edit', compact('template', 'category', 'subcategory'));
    }

    public function update(Request $request, Template $template)
    {
        $template = new Template();
        $this->validate(
            $request,
            [
                'category_id' => 'required',
                'title' => 'required',
                'description' => 'required',
            ]
        );
        $input = $request->all();
        $template->fill($input)->save();
        return redirect()->route('template.index')->with(
            'success',
            'template ' . $template->template . ' updated!'
        );
    }

    public function destroy($id)
    {
        $template = Template::where('id', $id)->firstorfail()->delete();
        return redirect()->route('template.index')->with('success', __('Template deleted successfully.'));
    }

}
