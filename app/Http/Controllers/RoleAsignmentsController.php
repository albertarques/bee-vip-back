<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RoleAssignment;

class RoleAsignmentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('api');
    }

    public function index()
    {
        $roleAssignments = RoleAssignment::all();
        return response()->json([
            'status' => 'success',
            'roleAssignments' => $roleAssignments,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|string|max:255',
            'role_id' => 'required|string|max:255',
        ]);

        $roleAssignment = RoleAssignment::create([
            'user_id' => $request->user_id,
            'role_id' => $request->role_id,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'roleAssignment created successfully',
            'roleAssignment' => $roleAssignment,
        ]);
    }

    public function show($id)
    {
        $roleAssignment = RoleAssignment::find($id);
        return response()->json([
            'status' => 'success',
            'roleAssignments' => $roleAssignment,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|string|max:255',
            'role_id' => 'required|string|max:255',
        ]);

        $roleAssignment = RoleAssignment::find($id);
        $roleAssignment->user_id = $request->user_id;
        $roleAssignment->role_id = $request->role_id;
        $roleAssignment->save();

        return response()->json([
            'status' => 'success',
            'message' => 'roleAssignment updated successfully',
            'roleAssignment' => $roleAssignment,
        ]);
    }

    public function destroy($id)
    {
        $roleAssignment = RoleAssignment::find($id);
        $roleAssignment->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'roleAssignment deleted successfully',
            'roleAssignment' => $roleAssignment,
        ]);
    }

}
