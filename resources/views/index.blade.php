@extends('layouts.main')

@section('content')

<section class="container mb-5">
    <h1 class="mb-4">Featured</h1>
    <div class="row featured-items">
    <div class="col-md-3">
        <a href="./product-archive.html" class="text-decoration-none text-dark">
        <div class="d-flex flex-column align-items-center">
            <div class="overflow-hidden">
            <img src="./img/jeans.png" alt="" class="w-100 mt-4 mt-md-0 product-image">
            </div>
            <p class="item-description">Jeans</p>
        </div>
        </a>
    </div>
    <div class="col-md-3">
        <a href="./product-archive.html" class="text-decoration-none text-dark">
        <div class="d-flex flex-column align-items-center">
            <div class="overflow-hidden">
            <img src="./img/hoodie.png" alt="" class="w-100 mt-4 mt-md-0 product-image">
            </div>
            <p class="item-description">Hoodies</p>
        </div>
        </a>
    </div>
    <div class="col-md-3">
        <a href="./product-archive.html" class="text-decoration-none text-dark">
        <div class="d-flex flex-column align-items-center">
            <div class="overflow-hidden">
            <img src="./img/jacket.png" alt="" class="w-100 mt-4 mt-md-0 product-image">
            </div>
            <p class="item-description">Jackets</p>
        </div>
        </a>
    </div>
    <div class="col-md-3">
        <a href="./product-archive.html" class="text-decoration-none text-dark">
        <div class="d-flex flex-column align-items-center">
            <div class="overflow-hidden">
            <img src="./img/sneakers.png" alt="" class="w-100 mt-4 mt-md-0 product-image">
            </div>
            <p class="item-description">Sneakers</p>
        </div>
        </a>
    </div>
    </div>
</section>

@endsection