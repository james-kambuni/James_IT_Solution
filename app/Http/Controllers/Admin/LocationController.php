<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\Region;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index()
    {
        $locations = Location::with('region')->get();
        return view('admin.locations.index', compact('locations'));
    }

    public function create()
    {
        $regions = Region::all();
        return view('admin.locations.create', compact('regions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'region_id' => 'required|exists:regions,id',
            'name' => 'required|string|max:255',
            'shipping_fee' => 'required|numeric|min:0',
        ]);

        Location::create($request->all());

        return redirect()->route('admin.locations.index')->with('success', 'Location added.');
    }

    public function edit(Location $location)
    {
        $regions = Region::all();
        return view('admin.locations.edit', compact('location', 'regions'));
    }

    public function update(Request $request, Location $location)
    {
        $request->validate([
            'region_id' => 'required|exists:regions,id',
            'name' => 'required|string|max:255',
            'shipping_fee' => 'required|numeric|min:0',
        ]);

        $location->update($request->all());

        return redirect()->route('admin.locations.index')->with('success', 'Location updated.');
    }

    public function destroy(Location $location)
    {
        $location->delete();
        return back()->with('success', 'Location deleted.');
    }
}
