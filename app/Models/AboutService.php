<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutService extends Model
{
    use HasFactory;
    protected $fillable = ['icon', 'service', 'description'];

}
