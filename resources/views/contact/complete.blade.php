<x-layouts.site>
  <!-- Hero -->
  <div class="pt-24">
    <div class="container px-3 mx-auto flex flex-wrap flex-col md:flex-row items-center">
      <div class="w-full md:w-3/5 py-6 text-center"></div>
    </div>
  </div>

  <div class="relative -mt-12 lg:-mt-24">
    <svg viewBox="0 0 1428 174" xmlns="http://www.w3.org/2000/svg">
      <g fill="none" fill-rule="evenodd">
        <g transform="translate(-2 44)" fill="#FFFFFF" fill-rule="nonzero">
          <path
            d="M0,0 C90.7,0.9 147.9,27.1 291.9,59.9
               C387.9,81.7 543.6,89.3 759,82.7
               C469.3,156.2 216.3,153.6 0,74.9"
            opacity="0.1"/>
        </g>
      </g>
    </svg>
  </div>

  <section class="bg-white text-gray-600 body-font relative">
    <div class="container px-5 py-24 mx-auto">

      <div class="flex flex-col text-center w-full mb-12">
        <h3 class="text-3xl text-gray-800 font-bold mb-3">
          Contact
        </h3>
        <h3 class="text-xl text-gray-800 font-bold mb-3">
          お問い合わせ完了
        </h3>
        <p class="lg:w-2/3 mx-auto leading-relaxed text-base">
          お問い合わせありがとうございました。
        </p>
      </div>

      {{-- ステップ表示 --}}
      <div class="flex justify-center items-center space-x-4 py-12">
        <div class="bg-gray-100 py-3 px-5 rounded-lg text-sm text-gray-600">
          入力
        </div>
        <i class="fa-solid fa-arrow-right text-gray-400"></i>
        <div class="bg-gray-100 py-3 px-5 rounded-lg text-sm text-gray-600">
          確認
        </div>
        <i class="fa-solid fa-arrow-right text-gray-400"></i>
        <div class="bg-yellow-400 py-3 px-5 rounded-lg text-sm text-gray-700 font-bold">
          完了
        </div>
      </div>

      <div class="lg:w-1/2 md:w-2/3 mx-auto bg-gray-50 border rounded-lg p-8 text-center">
        <p class="mb-6 leading-relaxed">
          内容を正常に送信しました。<br>
          担当者より折り返しご連絡いたしますので、しばらくお待ちください。
        </p>

        <a href="{{ route('contact.create') }}"
           class="inline-block bg-yellow-400 text-gray-700 py-2 px-8 rounded hover:bg-yellow-300 text-sm">
          トップへ戻る
        </a>
      </div>

    </div>
  </section>
</x-layouts.site>