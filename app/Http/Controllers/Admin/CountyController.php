<?php

namespace App\Http\Controllers\Admin;

use App\Models\County;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CountyController extends Controller
{
    public function index() {
        $counties = County::all();
        return view('admin.counties.index', compact('counties'));
    }

    public function create() {
        return view('admin.counties.create');
    }

    public function store(Request $request) {
        $request->validate(['name' => 'required|unique:counties,name']);
        County::create($request->only('name'));
        return redirect()->route('admin.counties.index')->with('success', 'County added.');
    }

    public function edit(County $county) {
        return view('admin.counties.edit', compact('county'));
    }

    public function update(Request $request, County $county) {
        $request->validate(['name' => 'required|unique:counties,name,' . $county->id]);
        $county->update($request->only('name'));
        return redirect()->route('admin.counties.index')->with('success', 'County updated.');
    }

    public function destroy(County $county) {
        $county->delete();
        return back()->with('success', 'County deleted.');
    }
}

