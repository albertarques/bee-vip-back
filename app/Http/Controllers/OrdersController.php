<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
{
  public function __construct()
  {
    $this->middleware('api');
  }

  public function index()
  {
    $user_id = auth()->user()->id;
    $orders = Order::all()->where('customer_id', '=', $user_id);

    // Verificar que la orden existe
    if (!$orders) {
      return response()->json([
          'message' => 'Usuario sin órdenes de compra'
      ], 404);
    }

    return response()->json([
      'status' => 'success',
      'orders' => [...$orders],
    ]);
  }

  public function create()
  {
    $user_id = auth()->user()->id;

    $order = Order::create([
      'customer_id' => $user_id,
    ]);

    return response()->json([
      'status' => 'success',
      'message' => 'order created successfully',
      'order' => $order,
    ]);
  }

  public function show($id)
  {
    $order = Order::find($id);
    $order_details = OrderDetail::all()->where('order_id', '=', $order->id);

    // Verificar que la orden existe
    if (!$order) {
      return response()->json([
          'message' => 'Usuario sin órdenes de compra.'
      ], 404);
    }

    // Verificar que el usuario está autorizado para ver la orden
    if (Auth::user()->id !== $order->customer_id) {
      return response()->json([
        'message' => 'No autorizado para ver esta órden de compra.'
      ], 401);
    }

    return response()->json([
      'status' => 'success',
      'order' => $order,
      'order details' => [...$order_details]
    ]);
  }

  public function update(Request $request, $id)
  {
    $request->validate([
      'customer_id' => 'required|string|max:255'
    ]);

    $order = Order::find($id);
    $order->customer_id = $request->customer_id;
    $order->save();

    return response()->json([
      'status' => 'success',
      'message' => 'order updated successfully',
      'order' => $order,
    ]);
  }

  public function destroy($id)
  {
    $order = Order::find($id);
    $order->delete();

    return response()->json([
      'status' => 'success',
      'message' => 'order deleted successfully',
      'order' => $order,
    ]);
  }
}
