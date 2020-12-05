<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Validation\Rule;


class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::when($request->search ,function($q) use ($request){
            return $q->where('name' , 'like', '%' . $request->search . '%');
        })->latest()->paginate(5);
        return view('dashboard.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('dashboard.categories.create');
    }

    public function store(Request $request)
    {
        // $request->validate([
        //     'name:en' => 'required',
        //     'name:ar' => 'required'
        // ]);


        $rules = [];
        foreach (config('translatable.locales') as $locale) {
            $rules += [$locale . '.name' => ['required', Rule::unique('category_translations', 'name')]];
        }//end of for each
        $request->validate($rules);


        $categories =  Category::create($request->except('_token'));
        return redirect()->route('categories.index')->with(['success' => 'The Category Created Successfully']);
    }

    public function edit(Category $category)
    {
        return view('dashboard.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {

        $rules = [];
        foreach (config('translatable.locales') as $locale) {
            $rules += [$locale . '.name' => ['required', Rule::unique('category_translations', 'name')->ignore($category->id, 'category_id')]];
        }//end of for each
        $request->validate($rules);

        $category->update($request->all());
        return redirect()->route('categories.index')->with(['success' => 'The Category Updated Successfully']);
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with(['success' => 'The Category Deleted Successfully']);

    }

  
}
