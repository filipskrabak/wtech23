<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function products(){
        $products = Product::all();
        return view('dashboard.products.index')->with('products', $products);
    }
}
