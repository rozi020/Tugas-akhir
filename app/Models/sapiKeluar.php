<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SapiKeluar extends Model
{
    protected $table = 'sapi_keluar';
    protected $fillable = ['kode','harga','status','keterangan'];
}
