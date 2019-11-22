<?php

namespace App\Http\Controllers;

use App\User;
use App\Info;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function postSignUp(Request $request){

        $this->validate($request, [
            'email' => 'required|email|unique:users',
            'username' => 'required|min:5|unique:users',
            'first_name' => 'required|min:3',
            'last_name' => 'required|min:3',
            'password' => 'required|min:4'

        ]);


        $email = $request['email'];
        $password = bcrypt($request['password']);
        $userName = $request['username'];
        $firstName = $request['first_name'];
        $lastName = $request['last_name'];

        $user = new User();
        $user->email = $email;
        $user->username = $userName;
        $user->password = $password;
        $user->first_name = $firstName;
        $user->last_name = $lastName;
        $user->save();


        Auth::login($user);

        $info = new Info();
        $info->username = Auth::user()->username;
        $info->save();

        return redirect()->route('home');
    }

    public function postSignIn(Request $request){

        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);

        if(Auth::attempt([ 'email' => $request['email'], 'password' => $request['password'] ])) {
            return redirect()->route('home');
        }
        return redirect()->back()->with(['danger-message' => 'Invalid username or password!' ]);
    }

    public function postLogout(){
        Auth::logout();
        return redirect()->route('home');
    }

}
