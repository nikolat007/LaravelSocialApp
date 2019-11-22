<?php

namespace App\Http\Controllers;

use App\User;
use App\Info;
use App\Post;
use Storage;
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
            'currentcity' => 'max:30',
            'profile_picture' => 'file|image|nullable|max:15000'
        ]);

        $user = User::where('id', Auth::user()->id)->first();

        if($request->hasFile('profile_picture')){
            $filenameWithExt = $request->file('profile_picture')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('profile_picture')->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $path = $request->file('profile_picture')->storeAs('public/profile_pictures', $fileNameToStore); 
            if($user->profile_pic != NULL){
                Storage::delete('/public/profile_pictures/' . $user->profile_pic);
            }
        }
        else{
            $fileNameToStore = $user->profile_pic;
        }

        $info = Info::where('username', Auth::user()->username)->first();

        $info->work = $request['work'];
        $info->education = $request['education'];
        $info->city = $request['currentcity'];
        $info->relationship = $request['relationship_status'];
        $info->update();

        $user->profile_pic = $fileNameToStore;
        $user->update();

        return redirect()->route('profile', $info->username)->with(['message' => 'Your profile is successfully updated!']);

        
    }

    public function profileBrowser(){

        $infos = Info::latest()->get();


        return view('browser')->with(['infos' => $infos]);
    }

    public function postFollowUnfollow(Request $request){

        if($request->follow){
            $user = User::findOrFail($request->user);
            Auth::user()->following()->attach($user->id);
        }
        if($request->unfollow){
            $user = User::findOrFail($request->user);
            Auth::user()->following()->detach($user->id);
        }

        return redirect()->back();

    }
}
