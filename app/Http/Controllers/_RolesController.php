<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;


class RolesController extends Controller
{
    public function __construct()
    {
        $this->middleware('api');
    }

    public function index()
    {
        $roles = Role::all();
        return response()->json([
            'status' => 'success',
            'roles' => $roles,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $role = Role::create([
            'name' => $request->name,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'role created successfully',
            'role' => $role,
        ]);
    }

    public function show($id)
    {
        $role = Role::find($id);
        return response()->json([
            'status' => 'success',
            'role' => $role,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $role = Role::find($id);
        $role->title = $request->title;
        $role->description = $request->description;
        $role->save();

        return response()->json([
            'status' => 'success',
            'message' => 'role updated successfully',
            'role' => $role,
        ]);
    }

    public function destroy($id)
    {
        $role = Role::find($id);
        $role->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'role deleted successfully',
            'role' => $role,
        ]);
    }

}
