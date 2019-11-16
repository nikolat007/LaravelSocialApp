@extends('layouts.layout')

@section('content')



<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3 mt-5">
            @if(Session::has('message'))
                <div class="alert alert-success" role="alert">
                    {{ Session::get('message') }}
                </div>
            @endif
            <h3><span class="badge badge-primary">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</span></h3>
            <form action=" {{ route('createPost') }} " method="post" >
                <div class="form-group">
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="post_field" maxlength='400' placeholder="What's on your mind?"></textarea>
                </div>
                @if(count($errors) > 0)
                <ul>
                    @foreach($errors->all() as $error)
                    <li class="text-danger"> {{ $error }} </li>
                    @endforeach
                </ul>
                @endif
                <button type="submit" class="btn btn-primary">Post</button>
                <input type="hidden" name="_token" value=" {{ Session::token() }} ">
            </form>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-6 offset-md-3">
            @foreach($posts as $post)
            <div class="card mb-3 bg-light rounded">
                <div class="card-body">
                <h5 class="card-title"><a class="badge badge-primary" href="/profile/{{ $post->user->username }}">{{ $post->user->first_name }}  {{ $post->user->last_name }}</a></h5>
                    
                    <p class="card-text">{{ $post->body }}</p>
                    <p class="card-text text-secondary"><i>Posted at {{ $post->created_at }}</i></p>
                    @if(Auth::user() == $post->user)
                    <a href="{{ route('deletePost', ['post_id' => $post->id]) }}" class="card-link btn btn-danger">Delete</a>
                    <!--<a href="#" class="card-link">Another link</a>-->
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

@endsection
