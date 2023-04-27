@extends('layouts.main')

@section('title', 'Products')

@section('content')

@include('layouts.adminnav')


<section class="container mb-5">
    <div class="row d-flex justify-content-center">
      <h1 class="mt-5 mb-4 text-center">Add product</h1>

      <div class="col-lg-6 box-wrap mb-5">
        <h3 class="mt-2 mb-3">Add image</h3>
        <div class="row align-items-center">
          <div class="col-md-3">
              <img src="https://placehold.co/1000x1000?text=Upload%20Image" class="w-100" alt="">
          </div>
          <div class="col-md-9">
            <div class="form-floating mb-3 mt-3 mt-md-0">
              <input type="text" class="form-control" id="floatingInput" placeholder="Alt text">
              <label for="floatingInput">Image description</label>
            </div>
            <div class="row">
              <div class="col-md-4">
                <button type="submit" class="btn btn-primary w-100">Upload</button>
              </div>
            </div>
          </div>
        </div>
        <div class="row mt-3">
          <div class="col-md-3 mt-2">
            <img src="https://placeholder.com/1000x1000" class="w-100" alt="">
          </div>
          <div class="col-md-3 mt-2">
            <img src="https://placeholder.com/1000x1000" class="w-100" alt="">
          </div>
          <div class="col-md-3 mt-2">
            <img src="https://placeholder.com/1000x1000" class="w-100" alt="">
          </div>
          <div class="col-md-3 mt-2">
            <img src="https://placeholder.com/1000x1000" class="w-100" alt="">
          </div>
          <div class="col-md-3 mt-2">
            <img src="https://placeholder.com/1000x1000" class="w-100" alt="">
          </div>
          <div class="col-md-3 mt-2">
            <img src="https://placeholder.com/1000x1000" class="w-100" alt="">
          </div>
          <div class="col-md-3 mt-2">
            <img src="https://placeholder.com/1000x1000" class="w-100" alt="">
          </div>
        </div>
      </div>

      <div class="col-lg-6">
        <form>
          <div class="form-floating mb-3">
            <input type="text" class="form-control" id="nameInput" placeholder="T-shirt">
            <label for="nameInput">Name</label>
          </div>
          <div class="form-floating mb-3">
            <select class="form-select" id="categorySelect" aria-label="Select a category">
              <option selected>Select a category...</option>
              <option value="1">Jeans</option>
              <option value="2">Jackets</option>
              <option value="3">T-shirts</option>
            </select>
            <label for="categorySelect">Clothing category</label>
          </div>
          <div class="form-floating mb-3">
            <select class="form-select" id="colorSelect" aria-label="Select a color">
              <option selected>Select a color...</option>
              <option value="1">Blue</option>
              <option value="2">Red</option>
              <option value="3">Black</option>
            </select>
            <label for="colorSelect">Color</label>
          </div>
          <div class="form-floating mb-3">
            <select class="form-select" id="sizeSelect" aria-label="Select a size">
              <option selected>Select a size...</option>
              <option value="1">S</option>
              <option value="2">M</option>
              <option value="3">L</option>
            </select>
            <label for="sizeSelect">Size</label>
          </div>
          <div class="form-floating mb-3">
            <input type="text" class="form-control" id="slugInput" placeholder="black-t-shirt">
            <label for="slugInput">Slug</label>
          </div>
          <div class="form-floating mb-3">
            <textarea class="form-control" placeholder="Description" id="descTextarea2" style="height: 100px"></textarea>
            <label for="descTextarea2">Description</label>
          </div>
          <div class="form-floating mb-3">
            <input type="number" class="form-control" id="priceInput" placeholder="29.99">
            <label for="priceInput">Price (EUR)</label>
          </div>
          <div class="row justify-content-between">
            <div class="col-md-4 pb-2">
              <button type="submit" class="btn btn-primary w-100">Save</button>
            </div>
            <div class="col-md-auto pb-2">
              <button class="btn btn-outline-primary w-100">Discard and go back</button>
            </div>
          </div>
        </form>
      </div>
    </div>
</section>

@endsection
