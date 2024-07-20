<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    //
    public  function index()
    {
            if(Auth::check()) {
                return redirect ('/dashboard');

            }else{
                return view('login');
            }
    }
    public function login(Request $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->route('dashboard'); // Mengarahkan ke rute dashboard
        }

        Session::flash('error', 'Email atau Password Salah');
        return redirect('/login');
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        return redirect()->route('loginview');
    }

    public function register(Request $request){

        $validate =

    }
    public function user(Request $request)
    {
        return response()->json($request->user(), 200);
    }
}