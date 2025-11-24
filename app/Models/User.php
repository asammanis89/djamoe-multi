<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

   protected $fillable = [
    'name', // PASTIKAN INI ADA
    'username',
    'email',
    'password',
    'role',
    'is_active',
];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}