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
    public function index(Request $request){
        $orders = $request->user()->orders()->paginate(10);

        return view('orders.index', [
            'orders'=> $orders
        ]);
    }

    // Show order details
    public function show(Order $order) {
        // Check if user is authorized to view order
        if($order->user_id != null && ((Auth::check() && Auth::user()->id != $order->user_id && Auth::user()->role == 0) || !Auth::check())) {
            // redirect to /
            return redirect("/");
        }

        $orderProducts = $order->products;

        // calculate price for the order
        $total = 0;
        foreach($orderProducts as $orderProduct) {
            $total += $orderProduct->price * $orderProduct->pivot->pcs;
        }

        return view('orders.show', [
            'order' => $order,
            'orderProducts' => $orderProducts,
            'total' => $total
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
            'agreement' => 'required',
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
        // Redirect to order view
        return redirect()->route('orders.show', ['order' => $order]);
    }

    public function update(Request $request, Order $order) {
        $request->validate([
            'status' => 'required',
        ]);

        $order->status = $request->input('status');
        $order->save();

        return redirect('/dashboard/orders')
        ->with('message','Product has been deleted.');
    }

    public function destroy(Order $order) {
        $order->delete();

        return redirect('/dashboard/orders')
        ->with('message','Product has been deleted.');
    }
}
