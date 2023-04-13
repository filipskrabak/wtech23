@extends('layouts.main')

@section('title', 'Products')

@section('content')

<div class="container">
    <div class="row justify-content-center align-items-center">
        <div class="col"><h1>T-Shirts</h1></div>
        <div class="col-auto text-end"><span class="result-counter">0</span> results</div>
    </div>
</div>
<div class="container py-3 border-bottom">
    <div class="row row-cols-6 justify-content-center align-items-center g-2">
        <div class="col col-lg-2 col-6">
            <div class="input-group mb-3">
                <label class="input-group-text" for="inputGroupSelect01">Size</label>
                <select class="form-select" id="inputGroupSelect01">
                    <option value="1">S</option>
                    <option value="2">M</option>
                    <option value="3">L</option>
                </select>
            </div>
        </div>
        <div class="col col-lg-2 col-6">
            <div class="input-group mb-3">
                <label class="input-group-text" for="inputGroupSelect02">Color</label>
                <select class="form-select" id="inputGroupSelect02">
                    <option value="1">Red</option>
                    <option value="2">Blue</option>
                    <option value="3">Green</option>
                </select>
            </div>
        </div>
        <div class="col col-lg-3 col-12">
            <div class="input-group mb-3">
            <span class="input-group-text" id="price-from">From</span>
            <input type="text" class="form-control" placeholder="20€" aria-label="from" aria-describedby="price-from">
            <span class="input-group-text" id="price-to">To</span>
            <input type="text" class="form-control" placeholder="40€" aria-label="to" aria-describedby="price-to">
            </div>
        </div>
        <div class="col-lg-3 col-12 ms-auto">
            <div class="input-group mb-3">
                <label class="input-group-text" for="inputGroupSelect03">Order by</label>
                <select class="form-select" id="inputGroupSelect03">
                    <option value="1">Newest first</option>
                    <option value="2">Lowest price first</option>
                    <option value="3">Oldest first</option>
                    <option value="3">Highest price first</option>
                </select>
            </div>
        </div>
    </div>
</div>
<div class="container mb-5">
    <div class="row row-cols-md-2 justify-content-center align-items-center g-2">
        @foreach ($products as $product)
            <div class="col position-relative mb-2">
                @foreach ($product->images as $image)
                    @if ($loop->first)
                        <img src="/{{$image->path}}/{{$image->name}}" class="img-fluid" alt="{{$image->alt}}">
                    @endif
                @endforeach
                <div class="row g-2">
                    <div class="col text-truncate fw-bolder">{{$product->name}}</div>
                    <div class="col-auto text-end">{{$product->price}}<span class="price-currency-symbol ms-2">€</span></div>
                </div>
                <a href="/product/{{$product->id}}" class="stretched-link"></a>
            </div>
        @endforeach
    </div>
</div>
<nav aria-label="Pagination">
    <ul class="pagination justify-content-center">
        <li class="page-item disabled">
        <a class="page-link" href="#" tabindex="-1">Previous</a>
        </li>
        <li class="page-item active"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item">
        <a class="page-link" href="#">Next</a>
        </li>
    </ul>
</nav>

@endsection
