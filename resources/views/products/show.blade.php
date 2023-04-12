@extends('layouts.main')

@section('title', 'Product')

@section('content')

<div class="container my-5 pb-4 border-bottom product-container">
    <div class="row justify-content-center align-items-start g-5">
        <div class="col-md-6">
            <div class="product-gallery-slider" style="opacity:0">
            <ul id="lightSlider"> 
                <li data-thumb="https://placeholder.com/1000x1000"> 
                    <img src="https://placeholder.com/1000x1000" alt=""> 
                </li> 
                <li data-thumb="https://placeholder.com/1000x1000"> 
                    <img src="https://placeholder.com/1000x1000" alt=""> 
                </li> 
                <li data-thumb="https://placeholder.com/1000x1000"> 
                    <img src="https://placeholder.com/1000x1000" alt=""> 
                </li>
                <li data-thumb="https://placeholder.com/1000x1000"> 
                    <img src="https://placeholder.com/1000x1000" alt=""> 
                </li>
                <li data-thumb="https://placeholder.com/1000x1000"> 
                    <img src="https://placeholder.com/1000x1000" alt=""> 
                </li>
                <li data-thumb="https://placeholder.com/1000x1000"> 
                    <img src="https://placeholder.com/1000x1000" alt=""> 
                </li>
                <li data-thumb="https://placeholder.com/1000x1000"> 
                    <img src="https://placeholder.com/1000x1000" alt=""> 
                </li>
                <li data-thumb="https://placeholder.com/1000x1000"> 
                    <img src="https://placeholder.com/1000x1000" alt=""> 
                </li>
                <li data-thumb="https://placeholder.com/1000x1000"> 
                    <img src="https://placeholder.com/1000x1000" alt=""> 
                </li> 
            </ul></div>
        </div>
        <div class="col-md-6 product-meta">
            <h1>
                Product Name
            </h1>
            <div class="product-desription">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce vitae tellus quis urna fringilla volutpat. Sed vitae semper nisl. Sed euismod, nunc vel tincidunt lacinia, nisl nunc aliquet nunc, vitae aliquet nisl nisl sit amet nisl. Sed euismod, nunc vel tincidunt lacinia, nisl nunc aliquet nunc, vitae aliquet nisl nisl sit amet nisl.</p>
            </div>
            <h2>
                100.00<span class="price-currency-symbol ms-2">€</span>
            </h2>
            <div class="input-group mb-3">
                <label class="input-group-text" for="inputGroupSelect01">Size</label>
                <select class="form-select" id="inputGroupSelect01">
                  <option value="1">S</option>
                  <option value="2">M</option>
                  <option value="3">L</option>
                </select>
              </div>
            <div class="d-grid gap-2">
                <button type="button" name="cartadd" id="cartAddBtn" class="btn btn-primary">
                    Add to Cart
                </button>
            </div>
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