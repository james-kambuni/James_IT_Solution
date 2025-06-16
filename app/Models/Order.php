<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Location;


class Order extends Model
{
    protected $fillable = [
    'user_id', 'total', 'status',
    'fullname', 'phone', 'email',
    'county', 'region', 'order_notes', 'agreed_to_terms'
];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }
    public function items()
{
    return $this->hasMany(OrderItem::class);
}
public function county()
{
    return $this->belongsTo(County::class);
}

public function region()
{
    return $this->belongsTo(Region::class);
}
public function location()
{
    return $this->belongsTo(Location::class);
}


}

