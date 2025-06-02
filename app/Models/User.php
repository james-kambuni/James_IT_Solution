<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Lab404\Impersonate\Models\Impersonate;
use Lab404\Impersonate\Services\ImpersonateManager;
// App\Models\User.php


class User extends Authenticatable
{
    
    use HasApiTokens, HasFactory, Notifiable;
    use Impersonate;

    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin', // Make sure this is included
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_admin' => 'boolean', // Proper boolean casting
    ];
    public function canImpersonate()
{
    return $this->is_admin; // or any logic that fits your app
}
public function lastLogin()
{
    return $this->hasOne(LastLogin::class)->latestOfMany(); // Or appropriate relationship
}

}