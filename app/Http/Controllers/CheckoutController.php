<?php

namespace App\Http\Controllers;

use App\Models\CartProduct;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Postcode;
use App\Models\Street;

class CheckoutController extends Controller 
{
    public function create() {
        if(Auth::id() == null) {
            $products = session()->get('cart', []);
            return view('checkout', [
                'products' => $products,
            ]);
        }

        $allCartProducts = CartProduct::get();

        $products = $allCartProducts->filter(function($cartProduct) {
            return $cartProduct->user->id === Auth::id();
        });

        //get User
        $user = Auth::user();

        return view('checkout', [
            'products' => $products,
            'user' => $user,
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
        ]);

        if(Auth::id() == null) {
            $cart = session()->get('cart', []);
            $total = 0;

            foreach($cart as $cartProduct) {
                $total += $cartProduct->product->price * $cartProduct->pcs;
                $order->products()->create([
                    'product_id' => $cartProduct->product_id,
                    'size' => $cartProduct->size,
                    'pcs' => $cartProduct->pcs,
                ]);
            }

            $order->total = $total;
            $order->save();

            session()->forget('cart');
        }
        else {
            $cartProducts = CartProduct::get()->filter(function($cartProduct) {
                return $cartProduct->user->id === Auth::id();
            });
            $total = 0;

            foreach($cartProducts as $cartProduct) {
                $total += $cartProduct->product->price * $cartProduct->pcs;
                $order->products()->create([
                    'product_id' => $cartProduct->product_id,
                    'size' => $cartProduct->size,
                    'pcs' => $cartProduct->pcs,
                ]);
            }
            $order->total = $total;
            $order->save();

            //delete all cart products
            CartProduct::where('user_id', Auth::id())->delete();
        }
    }
}
