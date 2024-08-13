<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::get();
        return view('admin/product/index', compact(['categories']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::get();
        return view('admin/product/create', compact(['categories']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'regex:/^[a-zA-Z0-9 ]*$/'],
            'description' => ['required'],
            'price' => ['required', 'numeric', 'decimal:0,2', 'gte:0'],
            'stock' => ['required', 'numeric', 'gte:0'],
            'category' => ['required'],
        ]);
        if ($validator->fails()) {
            return redirect()->route('createProducts')
                ->withErrors($validator)
                ->withInput();
        } else {
            foreach (Category::get() as $key => $value) {
                if ($request->category == $value->name && $request->subcategory == $value->subcategory) {
                    $category_id = $value->id;
                }
            }
            Product::insert([
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'stock_quantity' => $request->stock,
                'category_id' => $category_id,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }
        return redirect()->route('indexProducts');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'regex:/^[a-zA-Z0-9 ]*$/'],
            'description' => ['required'],
            'price' => ['required', 'numeric', 'decimal:0,2', 'gte:0'],
            'stock' => ['required', 'numeric', 'gte:0'],
            'category' => ['required'],
        ]);
        if ($validator->fails()) {
            return redirect()->route('indexProducts')
                ->withErrors($validator)
                ->withInput();
        } else {
            foreach (Category::get() as $key => $value) {
                if ($request->category == $value->name && $request->subcategory == $value->subcategory) {
                    $category_id = $value->id;
                }
            }
            Product::where('id', $id)->update([
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'stock_quantity' => $request->stock,
                'category_id' => $category_id,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }
        return redirect()->route('indexProducts');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Product::where('id', $id)->delete();
        return redirect()->route('indexProducts');
    }
}
