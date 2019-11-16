@extends('layouts.layout')

@section('content')


<div class="container">
    <div class="row mt-5"></div>
    <div class="col-md-6 offset-md-3">
        <form class="border p-5 rounded" action=" {{ route('signin') }} " method="post">
            <h2 class="mb-5 text-secondary">Welcome, please login</h2>

            @if(count($errors) > 0)
                <ul>
                    @foreach($errors->all() as $error)
                    <li class="text-danger"> {{ $error }} </li>
                    @endforeach
                </ul>
            @endif

            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                    placeholder="Enter email" name="email">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                    else.</small>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password"
                    name="password">
            </div>
            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Login</button>
            <a class="btn btn-outline-secondary mt-3 btn-block" href=" {{ url('/register') }} " role="button">Register</a>
            <input type="hidden" name="_token" value=" {{ Session::token() }} ">
        </form>
    </div>
</div>

@endsection
