@extends('layouts.main')

@section('title', 'Products')

@section('content')

@include('layouts.adminnav')

<section class="container mt-3">
    <div class="row justify-content-between align-items-center">
        <div class="col-md-5">
            <h1 class="text-left">Dashboard - products</h1>
        </div>
        <div class="col-md-3">
            <a href="/dashboard/products/create" class="btn btn-success w-100"><i class="fa-solid fa-plus me-1"></i>Add product</a>
        </div>
    </div>
    <table class="table mt-3 table-striped">
        <thead>
            <tr class="table-dark">
                <th scope="col">Product name</th>
                <th scope="col">Price</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @if(count($products) > 0)
            @foreach($products as $product)
            <tr>
                <td>{{$product->name}}</td>
                <td>{{$product->price}}</td>
                <td>
                    <div class="container d-flex justify-content-end">
                        <a href="/product/{{$product->slug}}" class="btn btn-sm btn-primary"><i class="fa-solid fa-shirt me-1"></i>View</a>
                        <a href="/dashboard/products/{{$product->slug}}/edit" class="btn btn-sm btn-warning mx-2"><i class="fa-solid fa-pen-to-square me-1"></i>Edit</a>
                        <form method="POST" action="/dashboard/products/{{$product->slug}}">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger"><i class="fa-solid fa-xmark me-1"></i>Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
</section>

<div class="container">
    {{$products->withQueryString()->links()}}
</div>

@endsection
