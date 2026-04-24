<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;

class AdminContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::latest()->paginate(20);
        return view('admin.contact.index', compact('contacts'));
    }

    public function show(int $id)
    {
        // 存在しないIDの場合は 404
        $contact = Contact::findOrFail($id);

        // contact_type のラベル変換（confirm と同一ロジック）
        $labels = [
            'product' => '商品について',
            'service' => 'サービスについて',
            'other'   => 'その他',
        ];

        $contact->contact_type_label =
            $labels[$contact->contact_type] ?? $contact->contact_type;

        return view('admin.contact.show', compact('contact'));
    }
}
