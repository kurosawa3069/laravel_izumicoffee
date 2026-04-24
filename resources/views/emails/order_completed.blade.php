<p>{{ $order->name }} 様</p>

<p>ご注文内容は以下の通りです。</p>

<hr>

@foreach($order->items as $item)
<p>
    {{ $item->product_name }} × {{ $item->quantity }}<br>
    ¥{{ number_format($item->price) }}
</p>
@endforeach

<hr>

<p>合計：¥{{ number_format($order->total_price) }}</p>

<p>配送先：{{ $order->address }}</p>

<p>またのご利用をお待ちしております。</p>