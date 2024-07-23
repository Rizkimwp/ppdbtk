<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index() {

        if(Auth::check()) {
            return redirect ('/dashboard');

        }else{
            return view('pages.login');
        }
    }

    public function loginsso() {
        if(Auth::check()) {
            return redirect ('/dashboard');

        }else{
            return view('pages.login_sso');
        }
        }

    public function showregister() {
    return view('pages.register');
    }

    public function registerSiswa(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:16|min:4',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string',
            'konfirmasi' => 'required|string|same:password',
        ]);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin'
        ]);

        return redirect()->route('login')->with('success','User berhasil terdaftar, Silahkan Login');
    }

    public function login(Request $request)
    {
        if (Auth::attempt($request->only('username', 'password'))) {
            return redirect()->route('dashboard'); // Mengarahkan ke rute dashboard
        }

        return redirect()->back()->with('error', 'Username atau Password Salah');
    }

    public function logout(Request $request)
    {

        Auth::guard('web')->logout();
        return redirect()->route('login');
    }

}