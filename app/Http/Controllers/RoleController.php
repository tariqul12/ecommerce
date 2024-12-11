<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\RoleRoute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class RoleController extends Controller
{
    public function index()
    {
        return view('role.index');
    }
    public function create()
    {
        $routeList = Route::getRoutes();

        return view('role.create', compact('routeList'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'name'        => 'required|string',
                'description' => 'nullable',
                'route_name'  => 'required',
            ]
        );
        $role = new Role();
        $role->name = $request->name;
        $role->description = $request->description;
        $role->save();

        foreach ($request->route_name as $item) {
            $roleRoute = new RoleRoute();
            $roleRoute->role_id = $role->id;
            $roleRoute->role_name = $role->name;
            $roleRoute->route_name = $item;
            $roleRoute->save();
        }
        return back()->with('message', 'Role Create Successfully');
    }
    public function edit()
    {
        return view('role.edit');
    }
}
