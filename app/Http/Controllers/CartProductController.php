<?php

namespace App\Http\Controllers;

use App\Models\CartProduct;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CartProductController extends Controller
{
    //Show cart
    public function index()
    {
        if(Auth::id() == null) {
            $products = session()->get('cart', []);

            return view('cart', [
                'cartproducts' => $products,
            ]);
            //dd("WIP: support for guests");
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
        if(Auth::id() == null) {
            // Get cart content from old session
            $cart = session()->get('cart', []);

            // Check if product is already in cart
            $cartProduct = array_filter($cart, function($cartProduct) use($id, $request) {
                return $cartProduct->product_id == $id && $cartProduct->size == $request->input('size');
            });
            if (count($cartProduct) > 0) {
                $cartProduct = array_values($cartProduct)[0];
                $cartProduct->pcs += $request->input('pcs');
            }
            else {
                $cartProduct = new CartProduct;
                $cartProduct->product_id = $id;
                $cartProduct->size = $request->input('size');
                $cartProduct->pcs = $request->input('pcs');
                array_push($cart, $cartProduct);
            }

            // Save newupdated cart to session
            session()->put('cart', $cart);

            return redirect()->back()->with('message', 'Product added to cart!');
        }
        $cartProduct = CartProduct::where('product_id', $id)
                        ->where('size', $request->input('size'))
                        ->first();

        if (!$cartProduct) {
            // Create a new CartProduct instance inf not found in cart already.
            $cartProduct = new CartProduct;
            $cartProduct->product_id = $id;
            $cartProduct->user_id = $request->user()->id;
            $cartProduct->size = $request->input('size');
            $cartProduct->pcs = 0;
        }

        $cartProduct->pcs += $request->input('pcs');

        $cartProduct->save();

        // Redirect back to the product page with a success message
        return redirect()->back()->with('message', 'Product added to cart!');
    }

    //remove item
    public function destroy(Request $request, $id)
    {
        if(Auth::id() == null) {
            $cart = session()->get('cart', []);

            $cart = array_filter($cart, function($cartProduct) use($id, $request) {
                return $cartProduct->product_id != $id || $cartProduct->size != $request->input('size');
            });

            session()->put('cart', $cart);
        }
        $cartProduct = CartProduct::where('product_id', $id)
                        ->where('size', $request->input('size'))
                        ->first();

        $cartProduct->delete();
    }

    //update item
    public function update(Request $request, $id)
    {
        if(Auth::id() == null) {
            $cart = session()->get('cart', []);

            $cart = array_map(function($cartProduct) use($id, $request) {
                if($cartProduct->product_id == $id && $cartProduct->size == $request->input('size')) {
                    $cartProduct->pcs = $request->input('pcs');
                }

                return $cartProduct;
            }, $cart);

            session()->put('cart', $cart);
        }
        $cartProduct = CartProduct::where('product_id', $id)
                        ->where('size', $request->input('size'))
                        ->first();

        $cartProduct->pcs = $request->input('pcs');

        $cartProduct->save();
    }
}
