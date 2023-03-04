<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class ModelHasRolesController extends Controller
{
  public function __construct()
  {
      $this->middleware('api');
  }

  public function show($id){
    $role = Role::find()->where('model_id', '=', $id);

    return response()->json([
      'code' => 200,
      'status' => 'success',
      'role' => $role,
    ]);
  }

  public function update(Request $request, $id){
    $request->validate([
        'role_id' => 'required|integer|min:1|max:3',
        'model_id' => 'required|integer|min:1|max:3'
    ]);

    $role = Role::find()->where('model_id', '=', $id);
    // $role->role_id = $request->role_id;
    // $role->model_id = $request->id;
    // $role->save();

    return response()->json([
        'code' => 200,
        'status' => 'success',
        'message' => 'user role updated successfully',
        'role' => $role,
    ]);
}

}
