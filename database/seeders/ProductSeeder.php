<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $productNames = [
            'ブレンドドリップバッグ',
            'シングルオリジンドリップ',
            '深煎りブレンド',
            '浅煎りブレンド',
            'カフェオレベース',
            'デカフェコーヒー',
        ];

        for ($i = 0; $i < 20; $i++) {
            DB::table('products')->insert([
                'name' => $productNames[array_rand($productNames)] . ' ' . Str::random(3),
                'description' => '香り豊かなコーヒーです。' . Str::random(20),
                'price' => rand(800, 3000),
                'image' => "https://picsum.photos/seed/product-{$i}/600/600",
                'is_new' => rand(0, 1),
                'is_active' => 1,
                'is_sold_out' => rand(0, 4),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

}
