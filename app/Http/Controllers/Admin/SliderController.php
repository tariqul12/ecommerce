<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sliders = Slider::orderBy("id", "desc")->get();
        return view('admin.slider.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::whereStatus(1)->latest()->get();
        return view('admin.slider.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'title'       => 'required|string',
                'product_id'  => 'required',
                'sub_title'   => 'required|string',
                'image'       => 'required',
            ]
        );
        $slider              = new Slider();
        $slider->title       = $request->title;
        $slider->product_id  = $request->product_id;
        $slider->sub_title   = $request->sub_title;
        $slider->image       = getFileUrl($request->file('image'), 'uploads/slider-images/');
        $slider->status      = $request->status;
        $slider->save();

        return back()->with('message', 'Slider info created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Slider $slider)
    {
        return view('admin.slider.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Slider $slider)
    {
        $products = Product::whereStatus(1)->latest()->get();
        return view('admin.slider.edit', compact('slider', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Slider $slider)
    {
        $slider->title       = $request->title;
        $slider->product_id  = $request->product_id;
        $slider->sub_title   = $request->sub_title;
        if ($request->hasFile('image')) {
            $slider->image       = getFileUrl($request->file('image'), 'uploads/slider-images/');
        }
        $slider->status      = $request->status;
        $slider->save();
        return redirect('/slider')->with('message', 'Slider info updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Slider $slider)
    {
        if (file_exists($slider->image)) {
            unlink($slider->image);
        }
        $slider->delete();
        return redirect('/slider')->with('message', 'Slider info deleted successfully');
    }
}
