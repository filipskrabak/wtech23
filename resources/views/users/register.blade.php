@extends('layouts.main')

@section('title', 'Register')

@section('content')

<section class="container mb-5">
    <div class="row d-flex justify-content-center">
    <div class="col-md-6">
        <h1 class="mt-5 mb-4 text-center">Register</h1>
        <form method="POST" action="/users">
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
                <p class="text-muted mt-1">At least 8 characters</p>

                @error('password')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="repeatPasswordInput" placeholder="Password" name="password_confirmation" value="{{old('password_confirmation')}}">
                <label for="repeatPasswordInput">Repeat password</label>

                @error('password_confirmation')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>
            <div class="row justify-content-center">
                <div class="col-md-4">
                <button type="submit" class="btn btn-primary w-100">Register</button>
                </div>
            </div>
        </form>  
    </div>
    </div>
</section>

@endsection