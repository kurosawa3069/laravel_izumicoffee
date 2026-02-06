<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class InformationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
public function run(): void
    {
        $image_types = [
            'food', 'recipe', 'cooking', 'dinner',
            'lunch', 'breakfast', 'healthy',
            'delicious', 'tasty', 'cake', 'coffee'
        ];

        for ($i = 0; $i < 20; $i++) {
            DB::table('information')->insert([
                'posted_at' => now()->subDays(rand(0, 30)),
                'title' => 'Information of ' . Str::random(10),
                'description' => 'This is Information for ' . Str::random(10),
                'image' => "https://picsum.photos/seed/news-{$i}/600/400",
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}