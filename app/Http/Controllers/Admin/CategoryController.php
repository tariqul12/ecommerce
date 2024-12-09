<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->get();
        return view('admin.category.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'name'        => 'required|string|unique:categories,name',
                'description' => 'nullable|string',
                'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif',
            ]
        );
        $image     = $request->file('image');
        $imageName = $image->getClientOriginalName();
        $directory = 'uploads/category-images/';
        $image->move($directory, $imageName);
        $imageUrl = $directory . $imageName;

        $category              = new Category();
        $category->name        = $request->name;
        $category->description = $request->description;
        $category->image       = $imageUrl;
        $category->status      = $request->status;
        $category->save();

        return back()->with('message', 'Category info created successfully');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        if ($request->file('image')) {
            $image     = $request->file('image');
            $imageName = $image->getClientOriginalName();
            $directory = 'uploads/category-images/';
            $image->move($directory, $imageName);
            $imageUrl = $directory . $imageName;
            if (file_exists($category->image)) {
                unlink($category->image);
            }
        } else {
            $imageUrl = $category->image;
        }

        $category->name        = $request->name;
        $category->description = $request->description;
        $category->image       = $imageUrl;
        $category->status      = $request->status;
        $category->save();

        return redirect('/category/index')->with('message', 'Category info updated successfully');
    }


    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        if (file_exists($category->image)) {
            unlink($category->image);
        }
        $category->delete();
        return back()->with('message', 'Category info deleted successfully');
    }
}
