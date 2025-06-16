<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Slider;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::all();
        return view('admin.sliders.index', compact('sliders'));
    }

    public function create()
    {
        return view('admin.sliders.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image',
        ]);

        $path = $request->file('image')->store('sliders', 'public');

        Slider::create([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'background_color' => $request->background_color,
            'image' => $path,
        ]);

        return redirect()->route('admin.sliders.index')->with('success', 'Slider added successfully.');
    }

    public function show($id)
    {
        // Optional placeholder: redirect or return detail view
        return redirect()->route('admin.sliders.index');
    }

    public function edit($id)
    {
        $slider = Slider::findOrFail($id);
        return view('admin.sliders.edit', compact('slider'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'background_color' => 'nullable|string|max:255',
            'image' => 'nullable|image',
        ]);

        $slider = Slider::findOrFail($id);
        $slider->title = $request->title;
        $slider->subtitle = $request->subtitle;
        $slider->background_color = $request->background_color;

        if ($request->hasFile('image')) {
            // Delete old image
            Storage::disk('public')->delete($slider->image);

            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $path = $image->storeAs('sliders', $imageName, 'public');

            $slider->image = $path;
        }

        $slider->save();

        return redirect()->route('admin.sliders.index')->with('success', 'Slider updated successfully.');
    }

    public function destroy(Slider $slider)
    {
        Storage::disk('public')->delete($slider->image);
        $slider->delete();

        return back()->with('success', 'Slider deleted.');
    }
}
