<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
 

public function index()
{
    $categories = Category::all();
    return view('admin.categories.index', compact('categories'));
}

public function create()
{
    return view('admin.categories.create');
}

public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
    ]);

    Category::create($request->only('name'));

    return redirect()->route('admin.categories.index')->with('success', 'Category added successfully.');
}

public function destroy(Category $category)
{
    $category->delete();
    return redirect()->back()->with('success', 'Category deleted.');
}

}
