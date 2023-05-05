@extends('layouts.main')

@section('title', 'Products')

@section('content')

@include('layouts.adminnav')

<section class="container mt-3">
    <div class="row justify-content-between align-items-center">
        <div class="col-md-5">
            <h1 class="text-left">Dashboard - attribute values</h1>
        </div>
        <div class="col-md-3">
            <a href="/dashboard/attribute-values/create" class="btn btn-success w-100"><i class="fa-solid fa-plus me-1"></i>Add attribute value</a>
        </div>
    </div>
    <table class="table mt-3 table-striped">
        <thead>
            <tr class="table-dark">
                <th scope="col">Attribute value name</th>
                <th scope="col">Attribute</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @if(count($attributes) > 0)
            @foreach($attributes as $attribute)
            <tr>
                <td>{{$attribute->value}}</td>
                <td>{{$attribute->attribute->name}}</td>
                <td>
                    <div class="container d-flex justify-content-end">
                        <a href="/dashboard/attribute-values/{{$attribute->id}}/edit" class="btn btn-sm btn-warning mx-2"><i class="fa-solid fa-pen-to-square me-1"></i>Edit</a>
                        <form method="POST" action="/dashboard/attribute-values/{{$attribute->id}}">
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
    {{$attributes->withQueryString()->links()}}
</div>

@endsection
