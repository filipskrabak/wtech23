@extends('layouts.main')

@section('title', 'Product')

@section('content')

<div class="container my-5 pb-4 border-bottom product-container">
    <div class="row justify-content-center align-items-start g-5">
        <div class="col-md-6">
            <div class="product-gallery-slider" style="opacity:0">
            <ul id="lightSlider">
                @if(count($images) > 0)
                    @foreach ($images as $image)
                        <li data-thumb="/{{$image->path}}/{{$image->name}}">
                            <img src="/{{$image->path}}/{{$image->name}}" alt="{{$image->alt}}">
                        </li>
                    @endforeach
                @else
                <li data-thumb="https://placehold.co/1000x1000?text=No Image Found">
                    <img src="https://placehold.co/1000x1000?text=No Image Found" alt="No Image Found">
                </li>
                @endif
            </ul></div>
        </div>
        <div class="col-md-6 product-meta">
            <h1>
                {{$product->name}}
            </h1>
            <div class="product-desription">
                <p>{{$product->description}}</p>
            </div>
            <h2>
                {{$product->price}}<span class="price-currency-symbol ms-2">€</span>
            </h2>
            <form action="/cart/{{$product->id}}" method="POST">
                @csrf
                <div class="input-group mb-3">
                    <label class="input-group-text" for="inputGroupSelect01">Size</label>
                    <select class="form-select w-50" id="inputGroupSelect01" name="size">
                        @foreach ($sizes as $size)
                            <option  @selected(old('size') == $size->value)>{{$size->value}}</option>
                        @endforeach
                    </select>
                    <span class="input-group-text" id="pcs">Pcs</span>
                    <input type="number" class="form-control" placeholder="1" aria-label="to" aria-describedby="pcs" name="pcs" value="1" min="1">
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" id="cartAddBtn" class="btn btn-primary">
                        Add to Cart
                    </button>
                </div>
            </form>
        </div>
    </div>
  </div>
  <div class="container related-products mb-5">
    <div class="row">
        <div class="col">
            <h2>Similar products</h2>
        </div>
    </div>
    <div class="row row-cols-lg-4 row-cols-md-2 g-3 my-3 related-products-row">
        <div class="col position-relative">
            <img src="https://placeholder.com/1000x1000" class="img-fluid" alt="{product-name}">
            <div class="row g-2">
                <div class="col text-truncate fw-bolder">{product-name}, can be truncate if not short enough</div>
                <div class="col-auto text-end">100.00<span class="price-currency-symbol ms-2">€</span></div>
            </div>
            <a href="#" class="stretched-link"></a>
        </div>
        <div class="col position-relative">
            <img src="https://placeholder.com/1000x1000" class="img-fluid" alt="{product-name}">
            <div class="row g-2">
                <div class="col text-truncate fw-bolder">{product-name}, can be truncate if not short enough</div>
                <div class="col-auto text-end">100.00<span class="price-currency-symbol ms-2">€</span></div>
            </div>
            <a href="#" class="stretched-link"></a>
        </div>
        <div class="col position-relative">
            <img src="https://placeholder.com/1000x1000" class="img-fluid" alt="{product-name}">
            <div class="row g-2">
                <div class="col text-truncate fw-bolder">{product-name}, can be truncate if not short enough</div>
                <div class="col-auto text-end">100.00<span class="price-currency-symbol ms-2">€</span></div>
            </div>
            <a href="#" class="stretched-link"></a>
        </div>
        <div class="col position-relative">
            <img src="https://placeholder.com/1000x1000" class="img-fluid" alt="{product-name}">
            <div class="row g-2">
                <div class="col text-truncate fw-bolder">{product-name}, can be truncate if not short enough</div>
                <div class="col-auto text-end">100.00<span class="price-currency-symbol ms-2">€</span></div>
            </div>
            <a href="#" class="stretched-link"></a>
        </div>
    </div>
</div>

@endsection
