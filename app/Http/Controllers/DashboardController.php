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
        // Paginated products
        $products = Product::paginate(10);
        return view('dashboard.products.index')->with('products', $products);
    }

    public function users(){
        $users = User::paginate(10);
        return view('dashboard.users.index')->with('users', $users);
    }

    public function attributes() {
        $attributes = AttributeValue::paginate(10);
        return view('dashboard.attribute-values.index')->with('attributes', $attributes);
    }

    public function orders(){
        $orders = Order::paginate(10);
        return view('orders.index')->with('orders', $orders);
    }
}
