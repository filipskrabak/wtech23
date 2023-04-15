@extends('layouts.main')

@section('title', 'Products')

@section('content')

<div class="container">
    <div class="row justify-content-center align-items-center">
        <div class="col"><h1>T-Shirts</h1></div>
        <div class="col-auto text-end"><span class="result-counter">{{@count($products)}}</span> results</div>
    </div>
</div>
<div class="container py-3 border-bottom">
    <form method="GET" action="">
        <div class="row row-cols-6 justify-content-center align-items-center g-2">
            <div class="col col-lg-2 col-6">
                <div class="input-group mb-3">
                    <label class="input-group-text" for="inputGroupSelect03">Gender</label>
                    <select class="form-select" id="inputGroupSelect03" name="gender">
                        <option>Any</option>
                        @foreach ($genders as $gender)
                            <option @selected(old('gender') == $gender->value)>{{$gender->value}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col col-lg-2 col-6">
                <div class="input-group mb-3">
                    <label class="input-group-text" for="inputGroupSelect04">Category</label>
                    <select class="form-select" id="inputGroupSelect04" name="category">
                        <option>Any</option>
                        @foreach ($categories as $cat)
                            <option @selected(old('category') == $cat->value)>{{$cat->value}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col col-lg-2 col-6">
                <div class="input-group mb-3">
                    <label class="input-group-text" for="inputGroupSelect01">Size</label>
                    <select class="form-select" id="inputGroupSelect01" name="size">
                        <option>Any</option>
                        @foreach ($sizes as $size)
                            <option  @selected(old('size') == $size->value)>{{$size->value}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col col-lg-2 col-6">
                <div class="input-group mb-3">
                    <label class="input-group-text" for="inputGroupSelect02">Color</label>
                    <select class="form-select" id="inputGroupSelect02" name="color">
                        <option>Any</option>
                        @foreach ($colors as $color)
                            <option @selected(old('color') == $color->value)>{{$color->value}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col col-lg-4 col-12">
                <div class="input-group mb-3">
                <span class="input-group-text" id="price-from">From</span>
                <input type="text" class="form-control" placeholder="20€" aria-label="from" aria-describedby="price-from" name="price-from" value="{{old('price-from')}}">
                <span class="input-group-text" id="price-to">To</span>
                <input type="text" class="form-control" placeholder="40€" aria-label="to" aria-describedby="price-to" name="price-to" value="{{old('price-to')}}">
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-lg-3 col-12 ms-auto">
                <div class="input-group mb-3">
                    <label class="input-group-text" for="inputGroupSelectOrder">Order by</label>
                    <select class="form-select" id="inputGroupSelectOrder" name="order">
                        <option value="newest" @selected(old('order') == "newest")>Newest first</option>
                        <option value="lowest-price" @selected(old('order') == "lowest-price")>Lowest price first</option>
                        <option value="oldest" @selected(old('order') == "oldest")>Oldest first</option>
                        <option value="highest-price" @selected(old('order') == "highest-price")>Highest price first</option>
                    </select>
                </div>
            </div>
            <div class="col col-lg-2 col-6">
                <div class="input-group mb-3">
                    <button type="submit" class="btn btn-primary w-100">Filter</button>
                </div>
            </div>
        </div>
    </form>
</div>
<div class="container mb-5">
    <div class="row row-cols-md-2 justify-content-center align-items-center g-2">
        @foreach ($products as $product)
            <div class="col position-relative mb-2">
                @foreach ($product->images as $image)
                    @if ($loop->first)
                        <div class="image-container mt-3">
                            <img src="/{{$image->path}}/{{$image->name}}" class="img-fluid" alt="{{$image->alt}}">
                        </div>
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
