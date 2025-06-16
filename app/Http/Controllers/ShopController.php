<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Service;

class ShopController extends Controller
{
    public function index()
{
    $products = Product::where('in_stock', 1)->paginate(8);
    $serviceBlogs = Service::where('type', 'blog')->latest()->get();

    return view('shop', compact('products', 'serviceBlogs'));
}

    

// public function show($id)
// {
//     $service = service::findOrFail($id);

//     // Get all services where is_service_blog = true
//     $serviceBlogs = Service::where('type', 'blog')->latest()->get();

//     return view('admin.services.show', compact('service', 'serviceBlogs'));
// }
public function show(Product $product)
{
    $related = Product::where('category_id', $product->category_id)
                ->where('id', '!=', $product->id)
                ->inRandomOrder()
                ->take(8)
                ->get();

    return view('show', compact('product', 'related'));
}


}