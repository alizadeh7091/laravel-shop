<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    public function allProducts()
    {
        $products = Product::all();
        return view('product.all')->with(
            [
                'products' => $products,
            ]
        );
    }
}
