@foreach($posts as $post)
<div class="card mb-3 rounded-lg shadow-sm bg-white">
    <div class="row">
        <div class="col-md-1">
            @if($post->user->profile_pic != NULL)
                <img class="rounded-circle d-block mt-3 mb-3 ml-2" src="" style="width:50px; height:50px; background-image:url('/storage/profile_pictures/{{ $post->user->profile_pic }}'); background-position:center; background-size:cover;" alt="">
            @else
                <img class="rounded-circle d-block mt-3 mb-3 ml-2" src="/storage/default_avatar/profile-user.svg" style="width:50px; height:50px;" alt="...">
            @endif
            </div>
    <div class="col-md-11">
    <div class="card-body">
        <div class="d-flex bd-highlight mb-3">
        <h5 class="mr-auto pt-1 bd-highlight card-title"><a class="" href="/profile/{{ $post->user->username }}">{{ $post->user->first_name }}
                {{ $post->user->last_name }}</a></h5>
        @if(Auth::user()->id == $post->user->id)
        <div class="btn-group ml-auto bd-highlight" role="group">
            <button id="btnGroupDrop1" type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false" style="font-size: 15px;"></button>
            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                <a class="dropdown-item" data-toggle="collapse" href="#collapsePost{{$post->id}}" role="button"
                aria-expanded="false" aria-controls="collapseExample">Edit</a>
                <a href="{{ route('deletePost', ['post_id' => $post->id]) }}" class="dropdown-item">Delete</a>
            </div>
        </div>
        @endif
        </div>

        <p class="card-text">{{ $post->body }}</p>
        @if($post->post_image != NULL)
        <img class="rounded-lg"  style="width:100%" src="/storage/post_images/{{ $post->post_image }}" alt="">
        <br>
        <br>
        @endif
        <p class="card-text text-secondary"><i>{{ $post->created_at->diffForHumans() }}</i></p>

        @if(Auth::user()->id == $post->user->id)
        
        <!--<a href="#" class="card-link">Another link</a>-->
        <!--<a class="btn btn-success" data-toggle="collapse" href="#collapsePost{{$post->id}}" role="button"
            aria-expanded="false" aria-controls="collapseExample">Edit</a>-->
        <div class="collapse mt-3" id="collapsePost{{$post->id}}">
            <form action="{{ route('editPost', ['post_id' => $post->id]) }}" method="get">
                <div class="form-group">
                    <textarea style="resize:none;" class="form-control" id="exampleFormControlTextarea1" rows="3"
                        name="post_update_field" maxlength='400'>{{ $post->body }}</textarea>
                </div>
                <button type="submit" class="btn btn-success mb-3">Confirm</button>
                <input type="hidden" name="_token" value=" {{ Session::token() }} ">
            </form>
        </div>
        @endif
    </div>
    </div>
    </div>
</div>
@endforeach
