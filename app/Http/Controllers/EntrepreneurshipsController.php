<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Entrepreneurship;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EntrepreneurshipsController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index_my()
  {
    $user_id = auth()->user()->id;
    $entrepreneurships = Entrepreneurship::all()->where("user_id", "=", $user_id);

    // Verificar que el emprendimiento existe
    if (!$entrepreneurships) {
      return response()->json([
          'message' => 'No tienes ningún emprendimiento'
      ], 404);
    }

    return response()->json([
      'status' => 'success',
      'entrepreneurships' => [...$entrepreneurships],
    ], 200);
  }

  /**
   * Display an approved state list of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index_approved()
  {
    // TODO: Obtiene todos los emprendimientos aprovados y todas las categorías.
    $entrepreneurships = Entrepreneurship::all();
    // $category = Category::all();

    return response()->json([
      'code' => 200,
      'status' => 'success',
      'entrepreneurships' => [...$entrepreneurships],
      // 'categories' => $category,
    ], 200);
  }

  /**
   * Display a pending state list of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index_pending()
  {
    // TODO: Obtiene todos los emprendimientos pendientes de aprovación.
    $entrepreneurships = Entrepreneurship::all()->where('inspection_state', '=', 1);

    return response()->json([
      'status' => 'success',
      'entrepreneurships' => [...$entrepreneurships],
    ], 200);
  }

  /**
   * Display an available & approved state  list of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index_available()
  {
    // Obtiene todos los emprendimientos aprovados y disponibles.
    $entrepreneurships = Entrepreneurship::all()->where('inspection_state', '=', 2)->where('availability_state', '=', 2);

    return response()->json([
      'status' => 'success',
      'entrepreneurships' => [...$entrepreneurships],
    ], 200);
  }

  /**
   * Create the specified resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create(Request $request)
  {
    $user = auth()->user();

    $user_phone = $user->phone;
    $user_email = $user->email;

    $request->validate([
      'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
      'title' => 'required|max:255',
      'description' => 'required|max:1000',
      'product_img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
      'price' => 'required|numeric|min:0',
      'category_id' => 'required|exists:categories,id',
      'cash_payment' => 'required|boolean',
      'card_payment' => 'required|boolean',
      'bizum_payment' => 'required|boolean',
      'stock' => 'nullable|integer|min:0',
      'location' => 'required'
    ]);

    // handle image
    $image = $request->file('product_img');
    $imageName = time() . '.' . $image->getClientOriginalExtension();
    $imagePath = 'images/entrepreneurships/';
    $image->move(public_path($imagePath), $imageName);

    $entrepreneurship = new Entrepreneurship;
    $entrepreneurship->user_id = $user->id;

    if ($request->hasFile('logo')) {
      $logo = $request->file('logo');
      $logo_name = time() . '.' . $logo->getClientOriginalExtension();
      $logo_path = $logo->store('public/images');
      $logo->move(public_path($logo_path), $logo_name);
      $entrepreneurship->logo = $logo_path . $logo_name;
    } else {
      $entrepreneurship->logo = 'public/images/default/default-logo.png';
    }

    if ($request->hasFile('product_img')) {
      $product_img = $request->file('product_img');
      $product_img_name = time() . '.' . $product_img->getClientOriginalExtension();
      $product_img_path = $product_img->store('public/images');
      $product_img->move(public_path($product_img_path), $product_img_name);
      $entrepreneurship->product_img = $product_img_path . $product_img_name;
    } else {
      $entrepreneurship->product_img = 'public/images/deafult/default-product-img.png';
    }

    $entrepreneurship->title = $request->title;
    $entrepreneurship->description = $request->description;
    $entrepreneurship->product_img = $request->product_img;
    $entrepreneurship->price = $request->price;
    $entrepreneurship->category_id = $request->category_id;
    // $entrepreneurship->cash_payment = $request->cash_payment;
    // $entrepreneurship->card_payment = $request->card_payment;
    // $entrepreneurship->bizum_payment = $request->bizum_payment;
    // $entrepreneurship->stock = $request->stock;
    $entrepreneurship->availability_state = 1;
    $entrepreneurship->inspection_state = 1;

    if($request->phone == null) {
      $entrepreneurship->phone = $user_phone;
    }
    if($request->email == null) {
      $entrepreneurship->email = $user_email;
    }

    $entrepreneurship->location = $request->location;
    $entrepreneurship->save();

    return response()->json([
      'status' => 'success',
      'message' => 'Entrepreneurship created successfully',
      'entreprenenurship' => $entrepreneurship
    ], 200);
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    // Obtiene el emprendimiento con su categoria, sus comentarios, categoria y el usuario propietário.
    $entrepreneurship = Entrepreneurship::find($id);
    $comments = Comment::all()->where('entrepreneurship_id', '=', $id);
    $user_id = $entrepreneurship->user_id;
    $user = User::find($user_id);
    $category_id = $entrepreneurship->category_id;
    $category = Category::all()->where('id', '=', $category_id);

    return response()->json([
      'status' => 'success',
      'category' => $category,
      'entrepreneurship' => $entrepreneurship,
      'comments' => $comments,
      'user' => $user,
    ], 200);
  }

  /**
   * Update the entrepreneurship that user has it's property.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $entrepreneurship_id)
  {
    $entrepreneurship = Entrepreneurship::find($entrepreneurship_id);
    // $user = Auth::user();

    $request->validate([
      'inspection_state' => 'required|integer|min:1|max:3',
    ]);

    $entrepreneurship = Entrepreneurship::find($entrepreneurship_id);
    $newState = $request->inspection_state;

    $entrepreneurship->inspection_state = $newState;
    $entrepreneurship->save();

    return response()->json([
      'code' => 200,
      'message' => 'Entrepreneurship inspection state updated successfully',
      'entrepreneurship' => $entrepreneurship,
    ]);
  }

  public function update_my(Request $request, $id)
  {
    $entrepreneurship = Entrepreneurship::find($id);

    // Verificar que el emprendimiento existe
    if (!$entrepreneurship) {
      return response()->json([
          'message' => 'Emprendimiento no encontrado'
      ], 404);
    }

    // Verificar que el usuario está autorizado para actualizar el emprendimiento
    if (Auth::user()->id !== $entrepreneurship->user_id) {
      return response()->json([
        'message' => 'Usuario no autorizado para editar este emprendimiento'
      ], 401);
    }

    $request->validate([
      'title' => 'required|unique:entrepreneurships',
      'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
      'product_img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
      'description' => 'required',
      'price' => 'required|numeric',
      'category_id' => 'required|exists:categories,id',
      'cash_payment' => 'required|boolean',
      'card_payment' => 'required|boolean',
      'bizum_payment' => 'required|boolean',
      'stock' => 'required|integer|min:0',
      'availability_state' => 'required|exists:availability_states,id',
      'phone' => 'nullable|string|max:20',
      'email' => 'nullable|email|max:255',
      'location' => 'nullable|max:255',
    ]);

    $entrepreneurship->id = $entrepreneurship->id;
    $entrepreneurship->user_id = $entrepreneurship->user_id;
    $entrepreneurship->title = $request->title;
    if ($request->hasFile('logo')) {
      $logo = $request->file('logo');
      $logo_path = $logo->store('public/images');
      $entrepreneurship->logo = asset(str_replace('public/', 'storage/', $logo_path));
    };

    if ($request->hasFile('product_img')) {
      $product_img = $request->file('product_img');
      $product_img_path = $product_img->store('public/images');
      $entrepreneurship->product_img = asset(str_replace('public/', 'storage/', $product_img_path));
    };
    $entrepreneurship->description = $request->description;
    $entrepreneurship->price = $request->price;
    $entrepreneurship->category_id = $request->category_id;
    $entrepreneurship->avg_score = $entrepreneurship->avg_score;
    $entrepreneurship->cash_payment = $request->cash_payment;
    $entrepreneurship->card_payment = $request->card_payment;
    $entrepreneurship->bizum_payment = $request->bizum_payment;
    $entrepreneurship->stock = $request->stock;
    $entrepreneurship->inspection_state = $entrepreneurship->inspection_state;
    $entrepreneurship->availability_state = $request->availability_state;
    $entrepreneurship->phone = $request->phone;
    $entrepreneurship->email = $request->email;
    $entrepreneurship->location = $request->location;
    $entrepreneurship->update();

    return response()->json([
      'status' => 'success',
      'message' => 'Entrepreneurship updated successfully',
      'entrepreneurship' => $entrepreneurship
    ]);
  }

  public function inspect(Request $request, $id)
  {
    $entrepreneurship = Entrepreneurship::find($id);

    // Verificar que el emprendimiento existe
    if (!$entrepreneurship) {
      return response()->json([
          'message' => 'Emprendimiento no encontrado'
      ], 404);
    }

    $request->validate([
      'inspection_state' => 'required|integer|exists:inspection_states,id|between:1, 3'
    ]);

    $entrepreneurship->inspection_state = $request->inspection_state;
    $entrepreneurship->update();

    return response()->json([
      'status' => 'success',
      'message' => 'Entrepreneurship inspection state updated successfully',
      'entrepreneurship' => $entrepreneurship
    ]);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $entrepreneurship = Entrepreneurship::find($id);

    // Verificar que el emprendimiento existe
    if (!$entrepreneurship) {
      return response()->json([
          'message' => 'Emprendimiento no encontrado'
      ], 404);
    }

    $entrepreneurship->delete();

    return response()->json([
      'status' => 'success',
      'message' => 'Entrepreneurship deleted successfully',
      'entrepreneurship' => $entrepreneurship
    ]);
  }

  public function destroy_my($id)
  {
    $entrepreneurship = Entrepreneurship::find($id);

    // Verificar que el emprendimiento existe
    if (!$entrepreneurship) {
      return response()->json([
          'message' => 'Emprendimiento no encontrado'
      ], 404);
    }

    // Verificar que el usuario está autorizado para borrar el emprendimiento
    if (Auth::user()->id !== $entrepreneurship->user_id) {
      return response()->json([
        'message' => 'No autorizado para borrar este emprendimiento'
      ], 401);
    }

    $entrepreneurship->delete();

    return response()->json([
      'status' => 'success',
      'message' => 'Entrepreneurship deleted successfully',
      'entrepreneurship' => $entrepreneurship
    ]);
  }
}
