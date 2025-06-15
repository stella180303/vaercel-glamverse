<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\foundation\Auth\User as Authenticatable;

class Salon_user extends Authenticatable
{
    protected $fillable = [
        'nama_salon', 
        'email', 
        'phone', 
        'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
