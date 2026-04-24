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

{{-- <section class="bg-white pb-12">
  <div class="container mx-auto px-8">
    <div class="w-full sm:w-1/2 p-6 mt-6">
      <h3 class="text-3xl text-gray-800 font-bold mb-1"></h3>
      <h4 class="text-lg text-gray-700 font-bold">オンラインショップ</h4>
    </div> --}}

<section class="bg-white pb-12">
  <div class="container mx-auto flex flex-wrap">
    <div class="w-full sm:w-1/2 p-6 mt-6 pr-8 pl-16">
        <div class="align-middle">
          <h3 class="text-3xl text-gray-800 font-bold leading-none mb-3">
            Online Shop
          </h3>
            <h3 class="text-1xl text-gray-800 font-bold leading-none mb-3">
            オンラインショップ
          </h3>
        </div>
    </div>
    <div class="container px-5 mx-auto">
      <div class="flex flex-wrap sm:-m-4 -mx-4 -mb-10 -mt-4 pr-8 pl-8">
        {{-- 商品一覧 --}}
        <div class="flex flex-wrap -mx-4 mt-8">
          @foreach ($products as $product)
            <div class="p-4 md:w-1/3 sm:w-1/2 w-full mb-6">
              <div class="relative rounded-lg overflow-hidden bg-white">
                {{-- NEW / SOLD OUT --}}
                @if($product->is_sold_out)
                  <span class="absolute top-2 left-2 bg-gray-700 text-white text-xs px-2 py-1 rounded z-10">
                    SOLD OUT
                  </span>
                @elseif($product->is_new)
                  <span class="absolute top-2 left-2 bg-red-500 text-white text-xs px-2 py-1 rounded z-10">
                    NEW
                  </span>
                @endif
                {{-- 商品画像 --}}
                <div class="h-64 overflow-hidden">
                   @if ($product->image)
                  <img src="{{ asset('storage/product/' . $product->image) }}" alt="{{ $product->name }}" class="object-cover object-center h-full w-full">
                  {{-- <img src="{{ $product->image }}" alt="{{ $product->name }}" class="object-cover object-center h-full w-full"> --}}
                  @else
                  <img src="{{ asset('images/noimage.png') }}" alt="{{ $product->name }}" class="object-cover object-center h-full w-full">
                  @endif
                </div>
                <div class="mt-4">
                  {{-- 商品名 --}}
                  <h2 class="text-xl font-medium text-gray-900">{{ $product->name }}</h2>

                  {{-- 説明 --}}
                  <p class="text-gray-500 text-base leading-relaxed mt-2">
                    {{ \Illuminate\Support\Str::limit($product->description, 20, '…') }}
                  </p>
                  {{-- 価格 --}}
                  <p class="mt-3 text-lg font-bold text-gray-800">
                    ¥{{ number_format($product->price) }}
                    <span class="text-sm font-normal">(税込)</span>
                  </p>
                  {{-- ボタン --}}
                  <div class="mt-4">
                    @if($product->is_sold_out)
                      <span class="inline-block bg-gray-300 text-gray-500 px-6 py-2 rounded-full text-sm cursor-not-allowed">
                        売り切れ
                      </span>
                    @else
                      <a href="{{ route('products.show', $product->id) }}" class="inline-block bg-yellow-500 text-gray-700 font-bold px-6 py-2 rounded-full hover:bg-yellow-400 text-sm">
                        詳しく見る
                      </a>
                    @endif
                  </div>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div> 
  </div>
</section>
<div class="bg-white flex justify-end pr-20 pb-12">
    {{-- {{ $informations->links() }} --}}
</div>

</x-layouts.site>
