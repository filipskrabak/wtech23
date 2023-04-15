@extends('layouts.main')

@section('title', 'Cart')

@section('content')

<div class="container">
    <div class="row justify-content-center align-items-center g-2">
        <div class="col">
            <h1 class="mt-5 mb-4 text-center">Cart</h1>
        </div>
    </div>
</div>
<div class="container">
    @foreach ($cartproducts as $cartproduct)
        <div class="row cart-item align-items-center py-2">
            <div class="col-md-1 col-2">
                <a href="#">
                <img src="./img/x-circle.svg" class="w-50 p-xl-2 p-lg-1 p-md-0 p-sm-1 cart-remove-icon" alt="Remove">
                </a>
            </div>
            <div class="col-md-2 col-4">
                @if(count($cartproduct->product->images) > 0)
                @foreach ($cartproduct->product->images as $image)
                    @if ($loop->first)
                        <img src="/{{$image->path}}/{{$image->name}}" alt="{{$image->alt}}" class="img-fluid">
                    @endif
                @endforeach
                @else
                    <img src="https://placehold.co/1000x1000?text=No Image Found" class="img-fluid" alt="Product Image">
                @endif
            </div>
            <div class="col-lg-5 col-md-3 col-6">
                <p class="fw-bold text-truncate">{{$cartproduct->product->name}}</p>
                <p>Size: {{$cartproduct->size}}</p>
            </div>
            <div class="col-lg-1 col-md-2 col-3 d-md-none pt-3">
                <p class="fw-bold">Price</p>
            </div>
            <div class="col-md-2 col-5 d-flex align-items-center d-md-none pt-3">
                <p class="fw-bold">Pieces</p>
            </div>
            <div class="col-lg-1 col-md-2 col-4 d-md-none pt-3">
                <p class="fw-bold">Subtotal</p>
            </div>
            <div class="col-lg-1 col-md-auto col-3">
                <p class="price-per-piece my-0">{{$cartproduct->product->price}}</p>
            </div>
            <div class="col-lg-2 col-md-3 col-5 d-flex align-items-center">
                <div class="input-group mx-auto">
                <button type="button" class="btn btn-outline-secondary minus-btn">-</button>
                <input type="text" class="form-control text-center qty-input" value="{{$cartproduct->pcs}}">
                <button type="button" class="btn btn-outline-secondary plus-btn">+</button>
                </div>
            </div>
            <div class="col-lg-1 col-md-auto col-4">
                <p class="total-price my-0">{{$cartproduct->pcs*$cartproduct->product->price}} €</p>
            </div>
        </div>
    @endforeach
</div>
<hr class="d-md-none">
<div class="container">
    <div class="row justify-content-end">
        <div class="col-md-4 col-12">
            <div class="row">
                <div class="col-6 text-end">
                    <p class="fw-bold">VAT</p>
                </div>
                <div class="col-6 text-end">
                    <p class="fw-bold">10.00 €</p>
                </div>
            </div>
            <div class="row">
                <div class="col-6 text-end">
                    <p class="fw-bold">Total</p>
                </div>
                <div class="col-6 text-end">
                    <p class="fw-bold">10.00 €</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-end align-items-center">
        <div class="col-md-4 col-12 pb-5 d-grid gap-2">
            <a href="./checkout-step1.html" class="btn btn-primary">Checkout</a>
        </div>
    </div>
</div>

@endsection
