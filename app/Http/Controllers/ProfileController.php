<?php

namespace App\Http\Controllers;

use App\User;
use App\Info;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function profile($username){

        $user = User::where('username', $username)->first();
        $info = Info::where('username', $username)->first();
        $posts = Post::where('user_id', $user->id)->latest()->get();

        return view('profile', ['user' => $user, 'info' => $info, 'posts' => $posts]);
    }

    public function setup(){

        $info = Info::where('username', Auth::user()->username)->first();

        return view('setup', ['info' => $info]);
    }

    public function setupInfo(Request $request){

        $this->validate($request, [
            'work' => 'max:60',
            'education' => 'max:60',
            'currentcity' => 'max:30'
        ]);


        $info = Info::where('username', Auth::user()->username)->first();

        $info->work = $request['work'];
        $info->education = $request['education'];
        $info->city = $request['currentcity'];
        $info->relationship = $request['relationship_status'];

        $info->update();

        return redirect()->route('profile', $info->username)->with(['message' => 'Your profile is successfully updated!']);

        
    }

    public function profileBrowser(){

        $infos = Info::latest()->get();


        return view('browser')->with(['infos' => $infos]);
    }
}
