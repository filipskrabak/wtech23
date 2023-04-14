@extends('layouts.main')

@section('title', 'Edit details')

@section('content')

<section class="container mb-5">
    <div class="row d-flex justify-content-center">
      <div class="col-md-6">
        <h1 class="mt-5 mb-4 text-center">Edit details</h1>
        <form>
          <div class="form-floating mb-3">
            <input type="email" class="form-control" id="emailInput" placeholder="name@example.com">
            <label for="emailInput">Email address</label>
          </div>
          <div class="form-floating mb-3">
            <input type="text" class="form-control" id="nameInput" placeholder="John">
            <label for="nameInput">Name</label>
          </div>
          <div class="form-floating mb-3">
            <input type="text" class="form-control" id="surnameInput" placeholder="Doe">
            <label for="surnameInput">Surname</label>
          </div>

          <div class="row">
            <div class="col-lg-3">
              <div class="form-floating mb-3">
                <input type="text" class="form-control" id="postcodeInput" placeholder="Pezinská">
                <label for="postcodeInput">Postcode</label>
              </div>
            </div>
            <div class="col-lg-9">
              <div class="form-floating mb-3">
                <input type="text" class="form-control" id="streetInput" placeholder="Pezinská">
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
        <form>
          <div class="form-floating mb-3">
            <input type="password" class="form-control" id="passwordInput" placeholder="Password">
            <label for="passwordInput">New password</label>
            <p class="text-muted mt-1">At least 8 characters</p>
          </div>
          <div class="form-floating mb-3">
            <input type="password" class="form-control" id="passwordInput2" placeholder="Repeat password">
            <label for="passwordInput2">Repeat new password</label>
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
