<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;

class DatatableController extends Controller
{
    public function getUsers()
    {
        return datatables()->of(User::get())->toJson();
    }

    public function getCategories()
    {
        return datatables()->of(Category::get())->toJson();
    }

    public function getProducts()
    {
        $products = Product::leftjoin('categories', 'categories.id', '=', 'products.category_id')
            ->select(
                'products.*',
                'categories.name as catName',
                'categories.subcategory as subcat',
            );;
        return datatables()->of($products)->toJson();
    }
}
