@extends('layouts.layout')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-7 p-5 ">
            @if(Session::has('message'))
                <div class="alert alert-success" role="alert">
                    {{ Session::get('message') }}
                </div>
            @endif
            <h3 class=""> {{ $user->first_name }}'s timeline </h3>
            <hr>
            @foreach($posts as $post)
            <div class="card mb-3 bg-light rounded">
                <div class="card-body">
                    <h5 class="card-title"><a class="badge badge-primary"
                            href="/profile/{{ $post->user->username }}">{{ $post->user->first_name }}
                            {{ $post->user->last_name }}</a></h5>

                    <p class="card-text">{{ $post->body }}</p>
                    <p class="card-text text-secondary"><i>Posted at {{ $post->created_at }}</i></p>
                    @if(Auth::user() == $post->user)
                    <a href="{{ route('deletePost', ['post_id' => $post->id]) }}"
                        class="card-link btn btn-outline-danger">Delete</a>
                    <!--<a href="#" class="card-link">Another link</a>-->
                    @endif
                </div>
            </div>
            @endforeach
        </div>

        <div class="col-md-5 mt-2 p-5">
            <img src="{{ asset('img/profile-user.svg')}}" style="width:100px"
                class="rounded mx-auto d-block mt-3 mb-3" alt="...">
            <h2 class="text-center mb-5">{{ $user->first_name }} {{ $user->last_name }}</h2>

            <p class="border p-2"><b>Email:</b> {{ $user->email }}</p>
            <p class="border p-2"><b>Work:</b> {{ $info->work }}</p>
            <p class="border p-2"><b>Education:</b> {{ $info->education }}</p>
            <p class="border p-2"><b>City:</b> {{ $info->city }}</p>
            <p class="border p-2"><b>Relationship:</b> {{ $info->relationship }}</p>

            @if($user->id == Auth::user()->id)
            <a class="btn btn-success btn-block" href=" {{ route('setup') }} ">Update Profile</a>
            @endif
        </div>

    </div>

</div>


@endsection
