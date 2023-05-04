@extends('layouts.main')

@section('title', 'Orders')

@section('content')

@include('layouts.adminnav')

<section class="container mt-3">
    <div class="row justify-content-start align-items-center">
        <div class="col-md-3">
            <h1 class="text-left">Orders</h1>
        </div>
    </div>
    @if(@count($orders) == 0)
        <div class="alert alert-danger mt-5" role="alert">
            No orders found.
        </div>
    @else
    <table class="table mt-3 table-striped">
        <thead>
            <tr class="table-dark">
                <th scope="col">Order number</th>
                <th scope="col">Date</th>
                <th scope="col">Price</th>
                <th scope="col">Status</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>


            @foreach($orders as $order)
            <tr>
                <td><span>{{$order->id}}</span></td>
                <td>{{$order->created_at}}</td>
                <td>{{$order->price}}€</td>
                <td>{{$order->status}}</td>

                @can('admin', App\Models\User::class)
                <td>
                    <div class="container d-flex justify-content-end">
                        <select class="form-select m-2" id="categorySelect2" aria-label="Select order status">
                            <option disabled selected>Select status</option>
                            <option value="1">Shipped</option>
                            <option value="2">Cancelled</option>
                            <option value="3">Settled</option>
                        </select>
                        <form method="POST" action="/orders/{{$order->id}}">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger"><i class="fa-solid fa-xmark me-1"></i>Delete</button>
                        </form>
                    </div>
                </td>
                @else
                <td>{{$order->status}}</td>
                @endcan
            </tr>
            @endforeach

        </tbody>
    </table>
    @endif
</section>

@endsection
