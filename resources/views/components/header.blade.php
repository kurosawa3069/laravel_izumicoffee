@php
$cartCount = collect(session('cart'))->sum('quantity');
@endphp

<!--Nav-->
    <nav id="header" class="fixed w-full z-30 top-0 text-white">
      <div class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 py-2">
        <div class="pl-4 flex items-center">
          <a class="toggleColour text-white no-underline hover:no-underline font-bold text-2xl lg:text-4xl" href="#">
            <img class="w-64" src="/images/logo.png" alt="logo" />
          </a>
        </div>
        <div class="block lg:hidden pr-4">
          <button id="nav-toggle" class="flex items-center p-1 text-pink-800 hover:text-gray-900 focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out">
            <svg class="fill-current h-6 w-6" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
              <title>Menu</title>
              <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z" />
            </svg>
          </button>
        </div>
        <div class="w-full flex-grow lg:flex lg:items-center lg:w-auto hidden mt-2 lg:mt-0 bg-white lg:bg-transparent text-black p-4 lg:p-0 z-20" id="nav-content">
          <ul class="list-reset lg:flex justify-end flex-1 items-center">
            <li class="mr-3">
              <a class="inline-block text-black no-underline hover:text-gray-800 hover:text-underline py-2 px-4" href="{{ route('information.index') }}">お知らせ</a>
            </li>
            <li class="mr-3">
              <a class="inline-block text-black no-underline hover:text-gray-800 hover:text-underline py-2 px-4" href="{{ route('products.list') }}">商品一覧</a>
            </li>
            {{-- <li class="mr-3">
              <a class="inline-block text-black no-underline hover:text-gray-800 hover:text-underline py-2 px-4" href="{{ route('oem') }}">OM（オリジナル製造）</a>
            </li> --}}
            {{-- <li class="mr-3">
              <a class="inline-block text-black no-underline hover:text-gray-800 hover:text-underline py-2 px-4" href="{{ route('company') }}">会社情報</a>
            </li> --}}
            <li class="mr-3">
              <a class="inline-block text-black no-underline hover:text-gray-800 hover:text-underline py-2 px-4" href="{{ route('products.index') }}">オンラインショップ</a>
            </li>
            <!-- カート -->
            <li class="mr-6 relative">
              <a href="{{ route('cart.index') }}" class="flex items-center">
                <!-- カートアイコン -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-gray-800" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2 6h12m-6-6v6m-4 0h8"/>
                </svg>
                <!-- 赤丸バッジ -->
                @if($cartCount > 0)
                <span class="absolute -top-2 -right-3 bg-red-500 text-white text-xs font-bold rounded-full px-2 py-0.5 leading-none">
                  {{ $cartCount }}
                </span>
                @endif
              </a>
            </li>
          </ul>
          <a id="navAction" href="{{ route('contact.create') }}" class="mx-auto lg:mx-0 hover:underline bg-white text-gray-800 font-bold rounded-full mt-4 lg:mt-0 py-4 px-8 shadow opacity-75 focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out">お問い合わせ</a>
        </div>
      </div>
      <hr class="border-b border-gray-100 opacity-25 my-0 py-0" />
    </nav>