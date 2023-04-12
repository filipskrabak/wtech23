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
        return view('products.show', [
            'products' => $product
        ]);
    }
}
