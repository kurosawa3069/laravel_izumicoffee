<x-layouts.site>
      <!--Hero-->
  <div class="pt-24">
    <div class="container px-3 mx-auto flex flex-wrap flex-col md:flex-row items-center">
      <!--Right Col-->
      <div class="w-full md:w-3/5 py-6 text-center">
      </div>
    </div>
  </div>

  <div class="relative -mt-12 lg:-mt-24">
    <svg viewBox="0 0 1428 174" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
      <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <g transform="translate(-2.000000, 44.000000)" fill="#FFFFFF" fill-rule="nonzero">
          <path d="M0,0 C90.7283404,0.927527913 147.912752,27.187927 291.910178,59.9119003 C387.908462,81.7278826 543.605069,89.334785 759,82.7326078 C469.336065,156.254352 216.336065,153.6679 0,74.9732496" opacity="0.100000001"></path>
          <path
            d="M100,104.708498 C277.413333,72.2345949 426.147877,52.5246657 546.203633,45.5787101 C666.259389,38.6327546 810.524845,41.7979068 979,55.0741668 C931.069965,56.122511 810.303266,74.8455141 616.699903,111.243176 C423.096539,147.640838 250.863238,145.462612 100,104.708498 Z"
            opacity="0.100000001"
          ></path>
          <path d="M1046,51.6521276 C1130.83045,29.328812 1279.08318,17.607883 1439,40.1656806 L1439,120 C1271.17211,77.9435312 1140.17211,55.1609071 1046,51.6521276 Z" id="Path-4" opacity="0.200000003"></path>
        </g>
        <g transform="translate(-4.000000, 76.000000)" fill="#FFFFFF" fill-rule="nonzero">
          <path
            d="M0.457,34.035 C57.086,53.198 98.208,65.809 123.822,71.865 C181.454,85.495 234.295,90.29 272.033,93.459 C311.355,96.759 396.635,95.801 461.025,91.663 C486.76,90.01 518.727,86.372 556.926,80.752 C595.747,74.596 622.372,70.008 636.799,66.991 C663.913,61.324 712.501,49.503 727.605,46.128 C780.47,34.317 818.839,22.532 856.324,15.904 C922.689,4.169 955.676,2.522 1011.185,0.432 C1060.705,1.477 1097.39,3.129 1121.236,5.387 C1161.703,9.219 1208.621,17.821 1235.4,22.304 C1285.855,30.748 1354.351,47.432 1440.886,72.354 L1441.191,104.352 L1.121,104.031 L0.457,34.035 Z"
          ></path>
        </g>
      </g>
    </svg>
  </div>

  {{-- <div class="bg-white max-w-4xl mx-auto px-4 py-8 text-gray-600"> --}}
<section class="bg-white text-gray-600 body-font">
  <div class="container px-5 py-12 mx-auto">

      <h1 class="text-2xl font-bold mb-6">注文確認</h1>

      @php
          $cart = session('cart', []);
          $subtotal = 0;
      @endphp

      {{-- カートが空の場合 --}}
      @if(empty($cart))
          <p class="text-gray-600">カートに商品がありません。</p>
          <a href="{{ route('products.index') }}" class="text-blue-500 underline">
              商品一覧へ戻る
          </a>
      @else

      {{-- 商品一覧 --}}商品</h2>

          @foreach($cart as $item)
              @php
                  $itemTotal = $item['price'] * $item['quantity'];
                  $subtotal += $itemTotal;
              @endphp

              <div class="flex items-center border-b py-4">
                  {{-- <img src="{{ asset('storage/' . $item['image']) }}"
                      class="w-20 h-20 object-cover rounded mr-4"> --}}
                      <img src="{{ $item['image']  ? asset('storage/product/' . $item['image'])  : asset('images/noimage.png') }}" class="w-20 h-20 object-cover rounded mr-4">

                  <div class="flex-1">
                      <p class="font-semibold">{{ $item['name'] }}</p>
                      <p class="text-sm text-gray-500">
                          ¥{{ number_format($item['price']) }} × {{ $item['quantity'] }}
                      </p>
                  </div>

                  <div class="font-bold">
                      ¥{{ number_format($itemTotal) }}
                  </div>
              </div>
          @endforeach

          @php
              // 送料ロジック
              $shipping = ($subtotal >= 3500) ? 0 : 420;
              $totalPrice = $subtotal + $shipping;
          @endphp

          {{-- 合計 --}}
          <div class="mt-6 text-right space-y-2">
              <p>小計：¥{{ number_format($subtotal) }}</p>
              <p>
                  送料：
                  @if($shipping === 0)
                      <span class="text-green-600 font-semibold">無料</span>
                  @else
                      ¥{{ number_format($shipping) }}
                  @endif
              </p>
              <p class="text-xl font-bold">
                  合計：¥{{ number_format($totalPrice) }}
              </p>
          </div>
      </div>

      {{-- 購入者情報入力 --}}
      {{-- <form action="{{ route('checkout.index') }}" method="POST" --}}
          {{-- <form action="" method="POST" class="bg-white text-gray-600 shadow rounded-lg p-6"> --}}
        <form action="{{ route('checkout.index') }}" method="POST">
        @csrf
          {{-- @csrf --}}
          <h2 class="text-lg font-semibold mb-4">お届け先情報</h2>
          {{-- 名前 --}}
          <div class="mb-4">
              <label class="block mb-1">お名前</label>
              <input type="text" name="name" class="w-full border rounded px-3 py-2" required>
          </div>
          {{-- メール --}}
          <div class="mb-4">
              <label class="block mb-1">メールアドレス</label>
              <input type="email" name="email" class="w-full border rounded px-3 py-2" required>
          </div>
            {{-- 電話番号 --}}  
            <div class="mb-4">
                <label class="block mb-1">電話番号</label>
                <input type="text" name="phone" class="w-full border rounded px-3 py-2">
            </div>
          {{-- 住所 --}}
          <div class="mb-4">
              <label class="block mb-1">住所</label>
              <input type="text" name="address"class="w-full border rounded px-3 py-2" required>
          </div>
          {{-- hidden --}}
          <input type="hidden" name="total_price" value="{{ $totalPrice }}">
          <div class="flex justify-between items-center mt-6">
              <a href="{{ route('cart.index') }}" class="text-gray-500 underline">カートに戻る</a>
              <button type="submit" class="bg-black text-white px-6 py-2 rounded hover:bg-gray-800">決済へ進む</button>
          </div>
      </form>
      @endif
  </div>
</section>
</x-layouts.site>
