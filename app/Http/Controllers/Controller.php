<?php

namespace App\Http\Controllers;

use App\Models\Images;
use App\Models\Product;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    public function index()
    {
        $products = Product::paginate(10);
        $images = Images::get();
        return view('welcome', compact(['products', 'images']));
    }
}
