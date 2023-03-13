<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;
use Illuminate\Http\Request;

class OrderDetailsController extends Controller
{
  public function __construct()
  {
    $this->middleware('api');
  }

  public function index()
  {
    $orderDetails = OrderDetail::all();
    return response()->json([
      'status' => 'success',
      'orderDetails' => $orderDetails,
    ]);
  }

  public function store(Request $request)
  {
    $request->validate([
      'order_id' => 'required|string|max:255',
      'entrepreneurship_id' => 'required|string|max:255',
      'quantity' => 'required|string|max:255',
      'paid' => 'required|string|max:255',
    ]);

    $orderDetail = OrderDetail::create([
      'order_id' => $request->order_id,
      'entrepreneurship_id' => $request->entrepreneurship_id,
      'quantity' => $request->quantity,
      'paid' => $request->paid,

    ]);

    return response()->json([
      'status' => 'success',
      'message' => 'orderDetail created successfully',
      'orderDetail' => $orderDetail,
    ]);
  }

  public function show($id)
  {
    $orderDetail = OrderDetail::find($id);
    return response()->json([
      'status' => 'success',
      'orderDetails' => $orderDetail,
    ]);
  }

  public function update(Request $request, $id)
  {
    $request->validate([
      'order_id' => 'required|string|max:255',
      'entrepreneurship_id' => 'required|string|max:255',
      'quantity' => 'required|string|max:255',
      'paid' => 'required|string|max:255',
    ]);

    $orderDetail = OrderDetail::find($id);
    $orderDetail->order_id = $request->order_id;
    $orderDetail->entrepreneurship_id = $request->entrepreneurship_id;
    $orderDetail->quantity = $request->quantity;
    $orderDetail->paid = $request->paid;
    $orderDetail->save();

    return response()->json([
      'status' => 'success',
      'message' => 'orderDetail updated successfully',
      'orderDetail' => $orderDetail,
    ]);
  }

  public function destroy($id)
  {
    $orderDetail = OrderDetail::find($id);
    $orderDetail->delete();

    return response()->json([
      'status' => 'success',
      'message' => 'orderDetail deleted successfully',
      'orderDetail' => $orderDetail,
    ]);
  }
}
