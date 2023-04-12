@extends('layouts.main')

@section('title', 'Register')

@section('content')

<section class="container mb-5">
    <div class="row d-flex justify-content-center">
    <div class="col-md-6">
        <h1 class="mt-5 mb-4 text-center">Login</h1>
        <form method="POST" action="/users/authenticate">
            @csrf
            <div class="form-floating mb-3">
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="emailInput" placeholder="name@example.com" name="email" value="{{old('email')}}" required>
                <label for="emailInput">Email address</label>
                
                @error('email')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="passwordInput" placeholder="Password" name="password" value="{{old('password')}}">
                <label for="passwordInput">Password</label>

                @error('password')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>
            <div class="row">
                <div class="col-md-4">
                <button type="submit" class="btn btn-primary w-100">Login</button>
                </div>
            </div>
        </form>  
        <div class="row d-flex  justify-content-center">
        <div class="col-md-4">
            <h2 class="mt-5 mb-4 text-center">Not a member?</h2>
            <a id="register-btn" class="btn btn-outline-primary w-100" href="/register" role="button">Register</a>  
        </div>
        </div>
    </div>
    </div>
</section>

@endsection