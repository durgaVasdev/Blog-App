<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class AuthManager extends Controller
{
    function login(){
        return view('login');
    }

    function loginpost(Request $request){
        $request->validate([
            'email'=>'required',
            'password'=>'required',
        ]);

        $credentials = $request->only('email','password');
      
        if(Auth::attempt($credentials)){
            return redirect()->intended(route('home'));
        }
    }
}
