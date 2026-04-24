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

  <section class="bg-white text-gray-600 body-font">
    <div class="container px-5 py-12 mx-auto">
      <h1 class="text-2xl font-bold mb-8">ショッピングカート</h1>
      @if(session('cart') && count(session('cart')) > 0)
        @php
        $total = 0;
        @endphp
      <div class="flex flex-col gap-6">
        @foreach(session('cart') as $id => $cart)
        @php
        $subtotal = $cart['price'] * $cart['quantity'];
        $total += $subtotal;
        @endphp
        <div class="flex items-center border rounded-lg p-4 bg-white">
          <div class="w-32 h-24 overflow-hidden rounded">
            <img class="object-cover w-full h-full"
              src="{{ $cart['image'] ? asset('storage/product/'.$cart['image']) : asset('images/noimage.png') }}">
          </div>
          <div class="ml-6 flex-1">
            <h2 class="text-lg font-semibold">{{ $cart['name'] }}</h2>
            <p class="text-gray-600">¥{{ number_format($cart['price']) }}</p>
            {{-- <p class="text-sm text-gray-500">数量：{{ $cart['quantity'] }}</p> --}}
            <form action="{{ route('cart.update') }}" method="POST" class="flex items-center gap-2 mt-2">
            @csrf
            <input type="hidden" name="product_id" value="{{ $id }}">
            <select name="quantity" class="border rounded px-2 py-1" onchange="this.form.submit()">
              @for ($i = 1; $i <= 10; $i++)
                <option value="{{ $i }}" {{ $cart['quantity'] == $i ? 'selected' : '' }}>{{ $i }}</option>
              @endfor
            </select>
          </form>
          </div>
          <div class="text-right">
            <p class="font-bold text-lg">¥{{ number_format($cart['price'] * $cart['quantity']) }}</p>
          </div>
          <!-- 削除ボタン -->
          <form action="{{ route('cart.remove') }}" method="POST">
            @csrf
            <input type="hidden" name="product_id" value="{{ $id }}">
            <button class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 text-sm">削除</button>
          </form>
        </div>
        @endforeach
      </div>
      <div class="mt-10 text-right">
          <p class="text-xl font-bold mb-6">合計 ¥{{ number_format($total) }}</p>        
        {{-- <form action="{{ route('cart.confirm') }}" method="POST">
            @csrf
            <button type="submit"
                class="bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700">
                注文確認へ進む
            </button>
        </form> --}}
        <a href="{{ route('cart.confirm') }}" class="bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700">注文確認へ進む</a>
      </div>
      @else
      <p class="text-gray-500">カートに商品が入っていません</p>
      @endif
    </div>
  </section>
</x-layouts.site>