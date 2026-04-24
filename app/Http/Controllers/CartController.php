<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    public function index()
    {
        // セッションからカート取得（存在しない場合は空配列）
        $cart = session()->get('cart', []);
        // 合計金額計算
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return view('cart.index', compact('cart', 'total'));
    }

    public function add(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        $cart = session()->get('cart', []);
        if(isset($cart[$product->id])){
            $cart[$product->id]['quantity'] += $request->quantity;
        } else {
            $cart[$product->id] = [
                "name" => $product->name,
                "price" => $product->price,
                "image" => $product->image,
                "quantity" => $request->quantity
            ];
        }
        session()->put('cart', $cart);
        return redirect()->route('cart.index');
    }

    public function remove(Request $request)
    {
        $cart = session()->get('cart', []);
        if(isset($cart[$request->product_id])){
            unset($cart[$request->product_id]);
            session()->put('cart', $cart);
        }
        return redirect()->route('cart.index');
    }

    public function update(Request $request)
    {
        $id = $request->product_id;
        $quantity = $request->quantity;
        $cart = session()->get('cart');
        if(isset($cart[$id])) {
            $cart[$id]['quantity'] = $quantity;
            session()->put('cart', $cart);
        }
        return redirect()->route('cart.index');
    }

    public function confirm()
    {
        // セッションからカート取得
        $cart = session()->get('cart', []);
        // 合計計算
        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }
        // 送料（3500円以上で無料）
        $shipping = ($subtotal >= 3500) ? 0 : 420;
        // 合計金額
        $total = $subtotal + $shipping;
        return view('cart.confirm', compact('cart', 'subtotal', 'shipping', 'total'));
    }
}

