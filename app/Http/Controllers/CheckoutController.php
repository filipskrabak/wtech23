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
    public function index() {
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

    //checkPostcode() function - return all postcodes from database begging with $postcode
    public function checkPostcode(Request $request){
        $postcode = $request->input('postcode');
        $postcodes = Postcode::where('postcode', 'LIKE', $postcode.'%')->take(10)->get();
        response()->json($postcodes);
    }

    public function checkStreet(Request $request){
        $street = $request->input('street');
        $streets = Street::where('street', 'LIKE', $street.'%')->take(10)->get();
        response()->json($streets);
    }
}
