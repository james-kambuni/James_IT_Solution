<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Blog;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::latest()->take(8)->get();
        $blogs = Blog::latest()->take(3)->get();

        return view('index', compact('blogs', 'products'));
    }
}

