<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;

class MyserviceController extends Controller
{
    public function index()
    {
        $services = Service::latest()->get();
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

public function store(Request $request)
{
    $request->validate([
        'title' => 'required',
        'description' => 'required',
        'type' => 'required|in:normal,blog',
    ]);

    $service = new Service();
    $service->title = $request->title;
    $service->description = $request->description;
    $service->type = $request->type; // <-- this is critical
    $service->save();

    return redirect()->route('admin.services.index')->with('success', 'Service created.');
}




    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

   public function update(Request $request, Service $service)
{
    $data = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'image' => 'nullable|image',
        'icon' => 'nullable|string|max:255',
    ]);

    if ($request->hasFile('image')) {
        $data['image'] = $request->file('image')->store('services', 'public');
    }

    $service->update($data);

    return redirect()->route('admin.services.index')->with('success', 'Service updated successfully.');
}


    public function destroy(Service $service)
    {
        $service->delete();

        return redirect()->route('admin.services.index')->with('success', 'Service deleted.');
    }
     public function show($id)
    {
        $service = Service::findOrFail($id);
        return view('admin.services.show', compact('service'));
    }
}
