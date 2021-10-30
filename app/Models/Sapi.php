<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sapi extends Model
{
    protected $table = 'sapi';
    protected $fillable = ['kode', 'umur', 'berat', 'jenis', 'status'];
}
