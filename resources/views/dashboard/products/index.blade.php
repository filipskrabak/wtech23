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
            <a href="/dashboard/products/create" class="btn btn-primary w-100">Add product</a>
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
                        <a href="/product/{{$product->slug}}" class="btn btn-sm btn-primary">View</a>
                        <a href="/dashboard/products/{{$product->slug}}/edit" class="btn btn-sm btn-primary mx-2">Edit</a>
                        <form method="POST" action="/dashboard/products/{{$product->slug}}">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-primary">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
</section>

@endsection
