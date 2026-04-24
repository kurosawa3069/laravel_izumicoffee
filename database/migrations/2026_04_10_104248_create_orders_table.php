<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('name');          // 名前
            $table->string('email');         // メール
            $table->string('address');       // 住所
            $table->string('phone')->nullable(); // 電話番号
            $table->integer('total_price');  // 合計金額
            $table->string('stripe_session_id')->nullable(); // Stripe連携用
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
