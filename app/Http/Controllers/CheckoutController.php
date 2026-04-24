<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderCompletedMail;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        session([
            'customer' => [
                'name' => $request->name,
                'email' => $request->email,
                'address' => $request->address,
                'phone' => $request->phone,
            ]
        ]);

        // カート取得
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'カートが空です');
        }

        // 合計金額再計算（重要）
        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        // 送料
        $shipping = ($subtotal >= 3500) ? 0 : 420;

        $total = $subtotal + $shipping;

        // Stripe設定
        Stripe::setApiKey(config('services.stripe.secret'));

        // 商品データ作成
        $line_items = [];

        foreach ($cart as $item) {
            $line_items[] = [
                'price_data' => [
                    'currency' => 'jpy',
                    'product_data' => [
                        'name' => $item['name'],
                    ],
                    'unit_amount' => $item['price'],
                ],
                'quantity' => $item['quantity'],
            ];
        }

        // 送料を追加（0円でなければ）
        if ($shipping > 0) {
            $line_items[] = [
                'price_data' => [
                    'currency' => 'jpy',
                    'product_data' => [
                        'name' => '送料',
                    ],
                    'unit_amount' => $shipping,
                ],
                'quantity' => 1,
            ];
        }

        // Stripeセッション作成
        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => $line_items,
            'mode' => 'payment',
            'success_url' => route('checkout.complete') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('cart.index'),
            
            'metadata' => [
            'cart' => json_encode(session('cart')),
            'customer' => json_encode([
                'name' => $request->name,
                'email' => $request->email,
                'address' => $request->address,
                'phone' => $request->phone,
                ])
            ],
        ]);

        return redirect($session->url);
    }

    public function complete(Request $request)
   {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('products.index');
        }

        // 合計金額計算
        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        $shipping = ($subtotal >= 3500) ? 0 : 420;
        $total = $subtotal + $shipping;

        // 注文作成
        $order = Order::create([
            'name' => session('customer.name'),
            'email' => session('customer.email'),
            'address' => session('customer.address'),
            'phone' => session('customer.phone'),
            'total_price' => $total,
            'stripe_session_id' => $request->session_id,
        ]);

        Mail::to($order->email)->send(new OrderCompletedMail($order));


        // 明細作成
        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_name' => $item['name'],
                'price' => $item['price'],
                'quantity' => $item['quantity'],
            ]);
        }

        // カート削除
        session()->forget('cart');
        session()->forget('customer');
        return view('checkout.complete', compact('order'));

    }
}
