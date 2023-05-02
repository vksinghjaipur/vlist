<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Validator;

//V code
// use Hash;
// use Session;
// use App\Models\User;
// use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function loadRegister()
    {
        //login page ko protect kiya, ab ye page login hone ke baad open nahi hoga
         if(Auth::check()){
                return view('home');
            }else{
                return view('register');
            }
    } 


    public function userRegister(Request $request)
    {
       
        $request->validate([
            'name'=> 'string|required|min:1',
            'email'=>'string|required|email|max:100|unique:users',
            'password'=>'string|required|min:6|confirmed',
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password= Hash::make($request->password);
        $user->save();

        return back()->with('success', 'Your registratin has been successful');
    }


    public function loadLogin()
    {
         //login page ko protect kiya, ab ye page login hone ke baad open nahi hoga
         if(Auth::check()){
                return view('home');
            }else{
                return view('login');
            }
    }

    public function userLogin(Request $request)
    {
        $request->validate([
            'email'=>'string|required|email',
            'password'=>'string|required'
        ]);

        $userCredential = $request->only('email', 'password');
        if(Auth::attempt($userCredential))
        {
            return redirect('home');
        }
        else{
            return back()->with('error', 'Email or Password is incorrect !');
        }
    }

    public function home()
    {
            //home page protect ho gaya without login nahi jaa skate home page par
            if(Auth::check()){
                return view('home');
            }else{
                return redirect('/');
            }     
    }

    public function logOut() 
    {
            Session::flush();
            Auth::logout();
  
        return redirect('login');
    }
}
