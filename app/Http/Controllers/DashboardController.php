<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function products(){
        $products = Product::all();
        return view('dashboard.products.index')->with('products', $products);
    }

    public function users(){
        $users = User::all();
        return view('dashboard.users')->with('users', $users);
    }
}
