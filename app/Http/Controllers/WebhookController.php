<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Webhook;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Log;

class WebhookController extends Controller
{
    public function handle(Request $request)
    {
        Log::info('Webhook到達');

        $endpoint_secret = env('STRIPE_WEBHOOK_SECRET');

        $payload = $request->getContent();
        $sig_header = $request->header('Stripe-Signature');

        try {
            $event = Webhook::constructEvent(
                $payload,
                $sig_header,
                $endpoint_secret
            );
        } catch (\Exception $e) {
            Log::error('Webhook Error: ' . $e->getMessage());
            return response()->json(['error' => 'Invalid signature'], 400);
        }

        // 🎯 決済完了イベント
        if ($event->type === 'checkout.session.completed') {

            $session = $event->data->object;

            // ✅ 重複チェック（ここが追加ポイント）
            $exists = Order::where('stripe_session_id', $session->id)->first();

            if ($exists) {
                Log::info('既に処理済み: ' . $session->id);
                return response()->json(['status' => 'already processed']);
            }

            // metadata取得
            $cart = json_decode($session->metadata->cart, true);
            $customer = json_decode($session->metadata->customer, true);

            // 注文作成
            $order = Order::create([
                'name' => $customer['name'],
                'email' => $customer['email'],
                'address' => $customer['address'],
                'phone' => $customer['phone'],
                'total_price' => $session->amount_total,
                'stripe_session_id' => $session->id, // ←重要（追加）
                'status' => 'pending'
            ]);

            // 商品保存
            foreach ($cart as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_name' => $item['name'],
                    'price' => $item['price'],
                    'quantity' => $item['quantity'],
                ]);
            }

            Log::info('Order saved via webhook: ' . $order->id);
        }

        return response()->json(['status' => 'success']);
    }
}