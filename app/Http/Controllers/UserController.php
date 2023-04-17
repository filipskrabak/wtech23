<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Models\Postcode;
use App\Models\Street;

class UserController extends Controller
{
    // Show register form
    public function create() {
        return view('users.register');
    }

    // Create a new user
    public function store(Request $request) {
        $formFields = $request->validate([
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => 'required|confirmed|min:8'
        ]);

        // Password hashing
        $formFields['password'] = bcrypt($formFields['password']);

        // Create the user
        $user = User::create($formFields);

        // Login
        auth()->login($user);

        return redirect('/')->with('message', 'Registration successful! You are now logged in.');
    }

    public function logout(Request $request) {
        auth()->logout();

        // Regenerate CSRF token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'You have been logged out.');
    }

    public function login() {
        return view('users.login');
    }

    public function authenticate(Request $request) {
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);

        if(auth()->attempt($formFields)) {
            $request->session()->regenerate();

            return redirect('/')->with('message', 'You are now logged in.');
        }

        return back()->withErrors([
            'password' => 'Invalid email or password!',
            'email' => 'Invalid email or password!'
        ])->onlyInput('email');
    }

    public function edit(Request $request) {
        $user = $request->user();
        return view('users.edit', ['user' => $user]);
    }

    public function editDetails(Request $request) {
        $user = $request->user();
        $formFields = $request->validate([
            'email' => ['email', Rule::unique('users', 'email')->ignore($user->id)],
            'name' => 'nullable|max:32',
            'surname' => 'nullable|max:32',
            'phone' => 'nullable|max:15',
            'postcode' => ['nullable', Rule::exists('postcodes', 'postcode')],
            'street' => ['nullable', Rule::exists('streets', 'name')]
        ]);
        $formFields = array_filter($formFields);

        if (array_key_exists('postcode', $formFields)){
            $user->postcode_id = (Postcode::where('postcode', $formFields['postcode'])->first()->id);
            $user->save();
            unset($formFields['postcode']);
        }

        if (array_key_exists('street', $formFields)){
            $user->street_id = (Street::where('name', $formFields['street'])->first()->id);
            $user->save();
            unset($formFields['street']);
        }

        $user->update($formFields);

        return redirect('/edit')->with('message', 'Your details have been changed.');
    }

    public function editPassword(Request $request) {
        $formFields = $request->validate([
            'password' => 'required|confirmed|min:8'
        ]);

        $formFields['password'] = bcrypt($formFields['password']);

        $user = $request->user();
        $user->password = $formFields['password'];
        $user->save();

        return redirect('/edit')->with('message', 'Your password has been changed.');
    }
}
