<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entrepreneurship;
use App\Models\Comment;
use App\Models\User;
use App\Models\Category;


class EntrepreneurshipsController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('api');
    }

    public function indexAproved()
    {
        // Obtiene todos los emprendimientos y todas las categorías.
        $entrepreneurships = Entrepreneurship::all()->where('state', '=', '1');
        $category = Category::all();

        return response()->json([
            'status' => 'success',
            'entrepreneurships' => $entrepreneurships,
            'categories' => $category,
        ]);
    }

    public function indexPending()
    {
        // Obtiene todos los emprendimientos pendientes de aprovación.
        $entrepreneurships = Entrepreneurship::all()->where('state', '=', '0');

        return response()->json([
            'status' => 'success',
            'entrepreneurships' => $entrepreneurships,
        ]);
    }

    public function store(Request $request){
        $request->validate([
            'user_id' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'logo' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'product_img' => 'required|string|max:255',
            'description' => 'required|string|max:500',
            'price' => 'required|float',
            'category_id' => 'required|string|max:255',
            'avg_score' => 'required|float',
            'cash_payment' => 'required|boolean',
            'card_payment' => 'required|boolean',
            'bizum_payment' => 'required|boolean',
            'stock' => 'required|integer|max:500',
            'availability' => 'required|boolean',
            'phone' => 'required|string|digits_between:9,15',
            'email' => 'required|integer|max:255',
            'location' => 'required|integer|max:255',
            'state' => 'required|integer|max:0',
        ]);

        $entrepreneurship = Entrepreneurship::create([
            'user_id' => $request->user_id,
            'title' => $request->title,
            'logo' => $request->logo,
            'product_img' => $request->product_img,
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'avg_score' => $request->avg_score,
            'cash_payment' => $request->cash_payment,
            'card_payment' => $request->card_payment,
            'bizum_payment' => $request->bizum_payment,
            'stock' => $request->stock,
            'availability' => $request->availability,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'location' => $request->location,
            'state' => $request->state,

        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'entrepreneurship created successfully',
            'entrepreneurship' => $entrepreneurship,
        ]);
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
            'user_id' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'logo' => 'nullable|string|max:255',
            'title' => 'required|string|max:255',
            'product_img' => 'nullable|string|max:255',
            'description' => 'required|string|max:500',
            'price' => 'required|float',
            'category_id' => 'required|string|max:255',
            'avg_score' => 'nullable|float',
            'cash_payment' => 'required|boolean',
            'card_payment' => 'required|boolean',
            'bizum_payment' => 'required|boolean',
            'stock' => 'nullable|integer|max:500',
            'available' => 'required|boolean',
            'phone' => 'required|string|digits_between:9,15',
            'email' => 'required|integer|max:255',
            'location' => 'required|integer|max:255',
            'state' => 'required|integer|min:0|max:2'
        ]);

        $entrepreneurship = Entrepreneurship::find($id);
        $entrepreneurship->title = $request->title;
        $entrepreneurship->description = $request->description;
        $entrepreneurship->save();

        return response()->json([
            'status' => 'success',
            'message' => 'entrepreneurship updated successfully',
            'entrepreneurship' => $entrepreneurship,
        ]);
    }

    public function destroy($id)
    {
        $entrepreneurship = Entrepreneurship::find($id);
        $entrepreneurship->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'entrepreneurship deleted successfully',
            'entrepreneurship' => $entrepreneurship,
        ]);
    }
}
