@extends('layouts.layout')

@section('content')



<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3 mt-5">
            <h4>User profiles</h4>
            <hr>
            @foreach($infos as $info)
            <div class="card p-2 bg-light border-0 mb-3" style="">
                <div class="row no-gutters">
                    <div class="col-md-2">
                        <img src="{{ asset('img/profile-user.svg')}}" style="width:60px" class="" alt="...">
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
