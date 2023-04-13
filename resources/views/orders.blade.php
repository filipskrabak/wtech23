@extends('layouts.main')

@section('title', 'Orders')

@section('content')

<section class="container mt-3">
    <div class="row justify-content-start align-items-center">
        <div class="col-md-3">
            <h1 class="text-left">Orders</h1>
        </div>
    </div>
    <table class="table mt-3 table-striped">
        <thead>
            <tr class="table-dark">
                <th scope="col">Order number</th>
                <th scope="col">Date</th>
                <th scope="col">Price</th>
                <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody>
            @if(count($orders) > 0)
                
            @foreach($orders as $order)
            <tr>
                <td>{{$order->id}}</td>
                <td>{{$order->created_at}}</td>
                <td>{{$order->price}}€</td>
                <td>{{$order->status}}</td>
            </tr>
            @endforeach
            @endif
    
        </tbody>
    </table>
</section>

@endsection