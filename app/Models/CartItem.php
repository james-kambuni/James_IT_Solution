<?php

// app/Models/CartItem.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cart_id',
        'product_id',
        'quantity',
        'price',
        'name',
        'image',
        'user_id'
    ];
    
    // Your existing relationships...
    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }
    public function order() {
    return $this->belongsTo(Order::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    
}
