@extends('layouts.main')

@section('title', 'Order')

@section('content')

<div class="container">
    <div class="row justify-content-center align-items-center g-2">
        <div class="col">
            <h1 class="mt-5 mb-4 text-center">Order n. {{$order->id}}</h1>
        </div>
    </div>
</div>
<div class="container">
    @foreach ($orderProducts as $orderProduct)
        <div class="row cart-item align-items-center py-2">
            <div class="col-md-2 col-4">
                @if(count($orderProduct->images) > 0)
                @foreach ($orderProduct->images as $image)
                    @if ($loop->first)
                        <img src="/{{$image->path}}/{{$image->name}}" alt="{{$image->alt}}" class="img-fluid">
                    @endif
                @endforeach
                @else
                    <img src="https://placehold.co/1000x1000?text=No Image Found" class="img-fluid" alt="Product Image">
                @endif
            </div>
            <div class="col-lg-5 col-md-3 col-6">
                <p class="fw-bold text-truncate">{{$orderProduct->name}}</p>
                <p>Size: {{$orderProduct->pivot->size}}</p>
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
                <p class="price-per-piece my-0">{{$orderProduct->price}} € <sub>/ pc</sub></p>
            </div>
            <div class="col-lg-2 col-md-3 col-5 d-flex align-items-center">
                <p class="my-0">{{$orderProduct->pivot->pcs}} pcs</p>
            </div>
            <div class="col-lg-1 col-md-auto col-4">
                <p class="total-price my-0">{{$orderProduct->pivot->pcs*$orderProduct->price}} €</p>
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
</div>

@endsection
