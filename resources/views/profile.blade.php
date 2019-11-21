@extends('layouts.layout')

@section('content')

<div class="container">
    <div class="row">

        <div class="col-md-4 offset-md-1 mt-5">
            <div class="border p-5 rounded-lg shadow-sm bg-white">
                    @if($user->profile_pic != NULL)
                    <img class="rounded-circle mx-auto d-block mt-3 mb-3 ml-2" src="" style="width:100px; height:100px; background-image:url('/storage/profile_pictures/{{ $user->profile_pic }}'); background-position:center; background-size:cover;" alt="">
                    @else
                    <img class="rounded-circle mx-auto d-block mt-3 mb-3 ml-2" src="/storage/default_avatar/profile-user.svg" style="width:100px; height:100px;" alt="...">
                    @endif
                
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

        <div class="col-md-6 pt-5 ">

            @include('includes.message')

            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                        aria-controls="home" aria-selected="true">Timeline</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                        aria-controls="profile" aria-selected="false">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab"
                        aria-controls="contact" aria-selected="false">Contact</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">@include('includes.post')</div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">...</div>
                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
            </div>
        </div>

    </div>

</div>


@endsection
