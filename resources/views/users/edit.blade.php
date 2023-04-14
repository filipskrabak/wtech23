@extends('layouts.main')

@section('title', 'Edit')

@section('content')

<section class="container mb-5">
    <div class="row d-flex justify-content-center">
      <div class="col-md-6">
        <h1 class="mt-5 mb-4 text-center">Edit details</h1>
        <form method="POST" action="/edit/details">
        @csrf
          <div class="form-floating mb-3">
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="emailInput" value="{{$user->email}}" placeholder="name@example.com" name="email">
            <label for="emailInput">Email address</label>

            @error('email')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
          </div>
          <div class="form-floating mb-3">
            <input type="text" class="form-control" id="nameInput" value="{{$user->name}}" placeholder="John" name="name">
            <label for="nameInput">Name</label>
          </div>
          <div class="form-floating mb-3">
            <input type="text" class="form-control" id="surnameInput" value="{{$user->surname}}" placeholder="Doe" name="surname">
            <label for="surnameInput">Surname</label>
          </div>
          <div class="form-floating mb-3">
            <input type="text" class="form-control" id="phoneInput" value="{{$user->phone}}" placeholder="+42190444258" name="phone">
            <label for="phoneInput">Phone</label>
          </div>

          <div class="row">
            <div class="col-lg-3">
              <div class="form-floating mb-3">
                <input type="text" class="form-control" id="postcodeInput" value="" placeholder="Pezinská" name="postcode">
                <label for="postcodeInput">Postcode</label>
              </div>
            </div>
            <div class="col-lg-9">
              <div class="form-floating mb-3">
                <input type="text" class="form-control" id="streetInput" value="" placeholder="Pezinská" name="street">
                <label for="streetInput">Street</label>
              </div>
            </div>
          </div>
          <div class="row justify-content-center">
            <div class="col-md-auto">
              <button type="submit" class="btn btn-primary w-100">Save details</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </section>

  <section class="container mb-5">
    <div class="row d-flex justify-content-center">
      <div class="col-md-6">
        <h1 class="mt-4 mb-4 text-center">Change password</h1>
        <form method="POST" action="/edit/password">
        @csrf
          <div class="form-floating mb-3">
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="passwordInput" placeholder="Password" name="password" >
            <label for="passwordInput">New password</label>
            <p class="text-muted mt-1">At least 8 characters</p>

            @error('password')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
          </div>
          <div class="form-floating mb-3">
            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="passwordConf" placeholder="Repeat password" name="password_confirmation">
            <label for="passwordConf">Repeat new password</label>

            @error('password_confirmation')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
          </div>
          <div class="row justify-content-center">
            <div class="col-md-auto">
              <button type="submit" class="btn btn-primary w-100">Save password</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </section>

@endsection
