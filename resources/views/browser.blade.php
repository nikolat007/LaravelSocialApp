@extends('layouts.layout')

@section('content')



<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3 mt-5">
            <h4>User profiles</h4>
            <hr>
            @foreach($infos as $info)
            <div class="card p-2 rounded-lg shadow-sm bg-white mb-3" style="">
                <div class="row no-gutters">
                    <div class="col-md-2">
                        @if($info->user->profile_pic != NULL)
                        <img src="" style="width:60px; height:60px; background-image:url('/storage/profile_pictures/{{ $info->user->profile_pic }}'); background-position:center; background-size:cover;" class="rounded-circle mx-auto d-block" alt="">
                        @else
                        <img src="" style="width:60px; height:60px; background-image:url('/storage/default_avatar/profile-user.svg'); background-position:center; background-size:cover;" class="rounded-circle mx-auto d-block" alt="">
                        @endif
                    </div>
                    <div class="col-md-10">
                        <div class="card-body p-0">
                        <h5 class="card-title"><a href="/profile/{{ $info->user->username }}">{{ $info->user->first_name }} {{ $info->user->last_name }}</a></h5>
                            <h5 class="card-text"><small class="text-muted">{{ $info->city }}</small></h5>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

@endsection
