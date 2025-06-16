<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\About;

class AboutUsController extends Controller
{
    public function index()
    {
        $about = About::first();
        return view('admin.about.index', compact('about'));
    }

    public function update(Request $request)
{
    $validated = $request->validate([
        'title' => 'nullable|string|max:255',
        'description' => 'nullable|string',
        'service' => 'nullable|string|max:255',
        'icon' => 'nullable|string|max:255',
        'service_description' => 'nullable|string',
    ]);

    $about = About::first(); // assuming there's only one record
    if (!$about) {
        $about = new About();
    }

    $about->fill($validated);
    $about->save();

    return redirect()->back()->with('success', 'About Us updated successfully!');
}

}
