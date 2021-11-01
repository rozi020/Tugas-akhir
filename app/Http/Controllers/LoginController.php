<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Sapi;
use App\Models\SapiKeluar;
use App\Models\History;
use File, Auth, Alert;

class LoginController extends Controller
{
    // Menuju Ke Halaman Login
    public function login(){
        //Delete History 60 Hari Sekali 
        History::where('created_at', '<', Carbon::now()->subDays(60))->delete();

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

        $pengurus = User::where('id_role',2)->count();
        $sapi = Sapi::count();
        $sapiKeluar = SapiKeluar::count();
        $activity = History::where('user_id',auth()->user()->id)->get();

        return view('dashboard', compact('pengurus','sapi','sapiKeluar','activity'));
    }
}
