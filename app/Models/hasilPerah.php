<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HasilPerah extends Model
{
    protected $table = 'hasil_perah';
    protected $fillable = ['id_sapi','tanggal_perah','jumlah_perah'];
}
