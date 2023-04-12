<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Show register form
    public function create() {
        return view('users.register');
    }

    // Create a new user
    public function store(Request $request) {

    }
}
