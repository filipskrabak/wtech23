<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    // Get and show all products
    public function index() {
        return view('products.index', [
            'products' => Product::all()
        ]);
    }

    // Show single product
    public function show(Product $product) {
        $images = $product->images;


        return view('products.show', [
            'product' => $product
        ])->with('images', $images);
    }
}
