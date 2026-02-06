<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Information extends Model
{
    use HasFactory;

    protected $table = 'information'; 

    protected $fillable = [
        'posted_at',
        'title',
        'description',
        'image',
        ];
    
    protected $casts = [
        'posted_at' => 'date',
    ];
}
