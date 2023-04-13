<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CartController extends Controller
{
    //Show cart
    public function index(){
        return view('cart');
    }

    //add item
    //remove item
    //increase/decreas pcs
}
