@extends('layouts.main')

@section('title', 'Products')

@section('content')

@include('layouts.adminnav')


<section class="container mb-5">
    <div class="row d-flex justify-content-center">
      <h1 class="mt-5 mb-4 text-center">Add product</h1>

      @error('image')
      <div class="alert alert-danger">{{ $message }}</div>
      @enderror

      <div class="col-lg-6 box-wrap mb-5">
        <h3 class="mt-2 mb-3">Add image</h3>
        <form action="/products/create-image" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="d-flex align-items-center justify-content-center">
                        <label for="img-input">
                            <div class="image-container-preview">
                                <img src="https://placehold.co/1000x1000?text=Upload%20Image" id="img-preview" class="img-fluid" alt="">
                            </div>
                        </label>
                        <input id="img-input" type="file" class="d-none" name="image">
                    </div>
                    <div class="d-flex align-items-center justify-content-center">
                        <button type="submit" class="btn btn-primary mt-2 upload-btn">Upload</button>
                    </div>
                </div>
            </div>
        </form>
        <div class="row mt-3">
            @if(Session::has('images'))
            @foreach(Session::get('images') as $image)
                <div class="col-md-3 mt-2">
                    <div class="image-container-uploaded">
                        <img src="{{asset('img/upload')}}/{{ $image }}" class="img-fluid" alt="">
                    </div>
                    <form action="/products/destroy-image" method="POST">
                        @method('DELETE')
                        @csrf
                        <input type="hidden" name="image" value="{{ $image }}">
                        <button type="submit" class="btn btn-danger w-100 mt-3">Delete</button>
                    </form>
                </div>
            @endforeach
            @endif
        </div>
      </div>

      <div class="col-lg-6">
        <form method="POST" action="/products">
            @csrf
          <div class="form-floating mb-3">
            <input type="text" class="form-control" id="nameInput" placeholder="T-shirt" name="name">
            <label for="nameInput">Name</label>
          </div>
          <div class="input-group mb-3">
            <label class="input-group-text" for="inputGroupSelect03">Gender</label>
            <select class="form-select" id="inputGroupSelect03" name="gender">
                <option disabled>Select...</option>
                @foreach ($genders as $gender)
                    <option value="{{$gender->id}}" @selected(old('gender') == $gender->value)>{{$gender->value}}</option>
                @endforeach
            </select>
          </div>
          <div class="input-group mb-3">
            <label class="input-group-text" for="inputGroupSelect04">Category</label>
            <select class="form-select" id="inputGroupSelect04" name="category">
                <option disabled>Select...</option>
                @foreach ($categories as $cat)
                    <option value="{{$cat->id}}" @selected(old('category') == $cat->value)>{{$cat->value}}</option>
                @endforeach
            </select>
           </div>
          <div class="input-group mb-3">
            <label class="input-group-text" for="inputGroupSelect02">Color</label>
            <select class="form-select" id="inputGroupSelect02" name="color">
                <option disabled>Select...</option>
                @foreach ($colors as $color)
                    <option value="{{$color->id}}" @selected(old('color') == $color->value)>{{$color->value}}</option>
                @endforeach
            </select>
          </div>
          <div class="input-group mb-3">
            <label class="input-group-text" for="inputGroupSelect01">Size</label>
            <select class="form-select" id="inputGroupSelect01" name="size[]" multiple>
                @foreach ($sizes as $size)
                    <option value="{{$size->id}}" @selected(old('size') == $size->value)>{{$size->value}}</option>
                @endforeach
            </select>
          </div>
          <div class="form-floating mb-3">
            <input type="text" class="form-control" id="slugInput" placeholder="black-t-shirt" name="slug">
            <label for="slugInput">Slug</label>
          </div>
          <div class="form-floating mb-3">
            <textarea class="form-control" placeholder="Description" id="descTextarea2" style="height: 100px" name="description"></textarea>
            <label for="descTextarea2">Description</label>
          </div>
          <div class="form-floating mb-3">
            <input type="number" class="form-control" id="priceInput" placeholder="29.99" step="0.01" name="price">
            <label for="priceInput">Price (EUR)</label>
          </div>
          <div class="row justify-content-between">
            <div class="col-md-4 pb-2">
              <button type="submit" class="btn btn-primary w-100">Save</button>
            </div>
            <div class="col-md-auto pb-2">
              <a href="/dashboard" class="btn btn-outline-primary w-100">Discard and go back</a>
            </div>
          </div>
        </form>
      </div>
    </div>
</section>

@endsection
