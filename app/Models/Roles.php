<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Roles extends Model
{

    protected $table = 'roles';
    protected $fillable = ['role_name'];

    public function user()
    {
        return $this->hasMany(User::class);
    }
}
