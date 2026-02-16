<x-layouts.site>
  <!-- Hero -->
  <div class="pt-24"></div>

  <section class="bg-white text-gray-600 body-font relative">
    <div class="container px-5 py-24 mx-auto">

      <div class="flex flex-col text-center w-full mb-12">
        <h3 class="text-3xl text-gray-800 font-bold mb-2">Contact</h3>
        <h3 class="text-lg text-gray-800 font-bold mb-4">お問い合わせ</h3>
        <p class="lg:w-2/3 mx-auto leading-relaxed text-base">
          入力内容をご確認のうえ、問題なければ送信してください。
        </p>
      </div>

      {{-- ステップ --}}
      <div class="flex justify-center items-center space-x-4 py-10">
        <button class="bg-gray-100 py-3 px-5 rounded-lg text-sm">入力</button>
        <i class="fa-solid fa-arrow-right text-gray-400"></i>
        <button class="bg-yellow-400 py-3 px-5 rounded-lg text-sm">確認</button>
        <i class="fa-solid fa-arrow-right text-gray-400"></i>
        <button class="bg-gray-100 py-3 px-5 rounded-lg text-sm">完了</button>
      </div>

      <div class="lg:w-1/2 md:w-2/3 mx-auto">
        <form method="POST" action="{{ route('contact.complete') }}">
          @csrf

          <div class="flex flex-wrap -m-2">

            {{-- お問い合わせ種別 --}}
            <div class="p-2 w-full">
              <p class="text-sm mb-1">お問い合わせの種類</p>
              <div class="bg-gray-100 border rounded px-3 py-2">
                {{ $inputs['contact_type_label'] }}
              </div>
              <input type="hidden" name="contact_type" value="{{ $inputs['contact_type'] }}">
            </div>

            {{-- 会社名 --}}
            <div class="p-2 w-full">
              <p class="text-sm mb-1">会社名</p>
              <div class="bg-gray-100 border rounded px-3 py-2">
                {{ $inputs['name'] ?: '―' }}
              </div>
              <input type="hidden" name="name" value="{{ e($inputs['name']) }}">
            </div>

            {{-- 氏名 --}}
            <div class="p-2 w-1/2">
              <p class="text-sm mb-1">お名前（姓）</p>
              <div class="bg-gray-100 border rounded px-3 py-2">
                {{ $inputs['last_name'] }}
              </div>
              <input type="hidden" name="last_name" value="{{ e($inputs['last_name']) }}">
            </div>

            <div class="p-2 w-1/2">
              <p class="text-sm mb-1">（名）</p>
              <div class="bg-gray-100 border rounded px-3 py-2">
                {{ $inputs['first_name'] }}
              </div>
              <input type="hidden" name="first_name" value="{{ e($inputs['first_name']) }}">
            </div>

            {{-- フリガナ --}}
            <div class="p-2 w-1/2">
              <p class="text-sm mb-1">フリガナ（セイ）</p>
              <div class="bg-gray-100 border rounded px-3 py-2">
                {{ $inputs['last_name_kana'] }}
              </div>
              <input type="hidden" name="last_name_kana" value="{{ e($inputs['last_name_kana']) }}">
            </div>

            <div class="p-2 w-1/2">
              <p class="text-sm mb-1">（メイ）</p>
              <div class="bg-gray-100 border rounded px-3 py-2">
                {{ $inputs['first_name_kana'] }}
              </div>
              <input type="hidden" name="first_name_kana" value="{{ e($inputs['first_name_kana']) }}">
            </div>

            {{-- メール --}}
            <div class="p-2 w-full">
              <p class="text-sm mb-1">メールアドレス</p>
              <div class="bg-gray-100 border rounded px-3 py-2">
                {{ $inputs['email'] }}
              </div>
              <input type="hidden" name="email" value="{{ e($inputs['email']) }}">
            </div>

            {{-- 内容 --}}
            <div class="p-2 w-full">
              <p class="text-sm mb-1">お問い合わせ内容</p>
              <div class="bg-gray-100 border rounded px-3 py-3 whitespace-pre-wrap">
                {{ $inputs['message'] }}
              </div>
              <input type="hidden" name="message" value="{{ e($inputs['message']) }}">
            </div>

            {{-- ボタン --}}
            <div class="p-2 w-full flex justify-between items-center">
              <button type="button"
                onclick="history.back()"
                class="text-sm underline text-gray-600">
                入力画面に戻る
              </button>

              <button type="submit"
                class="bg-yellow-400 hover:bg-yellow-300 py-2 px-8 rounded text-sm">
                送信する
              </button>
            </div>

          </div>
        </form>
      </div>
    </div>
  </section>
</x-layouts.site>