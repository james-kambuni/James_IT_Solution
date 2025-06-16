<?php

namespace App\Http\Controllers\Admin;

use App\Models\Region;
use App\Models\County;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegionController extends Controller
{
    public function index() {
        $regions = Region::with('county')->get();
        return view('admin.regions.index', compact('regions'));
    }

    public function create() {
        $counties = County::all();
        return view('admin.regions.create', compact('counties'));
        
    }

 public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'county_id' => 'required|exists:counties,id',
    ]);

    Region::create([
        'name' => $request->name,
        'county_id' => $request->county_id,
    ]);

    return redirect()->route('admin.regions.index')->with('success', 'Region added successfully.');
}



    public function edit(Region $region) {
        $counties = County::all();
        return view('admin.regions.edit', compact('region', 'counties'));
    }

    public function update(Request $request, Region $region) {
        $request->validate([
            'name' => 'required',
            'county_id' => 'required|exists:counties,id',
        ]);
        $region->update($request->only('name', 'county_id'));
        return redirect()->route('admin.regions.index')->with('success', 'Region updated.');
    }

    public function destroy(Region $region) {
        $region->delete();
        return back()->with('success', 'Region deleted.');
    }
    public function getByCounty($countyId)
    {
        return Region::where('county_id', $countyId)
                     ->select('id', 'name')
                     ->get();
    }

}
