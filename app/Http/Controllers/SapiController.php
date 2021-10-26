<?php

namespace App\Http\Controllers;

use App\Models\Sapi;
use Illuminate\Http\Request;

class SapiController extends Controller
{
    public function sapi()
    {
        return view('Sapi.daftarsapi'); 
    }

    public function sapikeluar(){
        return view('Sapi.sapikeluar');
    }
    
}
