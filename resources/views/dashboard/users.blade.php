@extends('layouts.main')

@section('title', 'Users')

@section('content')

@include('layouts.adminnav')

<section class="container mt-3">
    <div class="row justify-content-between align-items-center">
        <div class="col-md-5">
            <h1 class="text-left">Dashboard - users</h1>
        </div>
    </div>
    <table class="table mt-3 table-striped">
        <thead>
            <tr class="table-dark">
                <th scope="col">Name</th>
                <th scope="col">Surname</th>
                <th scope="col">Email</th>
                <th scope="col">Role</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @if(count($users) > 0)
            @foreach($users as $user)
            <tr>
                <td>{{$user->name}}</td>
                <td>{{$user->surname}}</td>
                <td>{{$user->email}}</td>
                <td>@if($user->role) Admin @else User @endif</td>
                <td>
                    @if(Auth::user()->id != $user->id)
                    <div class="container d-flex justify-content-end">
                        @if($user->role)
                        <form method="POST" action="/users/{{$user->id}}/role">
                            @csrf
                            @method('PUT')
                            <button class="btn btn-sm btn-warning mx-2"><i class="fa-solid fa-user-minus me-1"></i>Admin</button>
                        </form>
                        @else
                        <form method="POST" action="/users/{{$user->id}}/role">
                            @csrf
                            @method('PUT')
                            <button class="btn btn-sm btn-success mx-2"><i class="fa-solid fa-user-plus me-1"></i>Admin</button>
                        </form>
                        @endif
                        <form method="POST" action="/users/{{$user->id}}">
                            @csrf
                            @method('DELETE')
                        <button class="btn btn-sm btn-danger"><i class="fa-solid fa-xmark me-1"></i>Delete</button>
                        </form>
                    </div>
                    @endif
                </td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
</section>

@endsection
