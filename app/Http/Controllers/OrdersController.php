<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrdersController extends Controller
{
  public function __construct()
  {
    $this->middleware('api');
  }

  public function index()
  {
    $orders = Order::all();
    return response()->json([
      'status' => 'success',
      'orders' => $orders,
    ]);
  }

  public function store(Request $request)
  {
    $request->validate([
      'customer_id' => 'required|string|max:255',
    ]);

    $order = Order::create([
      'customer_id' => $request->customer_id,
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
    return response()->json([
      'status' => 'success',
      'orders' => $order,
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
