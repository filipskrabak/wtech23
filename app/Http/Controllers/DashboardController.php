<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\AttributeValue;
use App\Http\Controllers\Controller;
use App\Models\Order;

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

    public function attributes() {
        $attributes = AttributeValue::all();
        return view('dashboard.attribute-values.index')->with('attributes', $attributes);
    }

    public function orders(){
        $orders = Order::all();
        return view('orders')->with('orders', $orders);
    }
}
