<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
        public function index()
    {
        // 新しい順で取得
        $orders = Order::orderBy('created_at', 'desc')->get();
        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        // 注文に紐づく商品を取得
        $items = $order->items;
        return view('admin.orders.show', compact('order', 'items'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $order->update([
            'status' => $request->status
        ]);
        return back()->with('success', 'ステータスを更新しました');
    }
}
