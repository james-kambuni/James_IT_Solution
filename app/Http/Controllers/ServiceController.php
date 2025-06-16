<?php

namespace App\Http\Controllers;

use App\Models\Service;

class ServiceController extends Controller
{
    public function index()
{
    $services = Service::where('type', 'normal')->get();
    $serviceBlogs = Service::where('type', 'blog')->paginate(3); 

    return view('service', compact('services', 'serviceBlogs'));
}
public function show($id)
{
    $service = Service::findOrFail($id);
    $serviceBlogs = Service::where('type', 'blog')->latest()->get();
    return view('services.show', compact('service', 'serviceBlogs'));
}

}
