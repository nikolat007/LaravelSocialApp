@extends('layouts.layout')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3 border rounded mt-5 p-5">

            <h2 class="text-center mt-5 mb-5">Setup your profile</h2>

            @if(count($errors) > 0)
            <ul>
                @foreach($errors->all() as $error)
                <li class="text-danger"> {{ $error }} </li>
                @endforeach
            </ul>
            @endif

            <form class="" action=" {{ route('setupInfo') }} " method="post">
                <div class="form-group">
                    <label for="exampleInputWork">
                        <h5><span class="badge badge-secondary">Work</span></h5>
                    </label>
                    <input type="text" class="form-control" id="exampleInputWork" aria-describedby="workHelp"
                        placeholder="Add a workplace" value="@if($info->work){{$info->work}}@endif" name="work">
                </div>
                <div class="form-group">
                    <label for="exampleInputEducation">
                        <h5><span class="badge badge-secondary">Education</span></h5>
                    </label>
                    <input type="text" class="form-control" id="exampleInputEducation" aria-describedby="EducationHelp"
                        placeholder="Add a school" value="@if($info->education){{$info->education}}@endif"
                        name="education">
                </div>
                <div class="form-group">
                    <label for="exampleInputCurrentCity">
                        <h5><span class="badge badge-secondary">Current City</span></h5>
                    </label>
                    <input type="text" class="form-control" id="exampleInputCurrentCity"
                        aria-describedby="CurrentCityHelp" placeholder="Where are you from?"
                        value="@if($info->city){{$info->city}}@endif" name="currentcity">
                </div>
                <div class="form-group">
                    <label for="exampleInputRelationship">
                        <h5><span class="badge badge-secondary">Relationship status</span></h5>
                    </label>
                    <select class="form-control" name="relationship_status">
                        <option value="Single">Single</option>
                        <option value="In relationship">In relationship</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-success btn-block mb-5 mt-5">Update profile</button>
                <input type="hidden" name="_token" value=" {{ Session::token() }} ">
            </form>
        </div>
    </div>
</div>


@endsection
