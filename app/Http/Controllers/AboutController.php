<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\AboutService;

class AboutController extends Controller
{
    public function index()
    {
         $normalServices = Service::where('type', 'normal')->latest()->get();
          $aboutServices = AboutService::all(); // Or use a filtered query if needed
         return view('aboutus', compact('normalServices','aboutServices'));
    }
}

