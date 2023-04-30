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
        <h3 class="mt-2 mb-3">Add images</h3>
        <div class="row mt-3">
            <div class="col-md-3 mt-2">
                <form action="/dashboard/products/create-image" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="d-flex align-items-start justify-content-start">
                        <label for="img-input">
                            <div class="image-container-preview">
                                <img src="https://placehold.co/1000x1000?text=Choose%20Image" id="img-preview" class="img-fluid" alt="">
                            </div>
                        </label>
                        <input id="img-input" type="file" class="d-none" name="image">
                    </div>
                    <div class="d-flex align-items-start justify-content-start">
                        <button type="submit" class="btn btn-primary mt-2 upload-btn">Upload</button>
                    </div>
                </form>
            </div>
            @if(Session::has('images'))
            @foreach(Session::get('images') as $image)
                <div class="col-md-3 mt-2">
                    <div class="image-container-uploaded">
                        <img src="{{asset('img/upload')}}/{{ $image }}" class="img-fluid" alt="">
                    </div>
                    <form action="/dashboard/products/destroy-image" method="POST">
                        @method('DELETE')
                        @csrf
                        <input type="hidden" name="image" value="{{ $image }}">
                        <button type="submit" class="btn btn-danger w-100 mt-2">Delete</button>
                    </form>
                </div>
            @endforeach
            @endif
        </div>
      </div>

      <div class="col-lg-6">
        <form method="POST" action="/dashboard/products">
            @csrf
          <div class="form-floating mb-3">
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="nameInput" placeholder="T-shirt" name="name" value="{{old('name')}}">
            <label for="nameInput">Name</label>

            @error('name')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
          </div>
          <div class="input-group mb-3">
            <label class="input-group-text" for="inputGroupSelect03">Gender</label>
            <select class="form-select @error('gender') is-invalid @enderror" id="inputGroupSelect03" name="gender">
                <option disabled>Select...</option>
                @foreach ($genders as $gender)
                    <option value="{{$gender->id}}" @selected(old('gender') == $gender->value)>{{$gender->value}}</option>
                @endforeach
            </select>

            @error('gender')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
          </div>
          <div class="input-group mb-3">
            <label class="input-group-text" for="inputGroupSelect04">Category</label>
            <select class="form-select @error('category') is-invalid @enderror" id="inputGroupSelect04" name="category">
                <option disabled>Select...</option>
                @foreach ($categories as $cat)
                    <option value="{{$cat->id}}" @selected(old('category') == $cat->value)>{{$cat->value}}</option>
                @endforeach
            </select>

            @error('category')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
           </div>
          <div class="input-group mb-3">
            <label class="input-group-text" for="inputGroupSelect02">Color</label>
            <select class="form-select @error('color') is-invalid @enderror" id="inputGroupSelect02" name="color">
                <option disabled>Select...</option>
                @foreach ($colors as $color)
                    <option value="{{$color->id}}" @selected(old('color') == $color->value)>{{$color->value}}</option>
                @endforeach
            </select>

            @error('color')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
          </div>
          <div class="input-group mb-3">
            <label class="input-group-text" for="inputGroupSelect01">Size</label>
            <select class="form-select @error('size') is-invalid @enderror" id="inputGroupSelect01" name="size[]" multiple>
                @foreach ($sizes as $size)
                    <option value="{{$size->id}}" {{ (collect(old('size'))->contains($size->id)) ? 'selected':'' }}>{{$size->value}}</option>
                @endforeach
            </select>

            @error('size')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
          </div>
          <div class="form-floating mb-3">
            <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slugInput" placeholder="black-t-shirt" name="slug" value="{{old('slug')}}">
            <label for="slugInput">Slug</label>

            @error('slug')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
          </div>
          <div class="form-floating mb-3">
            <textarea class="form-control @error('description') is-invalid @enderror" placeholder="Description" id="descTextarea2" style="height: 100px" name="description">{{old('description')}}</textarea>
            <label for="descTextarea2">Description</label>

            @error('description')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
          </div>
          <div class="form-floating mb-3">
            <input type="number" class="form-control @error('price') is-invalid @enderror" id="priceInput" placeholder="29.99" step="0.01" name="price" value="{{old('price')}}">
            <label for="priceInput">Price (EUR)</label>

            @error('price')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
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