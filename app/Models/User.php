<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'role',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Helper method to check if user is admin
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    // Helper method to check if user is regular user
    public function isUser()
    {
        return $this->role === 'user';
    }
}