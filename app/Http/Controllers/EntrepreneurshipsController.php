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
    public function index(){
      $entrepreneurships = Entrepreneurship::all();

      return response()->json([
        'status'=>'success',
        'entrepreneurships'=>$entrepreneurships,
      ]);

    }

    /**
     * Display an approved state list of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function approvedIndex(){
      // TODO: Obtiene todos los emprendimientos aprovados y todas las categorías.
      $entrepreneurships = Entrepreneurship::all();
      // $category = Category::all();

      return response()->json([
          'code' => 200,
          'status' => 'success',
          'entrepreneurships' => [...$entrepreneurships],
          // 'categories' => $category,
      ]);
    }

    /**
     * Display a pending state list of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pendingIndex(){
      // TODO: Obtiene todos los emprendimientos pendientes de aprovación.
      $entrepreneurships = Entrepreneurship::all()->where('inspection_state', '=', 1);

      return response()->json([
          'status' => 'success',
          'entrepreneurships' => [...$entrepreneurships],
      ]);
    }

    /**
     * Display an available & approved state  list of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function availableIndex(){
      // TODO: Obtiene todos los emprendimientos aprovados y disponibles, y todas las categorías.
      $entrepreneurships = Entrepreneurship::all()->where('inspection_state', '=', 2)->where('availability_state', '=', 2);
      // $category = Category::all();

      return response()->json([
          'status' => 'success',
          'entrepreneurships' => [...$entrepreneurships],
      ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request){

      $request->validate([
        'user_id' => 'required|exists:users,id',
        'title' => 'required|max:255',
        'description' => 'required|max:1000',
        'price' => 'required|numeric|min:0',
        'category_id' => 'required|exists:categories,id',
        'cash_payment' => 'required|boolean',
        'card_payment' => 'required|boolean',
        'bizum_payment' => 'required|boolean',
        'stock' => 'nullable|integer|min:0',
        'availability_state' => 'required|exists:availability_states,id',
        // 'inspection_state' => 'required|exists:inspection_states,id',
        'phone' => 'nullable',
        'email' => 'nullable|email',
        'location' => 'required'
      ]);

      $entrepreneurship = new Entrepreneurship;
      $entrepreneurship->user_id = $request->user_id;
      $entrepreneurship->title = $request->title;
      $entrepreneurship->description = $request->description;
      $entrepreneurship->price = $request->price;
      $entrepreneurship->category_id = $request->category_id;
      $entrepreneurship->cash_payment = $request->cash_payment;
      $entrepreneurship->card_payment = $request->card_payment;
      $entrepreneurship->bizum_payment = $request->bizum_payment;
      $entrepreneurship->stock = $request->stock;
      $entrepreneurship->availability_state = 1;
      $entrepreneurship->inspection_state = 1;
      $entrepreneurship->phone = $request->phone;
      $entrepreneurship->email = $request->email;
      $entrepreneurship->location = $request->location;
      $entrepreneurship->save();

      return response()->json([
        'status' => 'success',
        'message' => 'Entrepreneurship created successfully',
        'entreprenenurship' => $entrepreneurship
      ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
      // Obtiene el emprendimiento con su categoria, sus comentarios y el usuario propietário.
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
      ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
