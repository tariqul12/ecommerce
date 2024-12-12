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
        $roles = Role::latest()->get();
        return view('role.index', compact('roles'));
    }
    public function create()
    {
        $routeLists = Route::getRoutes();

        return view('role.create', compact('routeLists'));
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
    public function edit($id)
    {
        $role = Role::find($id);
        $routeLists = Route::getRoutes();
        return view('role.edit', compact('role', 'routeLists'));
    }
    public function update(Request $request, $id)
    {

        $role = Role::find($id);
        $role->name = $request->name;
        $role->description = $request->description;
        $role->save();

        if ($request->route_name) {
            $routeRoute = Route::where('role_id', $role->id)->get();
            foreach ($routeRoute as $item) {
                $item->delete();
            }
        }

        foreach ($request->route_name as $item) {
            $roleRoute = new RoleRoute();
            $roleRoute->role_id = $role->id;
            $roleRoute->role_name = $role->name;
            $roleRoute->route_name = $item;
            $roleRoute->save();
        }
        return redirect('/role/index')->with('message', 'Role Update successfully');
    }
}
