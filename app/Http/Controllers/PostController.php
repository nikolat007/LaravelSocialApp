<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }


    public function home(){


        $following = Auth::user()->following->pluck('id');
        
        $posts = Post::whereIn('user_id', $following)->orWhere('user_id', Auth::user()->id)->latest()->get();

        return view('home', ['posts' => $posts]);
    }


    public function createPost(Request $request){
        
        $this->validate($request, [
            'post_field' => 'required|max:400',
            'post_image' => 'file|image|mimes:jpeg,png,jpg,gif,svg|nullable|max:15000'
        ]);

        if($request->hasFile('post_image')){
            $filenameWithExt = $request->file('post_image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('post_image')->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $path = $request->file('post_image')->storeAs('public/post_images', $fileNameToStore); 
        }
        else{
            $fileNameToStore = NULL;
        }
        


        $post = new Post();
        $post->body = $request['post_field'];
        $post->post_image = $fileNameToStore;
        $message = `Error: can't create post`;
        if($request->user()->posts()->save($post)){
            $message = 'Post successfully created!';
        }
        return redirect()->route('home')->with(['message' => $message]);
    }

    public function editPost(Request $request, $post_id){
        $this->validate($request, [
            'post_update_field' => 'required|max:400'
        ]);
        
        $post = Post::where('id', $post_id)->first();
        if(Auth::user() != $post->user){
            return redirect()->back();    
        }
        $post->body = $request['post_update_field'];
        $post->update();
        return redirect()->back()->with(['message' => 'Post successfully updated!']);
        
    }

    public function deletePost($post_id){
        $post = Post::where('id', $post_id)->first();
        if(Auth::user() != $post->user){
            return redirect()->back();    
        }
        Storage::delete('/public/post_images/' . $post->post_image);
        $post->delete();
        return redirect()->back()->with(['message' => 'Post successfully deleted!']);
    }
}
