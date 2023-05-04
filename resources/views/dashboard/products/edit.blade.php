@extends('layouts.main')

@section('title', 'Edit product')

@section('content')

@include('layouts.adminnav')


<section class="container mb-5">
    <div class="row d-flex justify-content-center">
      <h1 class="mt-5 mb-4 text-center">Edit product</h1>

      @error('image')
      <div class="alert alert-danger">{{ $message }}</div>
      @enderror


      <div class="col-lg-6 box-wrap mb-5">
        <h3 class="mt-2 mb-3">Add images</h3>
        <div class="row mt-3">
            <div class="col-md-3 mt-2">
                <form action="{{ route('products.storeImageDB',$product) }}" method="POST" enctype="multipart/form-data">
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
                        <button type="submit" class="btn btn-primary mt-2 upload-btn"><i class="fa-solid fa-upload"></i> Upload</button>
                    </div>
                </form>
            </div>
            @if(count($images) > 0)
                @foreach($images as $image)
                    <div class="col-md-3 mt-2">
                        <div class="image-container-uploaded">
                            <img src="{{asset('img/upload')}}/{{ $image->name }}" class="img-fluid" alt="">
                        </div>
                        <form action="{{ route('products.destroyImageDB', $image) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <input type="hidden" name="image" value="{{ $image->id }}">
                            <button type="submit" class="btn btn-danger w-100 mt-2"><i class="fa-solid fa-trash"></i> Delete</button>
                        </form>
                    </div>
                @endforeach
            @endif
        </div>
      </div>

      <div class="col-lg-6">
        <form method="POST" action="{{ route('products.update',$product) }}">
            @csrf
            @method('PUT')
          <div class="form-floating mb-3">
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="nameInput" placeholder="T-shirt" name="name" value="{{$product->name}}">
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
                    <option value="{{$gender->id}}" @selected($product->getAttributeValueByName('gender')->value == $gender->value)>{{$gender->value}}</option>
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
                    <option value="{{$cat->id}}" @selected($product->getAttributeValueByName('category')->value == $gender->value)>{{$cat->value}}</option>
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
                    <option value="{{$color->id}}" @selected($product->getAttributeValueByName('color')->value == $gender->value)>{{$color->value}}</option>
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
                    <option value="{{$size->id}}" {{ ($product->getAttributeValueByName('size', false)->contains($size->value)) ? 'selected':'' }}>{{$size->value}}</option>
                @endforeach
            </select>

            @error('size')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
          </div>
          <div class="form-floating mb-3">
            <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slugInput" placeholder="black-t-shirt" name="slug" value="{{$product->slug}}">
            <label for="slugInput">Slug</label>

            @error('slug')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
          </div>
          <div class="form-floating mb-3">
            <textarea class="form-control @error('description') is-invalid @enderror" placeholder="Description" id="descTextarea2" style="height: 100px" name="description">{{$product->description}}</textarea>
            <label for="descTextarea2">Description</label>

            @error('description')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
          </div>
          <div class="form-floating mb-3">
            <input type="number" class="form-control @error('price') is-invalid @enderror" id="priceInput" placeholder="29.99" step="0.01" name="price" value="{{{$product->price}}}">
            <label for="priceInput">Price (EUR)</label>

            @error('price')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
          </div>
          <div class="row justify-content-between">
            <div class="col-md-4 pb-2">
              <button type="submit" class="btn btn-success w-100"><i class="fa-solid fa-floppy-disk"></i> Save</button>
            </div>
            <div class="col-md-auto pb-2">
              <a href="/dashboard/products" class="btn btn-outline-danger w-100"><i class="fa-solid fa-trash"></i> Discard and go back</a>
            </div>
          </div>
        </form>
      </div>
    </div>
</section>

@endsection
