<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Show user orders
    public function show(Request $request){
        $orders = $request->user()->orders()->get();
        
        return view('orders', [
            'orders'=> $orders
        ]);
    }
}
