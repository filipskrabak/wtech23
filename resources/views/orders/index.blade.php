@extends('layouts.main')

@section('title', 'Orders')


@section('content')

@include('layouts.adminnav')

<section class="container mt-3">
    <div class="row justify-content-start align-items-center">
        <div class="col-md-5">
            @can('admin', App\Models\User::class)
            <h1 class="text-left">Dashboard - orders</h1>
            @else
            <h1 class="text-left">Orders</h1>
            @endcan
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
                @can('admin', App\Models\User::class)
                <th scope="col"></th>
                <th scope="col"></th>
                @else
                <th scope="col"></th>
                @endcan
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
                    <form method="POST" action="{{ route('dashboard.orders.update',$order) }}">
                        @csrf
                        @method('PUT')

                        <div class="input-group input-group-sm">
                        <select class="form-select form-select-sm" id="categorySelect2" aria-label="Select order status" name="status">
                            <option disabled selected>Select status</option>
                            <option value="shipped">Shipped</option>
                            <option value="cancelled">Cancelled</option>
                            <option value="settled">Settled</option>
                        </select>
                        <button class="btn btn-outline-primary"><i class="fa-solid fa-arrow-right" type="submit"></i> Change</button>
                        </div>
                    </form>
                </td>
                <td>
                    <div class="container d-flex justify-content-end">
                        <a href="/orders/{{$order->id}}" class="btn btn-sm btn-primary me-2"><i class="fa-solid fa-shirt me-1"></i>View</a>
                        <form method="POST" action="{{ route('dashboard.orders.destroy',$order) }}">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger"><i class="fa-solid fa-xmark me-1" type="submit"></i> Delete</button>
                        </form>
                    </div>
                </td>
                @else
                <td>
                    <div class="container d-flex justify-content-end">
                        <a href="/orders/{{$order->id}}" class="btn btn-sm btn-primary"><i class="fa-solid fa-shirt me-1"></i>View</a>
                    </div>
                </td>
                @endcan
            </tr>
            @endforeach

        </tbody>
    </table>
    @endif
</section>

<div class="container">
    {{$orders->withQueryString()->links()}}
</div>

@endsection
