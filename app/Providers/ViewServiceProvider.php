<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //

        view()->composer('layouts.main', function ($view) {
            // check if user is logged in
            if (Auth::check()) {
                // get user
                $user = Auth::user();

                // get user's cart products
                $cartProducts = $user->cartProducts;

                // get cart products count
                $cartCount = $cartProducts->count();

                // share cart products count with view
                $view->with('cartCount', $cartCount);
            } else {
                // check if session has cart
                if(session()->has('cart')) {
                    $view->with('cartCount', count(session()->get('cart')));
                } else {
                    $view->with('cartCount', 0);
                }
            }
        });
    }
}
