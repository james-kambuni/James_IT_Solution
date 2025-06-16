<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
 use App\Models\Category;

class ProductController extends Controller
{
    // For general users
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }


    // For admin panel
    public function adminIndex()
    {
        $products = Product::latest()->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
         $categories = Category::all();
        return view('admin.products.create', compact('categories'));
        
    }

    public function store(Request $request)
    {
        $data = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'required|numeric',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'in_stock' => 'required|boolean',
        'category_id' => 'required|exists:categories,id',
        ]);

         if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('products', 'public'); // stores in storage/app/public/products
        $validated['image'] = $imagePath;
        }

        Product::create($data);

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'image' => 'nullable|image',
            'in_stock' => 'required|boolean',
            'category_id' => 'required|exists:categories,id',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);
        $product->category_id = $request->category_id;


        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return back()->with('success', 'Product deleted successfully.');
    }
   
}