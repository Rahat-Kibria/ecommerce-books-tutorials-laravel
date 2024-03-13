<?php

namespace Database\Seeders;

use App\Models\Feedback;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FeedbackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 20; $i++) {
            Feedback::create([
                'user_id' => fake()->numberBetween(6, 7),
                'name' => fake()->name(),
                'email' => fake()->unique()->safeEmail(),
                'message' => fake()->text(200),
            ]);
        }
    }
}
