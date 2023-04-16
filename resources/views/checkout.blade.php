@extends('layouts.main')

@section('title', 'Checkout')

@section('content')

<section class="container mb-5">
    <div class="row d-flex justify-content-center">
        <div class="col-md-6">
        <h1 class="mt-5 mb-4 text-center">Checkout</h1>
        <div class="row mb-3 checkout-border align-items-center">
            <div class="col-md-8">
                <p class="pt-1">Returning customer? Logged in users have the option to save their billing address</p>
            </div>
            <div class="col-md-4 mb-2">
                <button type="submit" class="btn btn-primary w-100">Log In</button>
            </div>
        </div>
        <form method="POST" action="/orders">
            <div id="step-1">
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingName" value="{{$user->name ?? '' }}" name="name" placeholder="Pezinská">
                    <label for="floatingName">Name</label>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingSurname" value="{{$user->surname ?? '' }}" name="surname" placeholder="Pezinská">
                    <label for="floatingSurname">Surname</label>
                    </div>
                </div>
                </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingAddress" value="" name="street" placeholder="Pezinská">
                <label for="floatingAddress">Address and number</label>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingPostcode" value="" name="postcode" placeholder="Pezinská">
                    <label for="floatingPostcode">Postcode</label>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingCity" value="" name="city" placeholder="Pezinská">
                    <label for="floatingCity">City</label>
                    </div>
                </div>
                </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingCountry" value="" name="country" placeholder="Pezinská">
                <label for="floatingCountry">Country</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingPhone" value="{{$user->phone ?? '' }}" name="phone" placeholder="Pezinská">
                <label for="floatingPhone">Phone</label>
            </div>
            <div class="form-floating mb-3">
                <input type="email" class="form-control" id="floatingEmail" value="{{$user->email ?? '' }}" name="email"placeholder="Pezinská">
                <label for="floatingEmail">Email</label>
            </div>
            <div class="row d-flex justify-content-end">
            <div class="col-md-4 d-grid">
                <button type="button" class="btn btn-primary" id="checkout-next">Next</button>
            </div>
            </div>
            </div>
            <div id="step-2" style="display: none;">
                    <div class="row justify-content-center">
                        <div class="col border-bottom border-dark">
                            @foreach ($products as $cartproduct)
                            <div class="container d-flex align-items-center justify-content-between">
                                <div class="col-md-6">
                                    <p class="fw-bold">{{$cartproduct->product->name}}</p>
                                    <p>{{$cartproduct->pcs}} Pcs, Size: {{$cartproduct->size}}</p>
                                </div>
                                <div class="col-md-6 text-end">
                                    <p>{{$cartproduct->product->price}} €</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @php
                        $subtotal = 0;
                    @endphp
                    @foreach ($products as $cartproduct)
                        @php
                            $productTotal = $cartproduct->pcs * $cartproduct->product->price;
                            $subtotal += $productTotal;
                        @endphp
                    @endforeach
                    <div class="row mt-3 justify-content-center">
                        <div class="col border-bottom border-dark">
                            <div class="container d-flex align-items-center justify-content-between">
                                <div class="col-md-6">
                                    <p class="fw-bold">Subtotal</p>
                                </div>
                                <div class="col-md-6 text-end">
                                    <p>{{ $subtotal }} €</p>
                                </div>
                            </div>
                            <div class="container d-flex align-items-start justify-content-between">
                                <div class="col-md-6">
                                    <p class="fw-bold">Shipping method</p>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="shipppingMethod" id="shipping1">
                                        <label class="form-check-label" for="shipping1">DHL: 2€</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="shipppingMethod" id="shipping2">
                                        <label class="form-check-label" for="shipping2">Slovneská pošta: 2€</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="shipppingMethod" id="shipping3">
                                        <label class="form-check-label" for="shipping3">GLS: 2€</label>
                                    </div>
                                </div>
                            </div>
                            <div class="container d-flex align-items-center mt-2 justify-content-between">
                                <div class="col-md-6">
                                    <p class="fw-bold">Total price</p>
                                </div>
                                <div class="col-md-6 text-end">
                                    <p>{{ $subtotal + 2}} €</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3 justify-content-center">
                        <div class="col border-bottom border-dark">
                            <div class="container d-flex align-items-start justify-content-between">
                                <div class="col-md-6 mb-3">
                                    <p class="fw-bold">Payment type</p>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="PaymentMethod" id="payment1">
                                        <label class="form-check-label" for="payment1">Cash on delivery</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="PaymentMethod" id="payment2">
                                        <label class="form-check-label" for="payment2">Credit/Debit card</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="PaymentMethod" id="payment3">
                                        <label class="form-check-label" for="payment3">Paypal</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3 justify-content-center">
                        <div class="col">
                            <div class="container d-flex align-items-between justify-content-between">
                                <div class="form-check mb-3 md-6 col-md-8">
                                    <input class="form-check-input" type="checkbox" value="" id="agreement" required>
                                    <label class="form-check-label" for="agreement">Accept agreement</label>
                                </div>
                                <div class="mb-3 col-md-4">
                                    <button type="submit" class="btn btn-primary w-100">Order</button>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </form>  
        </div>
    </div>
</section>
<script>
    document.getElementById('checkout-next').addEventListener('click', function() {
        document.getElementById('step-1').style.display = 'none';
        document.getElementById('step-2').style.display = 'block';
    });
</script>

@endsection
