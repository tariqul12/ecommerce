<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subCategories = SubCategory::latest()->get();
        return view('admin.sub-category.index', compact('subCategories')); //category_id collecting
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('status', 1)->orderBy('id', 'desc')->get();
        return view('admin.sub-category.create', compact('categories')); //category row collecting
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //return $request;
        $request->validate(
            [
                'category_id' => 'required|integer|exists:categories,id',
                'name'        => 'required|string|unique:sub_categories,name',
                'description' => 'nullable|string',
                'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif',
            ]
        );
        $sub_category              = new SubCategory();
        $sub_category->category_id = $request->category_id;
        $sub_category->name        = $request->name;
        $sub_category->description = $request->description;
        if ($request->hasFile('image')) {
            $sub_category->image   = getFileUrl($request->file('image'), 'uploads/sub-category-images/');
        }
        $sub_category->status      = $request->status;
        $sub_category->save();
        return back()->with('message', 'Sub Category info created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubCategory $sub_category)
    {
        $categories = Category::where('status', 1)->orderBy('id', 'desc')->get();
        return view('admin.sub-category.edit', compact('categories', 'sub_category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SubCategory $sub_category)
    {
        $sub_category->category_id = $request->category_id;
        $sub_category->name        = $request->name;
        $sub_category->description = $request->description;
        if ($request->hasFile('image')) {
            if (file_exists($sub_category->iamge)) {
                unlink($sub_category->image);
            }
            $sub_category->image   = getFileUrl($request->file('image'), 'uploads/sub-category-images/');
        }
        $sub_category->status      = $request->status;
        $sub_category->save();
        return redirect('/sub-category')->with('message', 'Sub Category info updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubCategory $sub_category)
    {
        if (file_exists($sub_category->iamge)) {
            unlink($sub_category->image);
        }
        $sub_category->delete();
        return back()->with('message', 'Sub Category info delete successfully');
    }
}
