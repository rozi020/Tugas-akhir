<?php

namespace App\Http\Controllers;

use App\Models\Sapi;
use Illuminate\Http\Request;

class SapiController extends Controller
{
    public function daftarsapi(){
        return view('Sapi.daftarsapi');
    }

    public function sapimasuk(){
        return view('Sapi.sapikeluar');
    }

    public function sapikeluar(){
        return view('Sapi.sapimasuk');
    }

    public function hasilperah(){
        return view('HasilPerah.index');
    }
    
}
