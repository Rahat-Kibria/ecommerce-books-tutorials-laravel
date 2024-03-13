<?php

namespace Database\Seeders;

use App\Models\ProductReview;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
// use Faker\Factory as Faker;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $faker = Faker::create();
        for ($i = 1; $i <= 20; $i++) {
            ProductReview::create([
                'product_id' => 8,
                'user_id' => fake()->numberBetween(2, 3),
                'message' => fake()->text(100),
                'rating' => fake()->numberBetween(1, 5),
                'status' => 'approved',
            ]);
        }
    }
}
