<?php

namespace App\Http\Controllers;

use App\Models\CartProduct;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CartProductController extends Controller
{
    //Show cart
    public function index(){
        // TODO: Unauthenticated
        if(Auth::id() == null) {
            dd("WIP: support for guests");
        }

        $allCartProducts = CartProduct::get();

        $products = $allCartProducts->filter(function($cartProduct) {
            return $cartProduct->user->id === Auth::id();
        });

        return view('cart', [
            'cartproducts' => $products
        ]);
    }

    /**
    * Add item to cart
    *
    * @return Response
    */
    public function store(Request $request, $id)
    {
        // TODO: Unauthenticated
        if(Auth::id() == null) {
            dd("WIP: support for guests");
        }

        $cartProduct = new CartProduct;

        $cartProduct->user_id = $request->user()->id;
        $cartProduct->product_id = $id;

        $cartProduct->size = $request->input('size');

        // TODO
        //$cartProduct->pcs = 1;

        $cartProduct->save();

        // Redirect back to the product page with a success message
        return redirect()->back()->with('message', 'Product added to cart!');
    }

    //remove item
    //increase/decrease pcs
}
