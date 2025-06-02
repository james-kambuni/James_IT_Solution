<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;

class BlogController extends Controller
{
    

public function index()
{
    $blogs = Blog::latest()->paginate(10);
    return view('blog', compact('blogs'));
}

public function show($slug)
{
    $blog = \App\Models\Blog::where('slug', $slug)->firstOrFail();
    return view('blogs.show', compact('blog'));
}



}
