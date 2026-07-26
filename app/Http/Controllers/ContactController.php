<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;

class ContactController extends Controller
{
    public function create()
    {
        return view('contact.create');
    }

    public function confirm(Request $request)
    {
        $validated = $request->validate([
            'contact_type'      => 'required|string',
            'name'              => 'nullable|string|max:255',
            'last_name'         => 'required|string|max:255',
            'first_name'        => 'required|string|max:255',
            'last_name_kana'    => 'required|string|max:255',
            'first_name_kana'   => 'required|string|max:255',
            'email'             => 'required|email|max:255',
            'message'           => 'required|string|max:1000',
        ]);

        // 種別ラベル生成
        $labels = [
            'product' => '商品について',
            'order'   => '取引・卸販売について',
            'oem'     => 'OEM（オリジナル製造）について',
            'other'   => 'その他',
        ];

        $validated['contact_type_label'] =
            $labels[$validated['contact_type']] ?? '';

        return view('contact.confirm', [
            'inputs' => $validated,
        ]);
    }

    public function store(Request $request)
    {
        // confirm を経由しない POST 対策（再バリデーション）
        $validated = $request->validate([
            'contact_type'      => 'required|string',
            'name'              => 'nullable|string|max:255',
            'last_name'         => 'required|string|max:255',
            'first_name'        => 'required|string|max:255',
            'last_name_kana'    => 'required|string|max:255',
            'first_name_kana'   => 'required|string|max:255',
            'email'             => 'required|email|max:255',
            'message'           => 'required|string|max:1000',
        ]);

        $contact = Contact::create($validated);

        Mail::to('nagomachicoffeeroaster@gmail.com')
            ->send(new ContactMail($contact));

        return view('contact.complete');
    }
}