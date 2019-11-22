@extends('layouts.layout')

@section('content')



<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3 mt-5">
            
            @include('includes.message')
            
            <div class="border p-3 rounded-lg shadow-sm bg-white">
            <h3><span class="badge badge-primary">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</span></h3>
            <form action=" {{ route('createPost') }} " method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <textarea style="resize:none;" class="form-control" id="exampleFormControlTextarea1" rows="3" name="post_field" maxlength='400' placeholder="What's on your mind?"></textarea>
                </div>
                @if(count($errors) > 0)
                <ul>
                    @foreach($errors->all() as $error)
                    <li class="text-danger"> {{ $error }} </li>
                    @endforeach
                </ul>
                @endif
                <input type="file" name="post_image" class="" accept="image/*">
                <br>
                <button type="submit" class="btn btn-primary mt-3">Post</button>
                <input type="hidden" name="_token" value=" {{ Session::token() }} ">
            </form>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-6 offset-md-3">
            
            @include('includes.post')

        </div>
    </div>
</div>

@endsection
