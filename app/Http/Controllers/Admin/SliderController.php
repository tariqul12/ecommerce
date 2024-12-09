<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
        return view('admin.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'heading'     => 'required|string',
                'title'       => 'required|string',
                'sub_title'   => 'required|string',
                'image'       => 'required',
                'button_text' => 'required|string',
            ]
        );
        $image     = $request->file('image');
        $imageName = $image->getClientOriginalName();
        $directory = 'uploads/slider-images/';
        $image->move($directory, $imageName);
        $imageUrl = $directory . $imageName;

        $slider              = new Slider();
        $slider->heading     = $request->heading;
        $slider->title       = $request->title;
        $slider->sub_title   = $request->sub_title;
        $slider->image       = $imageUrl;
        $slider->button_text = $request->button_text;
        $slider->button_link = $request->button_link;
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
        return view('admin.slider.edit', ['slider' => $slider]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Slider $slider)
    {
        if ($request->file('image')) {
            $image     = $request->file('image');
            $imageName = $image->getClientOriginalName();
            $directory = 'uploads/slider-images/';
            $image->move($directory, $imageName);
            $imageUrl = $directory . $imageName;
            if (file_exists($slider->image)) {
                unlink($slider->image);
            }
        } else {
            $imageUrl = $slider->image;
        }

        $slider->heading     = $request->heading;
        $slider->title       = $request->title;
        $slider->sub_title   = $request->sub_title;
        $slider->image       = $imageUrl;
        $slider->button_text = $request->button_text;
        $slider->button_link = $request->button_link;
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
