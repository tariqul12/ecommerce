<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $units = Unit::latest()->get();
        return view('admin.unit.index', compact('units'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.unit.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'name'        => 'required|string|unique:units,name',
                'code'        => 'required|string|unique:units,code',
                'description' => 'nullable|string|max:1000',
            ]
        );
        $unit              = new Unit();
        $unit->name        = $request->name;
        $unit->code        = $request->code;
        $unit->description = $request->description;
        $unit->status      = $request->status;
        $unit->save();

        return back()->with('message', 'Unit info created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Unit $unit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Unit $unit)
    {
        return view('admin.unit.edit', compact('unit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Unit $unit)
    {
        $unit->name        = $request->name;
        $unit->code        = $request->code;
        $unit->description = $request->description;
        $unit->status      = $request->status;
        $unit->save();
        return redirect('/unit')->with('message', 'Unit info updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Unit $unit)
    {
        $unit->delete();
        return redirect('/unit')->with('message', 'Unit info deleted successfully');
    }
}
