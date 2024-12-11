<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::latest()->get();
        return view('admin.brand.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'name'        => 'required|string|unique:brands,name',
                'description' => 'nullable|string|max:1000',
                'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif',
            ]
        );
        $brand              = new Brand();
        $brand->name        = $request->name;
        $brand->description = $request->description;
        if ($request->hasFile('image')) {
            $brand->image       = getFileUrl($request->file('image'), 'uploads/brand-images/');
        }
        $brand->status      = $request->status;
        $brand->save();

        return back()->with('message', 'Brand info created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand)
    {
        return view('admin.brand.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand)
    {
        return view('admin.brand.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Brand $brand)
    {
        $brand->name        = $request->name;
        $brand->description = $request->description;
        if ($request->hasFile('image')) {
            if (file_exists($brand->image)) {
                unlink($brand->image);
            }
            $brand->image   = getFileUrl($request->file('image'), 'uploads/brand-images/');
        }
        $brand->status      = $request->status;
        $brand->save();
        return redirect('/brand')->with('message', 'Brand info updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand) //($id) -old
    {
        if (file_exists($brand->image)) {
            unlink($brand->image);
        }
        $brand->delete();
        return redirect('/brand')->with('message', 'Brand info deleted successfully');
    }
}
