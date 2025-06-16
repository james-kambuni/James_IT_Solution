<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Blog;
use App\Models\Service;
use App\Models\AboutService;
use App\Models\Slider;

class HomeController extends Controller
{
   public function index()
{
    $products = Product::latest()->take(8)->get();
    $blogs = Blog::latest()->take(3)->get();
    $normalServices = Service::where('type', 'normal')->latest()->get();
    $blogServices = Service::where('type', 'blog')->latest()->get();
    $aboutServices = AboutService::all(); // Or use a filtered query if needed
    $sliders = Slider::all();

    return view('index', compact('blogs', 'products', 'normalServices','blogServices','aboutServices','sliders'));
}

}
