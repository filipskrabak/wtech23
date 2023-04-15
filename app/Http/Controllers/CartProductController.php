<?php

namespace App\Http\Controllers;

use App\Models\CartProduct;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartProductController extends Controller
{
    //Show cart
    public function index(){
        return view('cart');
    }

    /**
    * Add item to cart
    *
    * @return Response
    */
    public function store(Request $request, $id)
    {
        $cartProduct = new CartProduct;

        $cartProduct->user_id = $request->user()->id;
        $cartProduct->product_id = $id;

        // TODO
        //$cartProduct->pcs = 1;

        $cartProduct->save();

        // Redirect back to the product page with a success message
        return redirect()->back()->with('message', 'Product added to cart!');
    }

    //remove item
    //increase/decreas pcs
}
