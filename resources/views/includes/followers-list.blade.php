@foreach($user->getFollowers() as $followers)
<div class="card p-2 rounded-lg shadow-sm bg-white m-3" style="">
    <div class="row no-gutters">
            <div class="col-md-4">
                @if($followers->profile_pic != NULL)
                <img src="" style="width:60px; height:60px; background-image:url('/storage/profile_pictures/{{ $followers->profile_pic }}'); background-position:center; background-size:cover;" class="rounded-circle mx-auto d-block" alt="">
                @else
                <img src="" style="width:60px; height:60px; background-image:url('/storage/default_avatar/profile-user.svg'); background-position:center; background-size:cover;" class="rounded-circle mx-auto d-block" alt="">
                @endif
            </div>
            <div class="col-md-8">
                <div class="card-body p-0">
                <h5 class="card-title"><a href="/profile/{{ $followers->username }}">{{ $followers->first_name }} {{ $followers->last_name }}</a></h5>
                    <h5 class="card-text"><small class="text-muted">{{ $followers->username }}</small></h5>
                </div>
            </div>
    </div>
</div>
@endforeach