<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Courier;
use Illuminate\Http\Request;

class CourierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $couriers = Courier::latest()->get();
        return view('admin.courier.index', compact('couriers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.courier.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //  return $request;
        $request->validate(
            [
                'name'    => 'required|string|max:255',
                'email'   => 'required|string|email|max:255|unique:couriers,email',
                'mobile'  => 'required|string|max:15|unique:couriers,mobile',
                'address' => 'required|string|max:500',
                'logo'    => 'required|image|mimes:jpeg,png,jpg,gif|max:10240',
                'status'  => 'required|integer|in:0,1',
            ]
        );

        $image     = $request->file('logo');
        $imageName = $image->getClientOriginalName();
        $directory = 'uploads/courier-logo/';
        $image->move($directory, $imageName);
        $imageUrl = $directory . $imageName;

        $courier          = new Courier();
        $courier->name    = $request->name;
        $courier->email   = $request->email;
        $courier->mobile  = $request->mobile;
        $courier->address = $request->address;
        $courier->logo    = $imageUrl;
        $courier->status  = $request->status;
        $courier->save();

        return back()->with('message', 'Courier info save successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Courier $courier)
    {
        return view('admin.courier.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Courier $courier)
    {
        return view('admin.courier.edit', compact('courier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Courier $courier)
    {
        if ($request->file('logo')) {
            $image     = $request->file('logo');
            $imageName = $image->getClientOriginalName();
            $directory = 'uploads/courier-logo/';
            $image->move($directory, $imageName);
            $imageUrl = $directory . $imageName;
            if (file_exists($courier->logo)) {
                unlink($courier->logo);
            }
        } else {
            $imageUrl = $courier->logo;
        }
        $courier->name    = $request->name;
        $courier->email   = $request->email;
        $courier->mobile  = $request->mobile;
        $courier->address = $request->address;
        $courier->logo    = $imageUrl;
        $courier->status  = $request->status;
        $courier->save();
        return redirect('/courier')->with('message', 'Courier info update successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Courier $courier)
    {
        if (file_exists($courier->logo)) {
            unlink($courier->logo);
        }
        $courier->delete();
        return redirect('/courier')->with('message', 'Courier info delete successfully.');
    }
}
