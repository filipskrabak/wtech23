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
                <a href="#" class="cart-item-remove-btn" data-id="{{$cartproduct->product_id}}" data-size="{{$cartproduct->size}}">
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
                <p class="price-per-piece my-0">{{$cartproduct->product->price}} €</p>
            </div>
            <div class="col-lg-2 col-md-3 col-5 d-flex align-items-center">
                <div class="input-group mx-auto">
                <button type="button" class="btn btn-outline-secondary minus-btn"  data-id="{{$cartproduct->product_id}}" data-size="{{$cartproduct->size}}">-</button>
                <input type="text" class="form-control text-center qty-input" value="{{$cartproduct->pcs}}">
                <button type="button" class="btn btn-outline-secondary plus-btn"  data-id="{{$cartproduct->product_id}}" data-size="{{$cartproduct->size}}">+</button>
                </div>
            </div>
            <div class="col-lg-1 col-md-auto col-4">
                <p class="total-price my-0">{{$cartproduct->pcs*$cartproduct->product->price}} €</p>
            </div>
        </div>
    @endforeach
    @php
        $total = 0;
    @endphp
    @foreach ($cartproducts as $cartproduct)
        @php
            $productTotal = $cartproduct->pcs * $cartproduct->product->price;
            $total += $productTotal;
        @endphp
    @endforeach
</div>
<div class="container">
    <div class="row justify-content-start">
        <div class="col-auto">
            <a name="refresh-btn" id="refresh-btn" class="btn btn-light" href="/cart" role="button">Refresh prices</a>
        </div>
    </div>
</div>

<hr class="d-md-none">
<div class="container">
    <div class="row justify-content-end">
        <div class="col-md-4 col-12">
            <div class="row">
                <div class="col-6 text-end">
                    <p>VAT</p>
                </div>
                <div class="col-6 text-end">
                    <p>{{ number_format($total / 6, 2) }} €</p>
                </div>
            </div>
            <div class="row">
                <div class="col-6 text-end">
                    <p class="fw-bold">Total</p>
                </div>
                <div class="col-6 text-end">
                    <p class="fw-bold">{{ $total }} €</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-end align-items-center">
        <div class="col-md-4 col-12 pb-5 d-grid gap-2">
            <a href="/checkout" class="btn btn-primary">Checkout</a>
        </div>
    </div>
</div>
<script>
    let minusButtons = document.querySelectorAll('.minus-btn');
    let plusButtons = document.querySelectorAll('.plus-btn');
    let removeButtons = document.querySelectorAll('.cart-item-remove-btn');

    minusButtons.forEach(button => {
    button.addEventListener('click', decreasePcs);
    });

    plusButtons.forEach(button => {
    button.addEventListener('click', increasePcs);
    });

    removeButtons.forEach(button => {
        button.addEventListener('click', removeCartItem);
    });

    function increasePcs(event) {
        let id = this.getAttribute('data-id');
        let size = this.getAttribute('data-size');
        let inputEl = event.target.parentElement.querySelector('.qty-input');
        let pcs = parseInt(inputEl.value);
        let newPcs = pcs + 1;
        inputEl.value = newPcs;
        updateCart(id, newPcs, size);
    }

    function decreasePcs(event) {
        let id = this.getAttribute('data-id');
        let size = this.getAttribute('data-size');
        let inputEl = event.target.parentElement.querySelector('.qty-input');
        let pcs = parseInt(inputEl.value);
        if (pcs > 1) {
            let newPcs = pcs - 1;
            inputEl.value = newPcs;
            updateCart(id, newPcs, size);
        }
    }

    function updateCart(productId, qty, size) {
        console.log(productId, qty, size);
        fetch(`/cart/${productId}`, {
            method: 'PUT',
            headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({size: size, pcs: qty})
        })
        .then(response => {
            if (!response.ok) {
            console.log('Failed to update cart');
            }
        })
        .catch(error => console.error(error));
    }

    function removeCartItem(event) {
        let id = this.getAttribute('data-id');
        let size = this.getAttribute('data-size');

        fetch(`/cart/${id}?size=${size}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => {
            if (response.ok) {
                this.parentElement.parentElement.remove();
            } else {
                console.log('Failed to remove cart item');
            }
        })
        .catch(error => console.error(error));
    }
</script>

@endsection
