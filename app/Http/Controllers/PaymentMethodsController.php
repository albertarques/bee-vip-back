<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaymentMethod;

class PaymentMethodsController extends Controller
{
    public function __construct()
    {
        $this->middleware('api');
    }

    public function index()
    {
        $paymentMethods = PaymentMethod::all();
        return response()->json([
            'status' => 'success',
            'paymentMethods' => $paymentMethods,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|bigInteger|max:255',
            'card_name' => 'required|string|max:255',
            'card_number' => 'required|string|max:255',
            'expire_date' => 'required|string|max:255',
            'type' => 'required|string|max:255',
        ]);

        $paymentMethod = PaymentMethod::create([
            'user_id' => $request->user_id,
            'card_name' => $request->card_name,
            'card_number' => $request->card_number,
            'expire_date' => $request->expire_date,
            'type' => $request->type,
        ]);

        return response()->json([
            'code'=> 200,
            'status' => 'success',
            'message' => 'paymentMethod created successfully',
            'paymentMethod' => $paymentMethod,
        ]);
    }

    public function show($id)
    {
        $paymentMethod = PaymentMethod::find($id);
        return response()->json([
            'status' => 'success',
            'paymentMethods' => $paymentMethod,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|bigInteger|max:255',
            'card_name' => 'required|string|max:255',
            'card_number' => 'required|string|max:255',
            'expire_date' => 'required|string|max:255',
            'type' => 'required|string|max:255',
        ]);

        $paymentMethod = PaymentMethod::find($id);
        $paymentMethod->user_id = $request->user_id;
        $paymentMethod->card_name = $request->card_name;
        $paymentMethod->card_number = $request->card_number;
        $paymentMethod->expire_date = $request->expire_date;
        $paymentMethod->type = $request->type;
        $paymentMethod->save();

        return response()->json([
            'status' => 'success',
            'message' => 'paymentMethod updated successfully',
            'paymentMethod' => $paymentMethod,
        ]);
    }

    public function destroy($id)
    {
        $paymentMethod = PaymentMethod::find($id);
        $paymentMethod->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'paymentMethod deleted successfully',
            'paymentMethod' => $paymentMethod,
        ]);
    }

}
