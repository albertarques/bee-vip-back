<?php

namespace App\Http\Controllers;

use App\Models\Entrepreneurship;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth:api', ['except' => ['login', 'register']]);
  }

  public function login(Request $request)
  {
    $request->validate([
      'email' => 'required|string|email',
      'password' => 'required|string',
    ]);

    $credentials = $request->only('email', 'password');

    $token = Auth::attempt($credentials);

    if (!$token) {
      return response()->json([
        'status' => 'error',
        'message' => 'Unauthorized',
      ], 401);
    }

    $user = Auth::user();

    return response()->json([
      'status' => 'success',
      'user' => $user,
      'authorisation' => [
        'token' => $token,
        'type' => 'bearer',
      ]
    ]);
  }

  /**
   * Get the authenticated User.
   *
   * @return \Illuminate\Http\JsonResponse
   */

  public function me()
  {
    $user_id = auth()->user()->id;
    $role = Role::find($user_id);
    $entrepreneurships = Entrepreneurship::find($user_id);

    return response()->json([
      'status' => 'success',
      'user' => auth()->user(),
      'role' => $role,
      'entrepreneurships' => [$entrepreneurships],
    ]);
  }

  public function register(Request $request)
  {
    $request->validate([
      'username' => 'required|string|max:255|unique:users',
      'email' => 'required|string|email|max:255|unique:users',
      'password' => 'required|string|min:6',
      'phone' => 'required|string|unique:users|max:12',
    ]);

    $user = User::create([
      'username' => $request->username,
      'email' => $request->email,
      'password' => Hash::make($request->password),
      'phone' => $request->phone,
    ]);

    $user->assignRole('user');

    $token = Auth::login($user);

    return response()->json([
      'status' => 'success',
      'message' => 'User created successfully',
      'user' => $user,
      'authorisation' => [
        'token' => $token,
        'type' => 'bearer',
      ]
    ], 200);
  }

  public function logout()
  {
    Auth::logout();
    return response()->json([
      'status' => 'success',
      'message' => 'Successfully logged out',
    ]);
  }

  public function refresh()
  {
    return response()->json([
      'status' => 'success',
      'user' => Auth::user(),
      'authorisation' => [
        'token' => Auth::refresh(),
        'type' => 'bearer',
      ]
    ]);
  }
}
