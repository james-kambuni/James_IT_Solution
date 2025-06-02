<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
   use App\Models\Blog;
   use Illuminate\Support\Str;

class MyblogController extends Controller
{

public function index()
{
    $blogs = Blog::latest()->paginate(10);
    return view('admin.blogs.index', compact('blogs'));
}

public function create()
{
    return view('admin.blogs.create');
}

public function store(Request $request)
{
    $request->validate([
        'title' => 'required',
        'content' => 'required',
        'image' => 'nullable|image'
    ]);

    $blog = new Blog();
    $blog->title = $request->title;
    $blog->slug = \Str::slug($request->title);
    $blog->author = auth()->user()->name;
    $blog->content = $request->content;

    if ($request->hasFile('image')) {
        $path = $request->file('image')->store('blogs', 'public');
        $blog->image = $path;
    }

    $blog->save();

    return redirect()->route('admin.blogs.index')->with('success', 'Blog created successfully.');
}
public function show($id)
{
    $blog = Blog::findOrFail($id);
    return view('admin.blogs.show', compact('blog'));
}

public function edit($id)
{
    $blog = Blog::findOrFail($id);
    return view('admin.blogs.edit', compact('blog'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'title' => 'required',
        'content' => 'required',
        'image' => 'nullable|image'
    ]);

    $blog = Blog::findOrFail($id);
    $blog->title = $request->title;
    $blog->slug = \Str::slug($request->title);
    $blog->content = $request->content;

    if ($request->hasFile('image')) {
        $path = $request->file('image')->store('blogs', 'public');
        $blog->image = $path;
    }

    $blog->save();
    return redirect()->route('admin.blogs.index')->with('success', 'Blog updated successfully.');
}

public function destroy($id)
{
    $blog = Blog::findOrFail($id);
    $blog->delete();
    return redirect()->route('admin.blogs.index')->with('success', 'Blog deleted successfully.');
}

}
