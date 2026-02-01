<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
   
    public function login(){

        return view('auth.login');
    }
    // public  function submitLogin(Request $request){
    //     $request->validate([
    //         'email'=>'required|email',
    //         'password'=>'required|min:6'
    //     ]);
        
    //   $crendentials=$request->Only('email','password');
    //   if(Auth::attempt($crendentials)){
    //     $request->session()->regenerate();
    //     if(Auth::User()->role==='Admin'){
    //         return redirect()->route('admin.dashborad');
        
    //     return redirect()->route('questions.index');}
    //     return back()->withError([
    //         'email'=>'email ou mot de pass est incorrect' ])->onlyInput('email');

    //   }
      
    // }





    public function submitLogin(Request $request){
    $request->validate([
        'email'=>'required|email',
        'password'=>'required|min:6'
    ]);

    $credentials = $request->only('email','password');

    if(Auth::attempt($credentials)){
        $request->session()->regenerate();

        if(Auth::user()->role === 'Admin'){
            return redirect()->route('dasbord');
        }

        return redirect()->route('questions.index');
    }

    return back()->withErrors([
        'email'=>'Email ou mot de passe incorrect'
    ])->onlyInput('email');
}

    public function register(){
        return view('auth.register');
    }
    public function submitregister(Request $request){
         $request->validate([
        'email'=>'required|email|unique:users,email',
        'password'=>'required|min:6',
        'name'=>'required|min:3'
         ]);
         $user=User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password)
         ]);
         Auth::login($user);
         return  redirect()->route('login');
    }

  public function logout(){
    Auth::logout();
    return redirect()->route('login');
  } 
}
