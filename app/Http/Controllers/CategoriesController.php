<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;


class CategoriesController extends Controller
{
  public function __construct()
  {
    $this->middleware('api');
  }

  public function index()
  {
    $categories = Category::all();

    return response()->json([
      'status' => 'success',
      'categories' => $categories,
    ]);
  }

  public function create(Request $request)
  {
    $request->validate([
      'name' => 'required|string|max:255',
    ]);

    $category = new Category;
    $category->name = $request->name;
    $category->save();

    return response()->json([
      'status' => 'success',
      'message' => 'Category created successfully.',
      'category' => $category,
    ]);
  }

  public function show($id)
  {
    $category = Category::find($id);
    return response()->json([
      'status' => 'success',
      'category' => $category,
    ]);
  }

  public function update(Request $request, $id)
  {
    $request->validate([
      'name' => 'required|string|max:255',
    ]);

    $category = Category::find($id);
    $category->name = $request->name;
    $category->save();

    return response()->json([
      'status' => 'success',
      'message' => 'category updated successfully',
      'category' => $category,
    ]);
  }

  public function destroy($id)
  {
    $category = Category::find($id);
    $category->delete();

    return response()->json([
      'status' => 'success',
      'message' => 'category deleted successfully',
      'category' => $category,
    ]);
  }
}
