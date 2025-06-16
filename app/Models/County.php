<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class County extends Model
{
    protected $fillable = ['name'];

    public function regions()
    {
        return $this->hasMany(Region::class);
    }
}

