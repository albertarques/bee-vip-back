<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderDetailsController extends Controller
{
  public function __construct()
  {
    $this->middleware('api');
  }

  // public function index()
  // {
  //   $orderDetails = OrderDetail::all();
  //   return response()->json([
  //     'status' => 'success',
  //     'orderDetails' => $orderDetails,
  //   ]);
  // }

  public function create(Request $request)
  {

    $order = Order::find($request->order_id);

    // Verificar que el emprendimiento existe
    if (!$order) {
      return response()->json([
          'message' => 'La órden de compra no existe.'
      ], 404);
    }

    // Verificar que el usuario está autorizado para actualizar el emprendimiento
    if (Auth::user()->id !== $order->customer_id) {
      return response()->json([
        'message' => 'Usuario no autorizado para añadir productos.'
      ], 401);
    }

    $request->validate([
      'order_id' => 'required|numeric|exists:orders,id',
      'entrepreneurship_id' => 'required|numeric|exists:entrepreneurships,id',
      'quantity' => 'required|numeric|digits_between:0,10',
    ]);

    $orderDetail = OrderDetail::create([
      'order_id' => $request->order_id,
      'entrepreneurship_id' => $request->entrepreneurship_id,
      'quantity' => $request->quantity,
      'paid' => 1
    ]);

    return response()->json([
      'status' => 'success',
      'message' => 'orderDetail created successfully',
      'orderDetail' => $orderDetail,
    ]);
  }

  // public function show($id)
  // {
  //   $orderDetail = OrderDetail::find($id);
  //   return response()->json([
  //     'status' => 'success',
  //     'orderDetails' => $orderDetail,
  //   ]);
  // }

  // public function update(Request $request, $id)
  // {
  //   $request->validate([
  //     'order_id' => 'required|string|max:255',
  //     'entrepreneurship_id' => 'required|string|max:255',
  //     'quantity' => 'required|string|max:255',
  //     'paid' => 'required|string|max:255',
  //   ]);

  //   $orderDetail = OrderDetail::find($id);
  //   $orderDetail->order_id = $request->order_id;
  //   $orderDetail->entrepreneurship_id = $request->entrepreneurship_id;
  //   $orderDetail->quantity = $request->quantity;
  //   $orderDetail->paid = $request->paid;
  //   $orderDetail->save();

  //   return response()->json([
  //     'status' => 'success',
  //     'message' => 'orderDetail updated successfully',
  //     'orderDetail' => $orderDetail,
  //   ]);
  // }

  // public function destroy($id)
  // {
  //   $orderDetail = OrderDetail::find($id);
  //   $orderDetail->delete();

  //   return response()->json([
  //     'status' => 'success',
  //     'message' => 'orderDetail deleted successfully',
  //     'orderDetail' => $orderDetail,
  //   ]);
  // }
}
