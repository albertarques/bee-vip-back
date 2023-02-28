<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entrepreneurship;

class EntrepreneurshipsController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('api');
    }

    public function index()
    {
        $entrepreneurships = Entrepreneurship::all();
        return response()->json([
            'status' => 'success',
            'entrepreneurships' => $entrepreneurships,
        ]);
    }

    public function store(Request $request)
    {
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
            'stock' => 'required|integer|max:3',
            'availability' => 'required|boolean',
            'phone' => 'required|integer|max:15',
            'email' => 'required|integer|max:255',
            'location' => 'required|integer|max:255',
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
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'entrepreneurship created successfully',
            'entrepreneurship' => $entrepreneurship,
        ]);
    }

    public function show($id)
    {
        $entrepreneurship = Entrepreneurship::find($id);
        return response()->json([
            'status' => 'success',
            'entrepreneurships' => $entrepreneurship,
        ]);
    }

    public function update(Request $request, $id)
    {
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
            'stock' => 'required|integer|max:3',
            'availability' => 'required|boolean',
            'phone' => 'required|integer|max:15',
            'email' => 'required|integer|max:255',
            'location' => 'required|integer|max:255',
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
