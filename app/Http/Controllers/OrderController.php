<?php

namespace App\Http\Controllers;

use App\Models\CartProduct;
use App\Models\OrderProduct;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Postcode;
use App\Models\Street;

class OrderController extends Controller
{
    // Show user orders
    public function show(Request $request){
        $orders = $request->user()->orders()->get();
        
        return view('orders', [
            'orders'=> $orders
        ]);
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'surname' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'street' => 'required',
            'postcode' => 'required',
            'city' => 'required',
            'country' => 'required',
        ]);

        if(Auth::id() == null) {
            $order = Order::create([
                'name' => $request->input('name'),
                'surname' => $request->input('surname'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'street' => $request->input('street'),
                'postcode' => $request->input('postcode'),
                'city' => $request->input('city'),
                'country' => $request->input('country'),
                'status' => 'pending',
                'price' => '0',
            ]);
            $cart = session()->get('cart', []);
            $total = 0;

            foreach($cart as $cartProduct) {
                $total += $cartProduct->product->price * $cartProduct->pcs;
                $order->products()->attach($cartProduct->product_id, [
                    'pcs' => $cartProduct->pcs,
                    'size' => $cartProduct->size,
                ]);
            }

            $order->price = $total;
            $order->save();

            session()->forget('cart');
        }
        else {
            $order = $request->user()->orders()->create([
                'name' => $request->input('name'),
                'surname' => $request->input('surname'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'street' => $request->input('street'),
                'postcode' => $request->input('postcode'),
                'city' => $request->input('city'),
                'country' => $request->input('country'),
                'status' => 'pending',
                'price' => '0',
            ]);

            $cartProducts = CartProduct::get()->filter(function($cartProduct) {
                return $cartProduct->user->id === Auth::id();
            });
            $total = 0;

            foreach($cartProducts as $cartProduct) {
                $total += $cartProduct->product->price * $cartProduct->pcs;
                $order->products()->attach($cartProduct->product_id, [
                    'pcs' => $cartProduct->pcs,
                    'size' => $cartProduct->size,
                ]);
            }
            $order->price = $total;
            $order->save();

            //delete all cart products
            CartProduct::where('user_id', Auth::id())->delete();
        }
    }
}
