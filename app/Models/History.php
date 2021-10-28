<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class History extends Model
{
    protected $table = 'history';
    protected $fillable = ['nama','aksi','keterangan','user_id'];

    public function user()
    {
      return $this->belongsTo(User::class);
    }
}
