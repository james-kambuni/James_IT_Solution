<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ShopController extends Controller
{
    public function index()
    {
    $products = Product::where('in_stock', 1)->paginate(8);
    return view('shop', compact('products'));
        
        // dd($data);
    }
}