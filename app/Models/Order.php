<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
  protected $fillable = [
    'name',
    'email',
    'address',
    'phone',
    'total_price',
    'stripe_session_id',
    'status',
  ];

  public function items()
  {
      return $this->hasMany(\App\Models\OrderItem::class);
  }

  public function getStatusLabelAttribute()
  {
      return [
          'pending' => '未処理',
          'paid' => '支払い済み',
          'shipped' => '発送済み',
      ][$this->status] ?? '不明';
  }
}

