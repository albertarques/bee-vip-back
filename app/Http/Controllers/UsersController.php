<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('api');
    }

    public function index()
    {
        $users = User::all();
        return response()->json([
            'status' => 'success',
            'users' => $users,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'picture' => 'nullable|string|max:255',
            'email' => 'required|string|max:255',
            'password' => 'required|string|min:8',
            'phone' => 'required|string|max:15',
            'state' => 'nullable|boolean|max:1', 
        ]);

        $user = User::create([
            'username' => $request->username,
            'picture' => $request->picture,
            'email' => $request->email,
            'password' => $request->password,
            'phone' => $request->phone,
            'state' => $request->state,            
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'user created successfully',
            'user' => $user,
        ]);
    }

    public function show($id)
    {
        $user = User::find($id);
        return response()->json([
            'status' => 'success',
            'users' => $user,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'picture' => 'nullable|string|max:255',
            'email' => 'required|string|max:255',
            'password' => 'required|string|min:8',
            'phone' => 'required|string|max:15',
            'state' => 'nullable|boolean|max:1', 
        ]);

        $user = User::find($id);
        $user->username = $request->username;
        $user->picture = $request->picture;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->phone = $request->phone;
        $user->state = $request->state;
        $user->save();

        return response()->json([
            'status' => 'success',
            'message' => 'user updated successfully',
            'user' => $user,
        ]);
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'user deleted successfully',
            'user' => $user,
        ]);
    }
}
