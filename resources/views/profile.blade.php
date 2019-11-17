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
            <div class="card mb-3 rounded-lg shadow-sm bg-white">
                <div class="card-body">
                    <h5 class="card-title"><a class="badge badge-primary"
                            href="/profile/{{ $post->user->username }}">{{ $post->user->first_name }}
                            {{ $post->user->last_name }}</a></h5>

                    <p class="card-text">{{ $post->body }}</p>
                    @if($post->post_image != 'noimage.jpg')
                    <img style="width:100%" src="/storage/post_images/{{ $post->post_image }}" alt="">
                    <br>
                    <br>
                    @endif
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

        <div class="col-md-5 mt-5">
            <div class="border p-5 rounded-lg shadow-sm bg-white">
            <img src="{{ asset('img/profile-user.svg')}}" style="width:100px" class="rounded mx-auto d-block mt-3 mb-3"
                alt="...">
            <h2 class="text-center mb-5">{{ $user->first_name }} {{ $user->last_name }}</h2>

            <p>
                <a class="btn btn-primary btn-block" data-toggle="collapse" href="#collapseExample" role="button"
                    aria-expanded="false" aria-controls="collapseExample">Toggle user info</a>
            </p>
            <div class="collapse" id="collapseExample">
                <div class="card card-body p-0 border-0">
                    <p class="border p-2 rounded-lg"><b>Email:</b> {{ $user->email }}</p>
                    @if($info->work != NULL)
                    <p class="border p-2 rounded-lg"><b>Work:</b> {{ $info->work }}</p>
                    @endif
                    @if($info->education != NULL)
                    <p class="border p-2 rounded-lg"><b>Education:</b> {{ $info->education }}</p>
                    @endif
                    @if($info->city != NULL)
                    <p class="border p-2 rounded-lg"><b>City:</b> {{ $info->city }}</p>
                    @endif
                    @if($info->relationship != NULL)
                    <p class="border p-2 rounded-lg"><b>Relationship:</b> {{ $info->relationship }}</p>
                    @endif
                </div>
            </div>

            <!--<p class="border p-2"><b>Email:</b> {{ $user->email }}</p>
            <p class="border p-2"><b>Work:</b> {{ $info->work }}</p>
            <p class="border p-2"><b>Education:</b> {{ $info->education }}</p>
            <p class="border p-2"><b>City:</b> {{ $info->city }}</p>
            <p class="border p-2"><b>Relationship:</b> {{ $info->relationship }}</p>-->

            @if($user->id == Auth::user()->id)
            <a class="btn btn-success btn-block" href=" {{ route('setup') }} ">Update Profile</a>
            @endif
        </div>
    </div>

</div>

</div>


@endsection
