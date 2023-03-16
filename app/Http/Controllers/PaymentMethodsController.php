<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use Illuminate\Support\Facades\Auth;

class PaymentMethodsController extends Controller
{
  public function __construct()
  {
    $this->middleware('api');
  }

  public function index()
  {
    $user_id = auth()->user()->id;
    $payment_methods = PaymentMethod::all()->where("user_id", "=", $user_id);

    return response()->json([
      'status' => 'success',
      'paymentMethods' => [$payment_methods],
    ]);
  }

  public function create(Request $request)
  {
    $user_id = auth()->user()->id;

    $request->validate([
      // 'user_id' => 'required|integer|max:255', // Unnecessary to validate
      'card_name' => 'required|string|max:255',
      'card_number' => 'required|string|max:255',
      'expire_date' => 'required|string|max:255',
      'type' => 'required|string|max:255',
    ]);

    $paymentMethod = PaymentMethod::create([
      'user_id' => $user_id,
      'card_name' => $request->card_name,
      'card_number' => $request->card_number,
      'expire_date' => $request->expire_date,
      'type' => $request->type,
    ]);

    return response()->json([
      'code' => 200,
      'status' => 'success',
      'message' => 'paymentMethod created successfully',
      'paymentMethod' => $paymentMethod,
    ]);
  }

  public function show($id)
  {
    $payment_method = PaymentMethod::find($id);

    // Verificar que el usuario tiene métodos de pago
    if (!$payment_method) {
      return response()->json([
          'message' => 'This user dont have payment methods'
      ], 404);
    }

    // Verificar que el usuario está autorizado para borrar método de pago
    if (Auth::user()->id !== $payment_method->user_id) {
      return response()->json([
        'message' => 'Authorisation required to delete payment methods'
      ], 401);
    }

    return response()->json([
      'status' => 'success',
      'paymentMethods' => $payment_method
    ]);
  }

  public function update(Request $request, $id)
  {
    $payment_method = PaymentMethod::find($id);

    // Verificar que el usuario tiene métodos de pago
    if (!$payment_method) {
      return response()->json([
          'message' => 'This user dont have payment methods'
      ], 404);
    }

    // Verificar que el usuario está autorizado para aactualizar el método de pago
    if (Auth::user()->id !== $payment_method->user_id) {
      return response()->json([
        'message' => 'Authorisation required to update payment method'
      ], 401);
    }

    $request->validate([
      'card_name' => 'required|string|max:255',
      'card_number' => 'required|string|max:255',
      'expire_date' => 'required|string|max:255',
      'type' => 'required|string|max:255',
    ]);

    $paymentMethod = PaymentMethod::find($id);
    $paymentMethod->user_id === $payment_method->user_id;
    $paymentMethod->card_name = $request->card_name;
    $paymentMethod->card_number = $request->card_number;
    $paymentMethod->expire_date = $request->expire_date;
    $paymentMethod->type = $request->type;
    $paymentMethod->save();

    return response()->json([
      'status' => 'success',
      'message' => 'Payment method updated successfully',
      'paymentMethod' => $paymentMethod,
    ]);
  }

  public function destroy($id)
  {
    $payment_method = PaymentMethod::find($id);

    // Verificar que el usuario tiene métodos de pago
    if (!$payment_method) {
      return response()->json([
          'message' => 'This user dont have payment methods'
      ], 404);
    }

    // Verificar que el usuario está autorizado para borrar método de pago
    if (Auth::user()->id !== $payment_method->user_id) {
      return response()->json([
        'message' => 'Authorisation required to delete payment methods'
      ], 401);
    }

    $payment_method->delete();

    return response()->json([
      'status' => 'success',
      'message' => 'Payment method deleted successfully',
      'user' => $payment_method,
    ]);
  }
}
