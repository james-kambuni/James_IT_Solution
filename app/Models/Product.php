<?php

// app/Models/Product.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'description', 'price', 'image', 'in_stock'];
    
public function orderItems()
{
    return $this->hasMany(OrderItem::class);
}
}