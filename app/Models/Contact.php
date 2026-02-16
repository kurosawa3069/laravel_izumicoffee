<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'contact_type',
        'name',
        'last_name',
        'first_name',
        'last_name_kana',
        'first_name_kana',
        'email',
        'message',
    ];
}
