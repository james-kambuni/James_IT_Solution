<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AppointmentController extends Controller
{
    public function create()
    {
        return view('appointment');
    }
  public function index()
{
    $appointments = \App\Models\Appointment::latest()->paginate(10);
    return view('admin.appointments.index', compact('appointments'));
}

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        Appointment::create($validated);

        return redirect()->back()->with('success', 'Appointment submitted successfully!');
    }

}
