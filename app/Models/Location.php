<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = ['name', 'region_id', 'shipping_fee'];

    public function region()
    {
        return $this->belongsTo(Region::class);
    }
}

