<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin/category/showCategory');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::get();
        return view('admin/category/createCategory', compact(['categories']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category' => ['required'],
            'name_category' => ['required_if:category,newCategory', isset($request->name_category) ? 'regex:/^[A-Za-z\s]+$/' : ""],
            'name_subcategory' => ['prohibited_unless:subcategory,newSubcategory', isset($request->name_subcategory) ? 'regex:/^[A-Za-z\s]+$/' : ""],
        ]);
        if ($validator->fails()) {
            return redirect()->route('createCategories')
                ->withErrors($validator)
                ->withInput();
        } else {
            Category::insert([
                'name' => $request->category == 'newCategory' ? $request->name_category : $request->category,
                'subcategory' => $request->subcategory == 'newSubcategory' ? $request->name_subcategory : $request->subcategory,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }
        return redirect()->route('showCategories');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'category' => ['required', 'regex:/^[A-Za-z\s]+$/'],
            'subcategory' => ['nullable', isset($request->name_subcategory) ? 'regex:/^[A-Za-z\s]+$/' : ""],
        ]);

        if ($validator->fails()) {
            return redirect()->route('address')
                ->withErrors($validator)
                ->withInput();
        } else {
            Category::where('id', $id)->update([
                'name' => $request->category,
                'subcategory' => isset($request->subcategory) ? $request->subcategory : "",
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }
        return redirect()->route('showCategories');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, $action)
    {
        if ($action == "subcategory") {
            Category::where('id', $id)->delete();
        } else if ($action == "category") {
            $category = Category::where('id', $id)->first()->name;
            foreach (Category::get() as $key => $value) {
                $value->name == $category ? $value->delete() : "";
            }
        }
        return redirect()->route('showCategories');
    }

    public function dataSubcategory(Request $request)
    {
        return Category::where('name', $request->name)->get();
    }
}
