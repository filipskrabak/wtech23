@extends('layouts.main')

@section('title', 'Create attribute value')

@section('content')

@include('layouts.adminnav')


<section class="container mb-5">
    <div class="row d-flex justify-content-center">
      <h1 class="mt-5 mb-4 text-center">Add attribute value</h1>
      <div class="col-lg-12">
        <form method="POST" action="/dashboard/attribute-values">
            @csrf
            <div class="input-group mb-3">
                <label class="input-group-text" for="inputGroupSelect02">Attribute</label>
                <select class="form-select @error('attribute') is-invalid @enderror" id="inputGroupSelect02" name="attribute">
                    <option disabled>Select...</option>
                    @foreach ($attributes as $attribute)
                        <option value="{{$attribute->id}}" @selected(old('attribute') == $attribute->name)>{{$attribute->name}}</option>
                    @endforeach
                </select>

                @error('attribute')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="form-floating mb-3">
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="nameInput" placeholder="T-shirt" name="name" value="{{old('name')}}">
            <label for="nameInput">Name</label>

                @error('name')
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
              <a href="/dashboard/attribute-values" class="btn btn-outline-danger w-100"><i class="fa-solid fa-trash"></i> Discard and go back</a>
            </div>
          </div>
        </form>
      </div>
    </div>
</section>

@endsection
