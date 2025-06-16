<?php

// app/Models/Product.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'price', 'image', 'description', 'in_stock', 'category_id'];
    
public function orderItems()
{
    return $this->hasMany(OrderItem::class);
}
public function category()
{
    return $this->belongsTo(Category::class);
}

}