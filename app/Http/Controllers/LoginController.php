<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use File, Auth, Alert;

class LoginController extends Controller
{
    // Menuju Ke Halaman Login
    public function login(){
        return view('Auth.login');
    }

    // Proses Login
    public function postLogin(Request $request){

        // Checking Username dan Password
        if(Auth::attempt($request->only('username','password'))){
            // Jika Berhasil Login
                return redirect('dashboard')->with('message', 'Welcome, '.auth()->user()->name);
        }
        // Username atau Password salah
        return back()->with('bye', 'Username atau Password anda Salah!');
    }

    // Proses Logout
    public function logout(){
        Auth::logout();
        return redirect('/');
    }

    public function dashboard(){
        if(session('success')){
            Alert::success(session('success'));
        }elseif(session('error')){
            Alert::error(session('error'));
        }
        return view('dashboard');
    }
}
