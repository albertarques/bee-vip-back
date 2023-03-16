<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entrepreneurship;
use App\Models\Comment;
use App\Models\User;
use App\Models\Category;
use App\Models\InspectionState;

class EntrepreneurshipsController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('api');
    }

    public function index(){
      $entrepreneurships = Entrepreneurship::all();

      return response()->json([
        'status'=>'success',
        'entrepreneurships'=>$entrepreneurships,
      ]);
    }

    public function approvedIndex()
    {
        // TODO: Obtiene todos los emprendimientos aprovados y todas las categorías.
        $entrepreneurships = Entrepreneurship::all();
        $category = Category::all();

        return response()->json([
            'code' => 200,
            'status' => 'success',
            'entrepreneurships' => [...$entrepreneurships],
            // 'categories' => $category,
        ]);
    }

    public function pendingIndex()
    {
        // TODO: Obtiene todos los emprendimientos pendientes de aprovación.
        $entrepreneurships = Entrepreneurship::all();

        return response()->json([
            'status' => 'success',
            'entrepreneurships' => [...$entrepreneurships],
        ]);
    }

    public function availableIndex()
    {
        // TODO: Obtiene todos los emprendimientos aprovados y disponibles, y todas las categorías.
        $entrepreneurships = Entrepreneurship::all()->where('inspection_state', '=', 2)->where('availability_state', '=', 2);
        // $category = Category::all();

        return response()->json([
            'status' => 'success',
            'entrepreneurships' => [...$entrepreneurships],
        ]);
    }

    public function store(Request $request){
        $request->validate([
          'name' => 'required',
          'title' => 'required',
          'product_img' => 'required|image',
          'description' => 'required',
          'price' => 'required',

            // 'user_id' => 'required|integer|exists:users,id',
            // 'title' => 'required|string|max:255',
            // 'logo' => 'nullable|url',
            // 'product_img' => 'nullable|url',
            // 'description' => 'required|string|max:500',
            // 'price' => 'required'|'numeric|regex:/^\d+(\.\d{1,2})?$/',
            // 'category_id' => 'required|exists:categories,id',
            // 'avg_score' => 'nullable|numeric|regex:/^\d+(\.\d{1,2})?$/',
            // 'cash_payment' => 'required|boolean',
            // 'card_payment' => 'required|boolean',
            // 'bizum_payment' => 'required|boolean',
            // 'stock' => 'required|integer|max:500',
            // 'availability_state' => 'required|integer|exists:availability_states,id|between:1, 2',
            // 'phone' => 'required|string|digits_between:9,15',
            // 'email' => 'required|email',
            // 'location' => 'required|string|max:255',
            // 'inspection_state' => 'required|integer|exists:inspection_states,id|between:1, 3',
        ]);

        // Subida y almacenamiento de la imagen
        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $imagePath = 'images/entrepreneurships/';
        $image->move(public_path($imagePath), $imageName);

        // Creación y almacenamiento del emprendimiento
        $entrepreneurship = new Entrepreneurship();
        $entrepreneurship->name = $request->name;
        $entrepreneurship->title = $request->title;
        $entrepreneurship->user_id = auth()->id();
        $entrepreneurship->image = $imagePath . $imageName;
        $entrepreneurship->description = $request->description;
        $entrepreneurship->price = $request->price;
        $entrepreneurship->save();

        return response()->json($entrepreneurship, 201);
        }

    public function show($id){
        // Obtiene el emprendimiento con su categoria, sus comentarios y el usuario propietário.
        $entrepreneurship = Entrepreneurship::find($id);
        $comments = Comment::all()->where('entrepreneurship_id', '=', $id);
        $user_id = $entrepreneurship->user_id;
        $user = User::all()->where('id', '=', $user_id);
        $category_id = $entrepreneurship->category_id;
        $category = Category::all()->where('id', '=', $category_id);


        return response()->json([
            'status' => 'success',
            'category' => $category,
            'entrepreneurship' => $entrepreneurship,
            'comments' => $comments,
            'user' => $user,
        ]);
    }

    public function update(Request $request, $id){
        $request->validate([

          // 'user_id' => 'required|integer|exists:users,id',
          // 'title' => 'required|string|max:255',
          // 'logo' => 'nullable|url',
          // 'product_img' => 'nullable|url',
          // 'description' => 'required|string|max:500',
          // 'price' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
          // 'category_id' => 'required|exists:categories,id',
          // 'avg_score' => 'nullable|numeric|regex:/^\d+(\.\d{1,2})?$/',
          // 'cash_payment' => 'required|boolean',
          // 'card_payment' => 'required|boolean',
          // 'bizum_payment' => 'required|boolean',
          // 'stock' => 'required|integer|max:500',
          // 'availability_state' => 'required|integer|exists:availability_states,id|between:1, 2',
          // 'phone' => 'required|string|digits_between:9,15',
          // 'email' => 'required|email',
          // 'location' => 'required|string|max:255',
          // 'inspection_state' => 'required|integer|exists:inspection_states,id|between:1, 3',
        ]);

        $entrepreneurship = Entrepreneurship::find($id);
        $entrepreneurship->user_id = $entrepreneurship->user_id;
        $entrepreneurship->title = $request->title;
        $entrepreneurship->logo = $request->logo;
        $entrepreneurship->product_img = $request->product_img;
        $entrepreneurship->description = $request->description;
        $entrepreneurship->price = $request->price;
        $entrepreneurship->category_id = $request->category_id;
        $entrepreneurship->avg_score = $entrepreneurship->avg_score;
        $entrepreneurship->cash_payment = $request->cash_payment;
        $entrepreneurship->card_payment = $request->card_payment;
        $entrepreneurship->bizum_payment = $request->bizum_payment;
        $entrepreneurship->stock = $request->stock;
        $entrepreneurship->availability_state = $request->availability_state;
        $entrepreneurship->phone = $request->phone;
        $entrepreneurship->email = $request->email;
        $entrepreneurship->location = $request->location;
        $entrepreneurship->inspection_state = $entrepreneurship->inspection_state;
        $entrepreneurship->save();

        return response()->json([
            'code' => 200,
            'status' => 'success',
            'message' => 'Entrepreneurship updated successfully',
            'entrepreneurship' => $entrepreneurship,
        ]);
    }

    public function updateInspectionState(Request $request, $id){

      $request->validate([
        'inspection_state' => 'required|integer|min:1|max:3',
      ]);

      $entrepreneurship = Entrepreneurship::find($id);
      $newState = $request->inspection_state;

      $entrepreneurship->inspection_state = $newState;
      $entrepreneurship->save();

      return response()->json([
        'code' => 200,
        'message' => 'Entrepreneurship inspection state updated successfully',
        'entrepreneurship' => $entrepreneurship,
      ]);
    }

    public function destroy($id)
    {
      $entrepreneurship = Entrepreneurship::find($id);
      $entrepreneurship->delete();

      return response()->json([
        'code' => 200,
        'status' => 'success',
        'message' => 'entrepreneurship deleted successfully',
        'entrepreneurship' => $entrepreneurship,
      ]);
    }
}
