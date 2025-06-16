<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AboutService;

class AboutServiceController extends Controller
{
    public function index()
    {
        $services = AboutService::all();
        return view('admin.about.about_services.index', compact('services'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'icon' => 'required|string|max:255',
            'service' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        AboutService::create($request->all());

        return back()->with('success', 'Service added successfully.');
    }

    public function edit(AboutService $aboutService)
{
    return view('admin.about.about_services.edit', compact('aboutService'));
}

public function update(Request $request, AboutService $aboutService)
{
    $request->validate([
        'icon' => 'required|string',
        'service' => 'required|string|max:255',
        'service_description' => 'required|string',
    ]);

    $aboutService->update($request->only('icon', 'service', 'service_description'));

    return redirect()->route('admin.about.about-services.index')->with('success', 'Service updated successfully.');
}


    public function destroy(AboutService $aboutService)
    {
        $aboutService->delete();
        return back()->with('success', 'Service deleted.');
    }
    
}
