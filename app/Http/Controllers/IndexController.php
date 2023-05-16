<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $data = Product::join('product_categories', 'products.id_category', '=', 'product_categories.id')
            ->select('products.*', 'product_categories.category_name')
            ->take(4)
            ->get();
        return view('frontend.index', compact('data'));
    }
}
