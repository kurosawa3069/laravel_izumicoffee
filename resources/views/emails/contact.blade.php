<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
</head>
<body>

<h2>ホームページからお問い合わせがありました</h2>

@php
    $labels = [
        'product' => '商品について',
        'order'   => '取引・卸販売について',
        'oem'     => 'OEM（オリジナル製造）について',
        'other'   => 'その他',
    ];
@endphp

<p><strong>お問い合わせ種別</strong></p>
<p>{{ $labels[$contact->contact_type] ?? $contact->contact_type }}</p>

@if(!empty($contact->name))
<p><strong>会社名</strong></p>
<p>{{ $contact->name }}</p>
@endif

<p><strong>お名前</strong></p>
<p>{{ $contact->last_name }} {{ $contact->first_name }}</p>

<p><strong>フリガナ</strong></p>
<p>{{ $contact->last_name_kana }} {{ $contact->first_name_kana }}</p>

<p><strong>メールアドレス</strong></p>
<p>{{ $contact->email }}</p>

<p><strong>お問い合わせ内容</strong></p>
<p>{!! nl2br(e($contact->message)) !!}</p>

</body>
</html>