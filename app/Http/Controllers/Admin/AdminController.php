<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Product;
use App\Models\Appointment;

class AdminController extends Controller
{
    public function dashboard()
    {
        $usersCount = User::count();
        $productsCount = Product::count();
        $appointmentsCount = Appointment::count();
        
        return view('admin.dashboard', compact('usersCount', 'productsCount', 'appointmentsCount'));
    }
}