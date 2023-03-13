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

  public function store(Request $request)
  {
    $request->validate([
      'name' => 'required|string|max:255',
    ]);

    $category = Category::create([
      'name' => $request->name,
    ]);

    return response()->json([
      'status' => 'success',
      'message' => 'category created successfully',
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
    $category->title = $request->title;
    $category->description = $request->description;
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
