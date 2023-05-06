@extends('layouts.main')

@section('title', 'Checkout')

@section('content')

<section class="container mb-5">
    <div class="row d-flex justify-content-center">
        <div class="col-md-6">
        <h1 class="mt-5 mb-4 text-center">Checkout</h1>
        @auth
        @else
        <div class="row mb-3 checkout-border align-items-center not-logged-in-bar">
            <div class="col-md-8">
                <p class="pt-1">Returning customer? Logged in users have the option to save their billing address</p>
            </div>
            <div class="col-md-4 mb-2">
                <button type="submit" class="btn btn-primary w-100">Log In</button>
            </div>
        </div>
        @endif
        <form method="POST" action="/orders">
        @csrf
            <div id="step-1">
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-floating mb-3">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="floatingName" value="{{$user->name ?? '' }}" name="name" placeholder="Pezinská">
                    <label for="floatingName">Name</label>
                    @error('name')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-floating mb-3">
                    <input type="text" class="form-control @error('surname') is-invalid @enderror" id="floatingSurname" value="{{$user->surname ?? '' }}" name="surname" placeholder="Pezinská">
                    <label for="floatingSurname">Surname</label>
                    @error('surname')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                    </div>
                </div>
                </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control @error('street') is-invalid @enderror" id="floatingAddress" value="" name="street" placeholder="Pezinská">
                <label for="floatingAddress">Address and number</label>
                <ul id="street-suggestions"></ul>
                @error('street')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <div class="form-floating mb-3">
                    <input type="text" class="form-control @error('postcode') is-invalid @enderror" id="floatingPostcode" value="" name="postcode" placeholder="Pezinská">
                    <label for="floatingPostcode">Postcode</label>
                    <ul id="postcode-suggestions"></ul>
                    @error('postcode')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="form-floating mb-3">
                    <input type="text" class="form-control @error('city') is-invalid @enderror" id="floatingCity" value="" name="city" placeholder="Pezinská">
                    <label for="floatingCity">City</label>
                    @error('city')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                    </div>
                </div>
                </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control @error('country') is-invalid @enderror" id="floatingCountry" value="" name="country" placeholder="Pezinská">
                <label for="floatingCountry">Country</label>
                @error('country')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control @error('phone') is-invalid @enderror" id="floatingPhone" value="{{$user->phone ?? '' }}" name="phone" placeholder="Pezinská">
                <label for="floatingPhone">Phone</label>
                @error('phone')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="form-floating mb-3">
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="floatingEmail" value="{{$user->email ?? '' }}" name="email" placeholder="Pezinská">
                <label for="floatingEmail">Email</label>
                @error('email')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
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
                                        <input class="form-check-input" type="radio" name="shipppingMethod" id="shipping1" value="DHL">
                                        <label class="form-check-label" for="shipping1">DHL: 2€</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="shipppingMethod" id="shipping2" value="SP">
                                        <label class="form-check-label" for="shipping2">Slovneská pošta: 2€</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="shipppingMethod" id="shipping3" value="GLS">
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
                                        <input class="form-check-input" type="radio" name="PaymentMethod" id="payment1" value="cod">
                                        <label class="form-check-label" for="payment1">Cash on delivery</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="PaymentMethod" id="payment2" value="card">
                                        <label class="form-check-label" for="payment2">Credit/Debit card</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="PaymentMethod" id="payment3" value="paypal">
                                        <label class="form-check-label" for="payment3">Paypal</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3 justify-content-center">
                        <div class="col">
                            <div class="container d-flex align-items-between justify-content-between">
                                <div class="form-check mb-3 col-md-8">
                                    <input class="form-check-input" type="checkbox" value="agreement" name="agreement" id="agreement" required>
                                    <label class="form-check-label" for="agreement">Accept agreement</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3 justify-content-center">
                        <div class="mb-3 col-md-6">
                            <button  type="button" id="checkout-previous" class="btn btn-light">Back</a>
                        </div>
                        <div class="mb-3 col-md-6">
                            <button type="submit" class="btn btn-primary w-100">Order</button>
                        </div>
                    </div>
            </div>
        </form>  
        </div>
    </div>
</section>
<script>
    function validateForm() {
        let formValid = true;
        const inputs = document.querySelectorAll("#step-1 input");
        inputs.forEach((input) => {
            if (input.value === "") {
                input.classList.add("is-invalid");
                formValid = false;
            } else if (input.name === 'email' && !/\S+@\S+\.\S+/.test(input.value)) { //copied from stackoverflow: https://stackoverflow.com/questions/46155/how-can-i-validate-an-email-address-in-javascript 
                input.classList.add('is-invalid');
                formIsValid = false;
            } else {
                input.classList.remove("is-invalid");
            }
        });
        return formValid;
    }
    document.getElementById('checkout-next').addEventListener('click', function() {
        if(validateForm()){
            document.getElementById('step-1').style.display = 'none';
            document.getElementById('step-2').style.display = 'block';
        }
    });
    document.getElementById('checkout-previous').addEventListener('click', function() {
        document.getElementById('step-1').style.display = 'block';
        document.getElementById('step-2').style.display = 'none';
        document.getElementById('agreement').checked = false;
    });

    const postcodeInput = document.getElementById('floatingPostcode');
    postcodeInput.addEventListener('input', fetchPostcodeSuggestions);

    async function fetchPostcodeSuggestions() {
        const postcode = postcodeInput.value;
        const response = await fetch('/checkout/postcode', {
            method: 'POST',
            headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
            body: JSON.stringify({ postcode })
        });
        const suggestions = await response.json();
        console.log(suggestions); // Log the retrieved suggestions to the console
    }
</script>

@endsection
