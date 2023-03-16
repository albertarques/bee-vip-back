<?php

namespace App\Http\Controllers;

use App\Models\Entrepreneurship;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{
  // public function __construct()
  // {
  //   $this->middleware('api');
  // }

  // public function index()
  // {
  //   $users = User::all();
  //   return response()->json([
  //     'status' => 'success',
  //     'users' => $users,
  //   ]);
  // }

  // public function store(Request $request)
  // {
  //   $request->validate([
  //     'username' => 'required|string|max:255',
  //     'picture' => 'nullable|string|max:255',
  //     'email' => 'required|email|max:255',
  //     'password' => 'required|string|min:8',
  //     'phone' => 'required|string|digits_between:9,15',
  //   ]);

  //   $user = User::create([
  //     'username' => $request->username,
  //     'picture' => $request->picture,
  //     'email' => $request->email,
  //     'password' => $request->password,
  //     'phone' => $request->phone,
  //   ]);

  //   return response()->json([
  //     'code' => 200,
  //     'status' => 'success',
  //     'message' => 'user created successfully',
  //     'user' => $user,
  //   ]);
  // }

  public function show($id)
  {
    $user = User::find($id);
    $user_id = $user->id;
    $entrepreneurships = Entrepreneurship::all()->where('user_id', '=', $user_id);
    // $role = Role::find()->where($user_id = 'user_id');

    return response()->json([
      'status' => 'success',
      'user' => $user,
      // 'role' => $role,
      'entrepreneurships' => $entrepreneurships,
    ]);
  }

  public function update_me(Request $request)
  {
    $user_id = auth()->user()->id;
    $user = User::find($user_id);

    // Verificar que el usuario existe
    if (!$user) {
      return response()->json([
          'message' => 'Usuario no encontrado'
      ], 404);
    }

    // Verificar que el usuario está autorizado para actualizar
    if (Auth::user()->id !== $user->id) {
      return response()->json([
        'message' => 'No autorizado para actualizar este usuario'
      ], 401);
    }

    $request->validate([
      'username' => 'required|string|max:255|unique:users,username,'.$user_id,
      'picture' => 'nullable|string|max:255',
      'email' => 'required|email|max:255',
      'password' => 'required|string|min:8',
      'phone' => 'required|string|digits_between:9,15|unique:users,phone,'.$user_id,
    ]);

    $user->username = $request->username;
    $user->picture = $request->picture;
    $user->email = $request->email;
    $user->password = Hash::make($request->password);
    $user->phone = $request->phone;
    $user->update();

    return response()->json([
      'status' => 'success',
      'message' => 'User profile updated successfully',
      'user' => $user,
    ]);

  }

  public function destroy_me()
  {

    $user_id = auth()->user()->id;
    $user = User::find($user_id);

    // Verificar que el usuario existe
    if (!$user) {
      return response()->json([
          'message' => 'User not found'
      ], 404);
    }

    // Verificar que el usuario está autorizado para actualizar
    if (Auth::user()->id !== $user->id) {
      return response()->json([
        'message' => 'Authorisation required to delete user'
      ], 401);
    }

    $user->delete();

  }

  public function destroy($id)
  {
    $user = User::find($id);
    $user->delete();

    return response()->json([
      'status' => 'success',
      'message' => 'User deleted successfully',
      'user' => $user,
    ]);
  }

  public function update_role(Request $request, User $id)
  {
    $this->validate($request, [
      'role' => 'required|string|exists:roles,name',
    ]);

    $roleName = $request->input('role');
    $role = Role::where('name', $roleName)->firstOrFail();

    $id->syncRoles($role);

    return response()->json([
      'message' => 'User role updated successfully',
      'user' => $id->load('roles'),
    ]);
  }
}
