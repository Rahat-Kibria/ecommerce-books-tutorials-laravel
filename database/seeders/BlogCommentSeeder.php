<?php

namespace Database\Seeders;

use App\Models\BlogComment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BlogCommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $faker = Faker::create();
        for ($i = 1; $i <= 50; $i++) {
            BlogComment::create([
                'post_id' => \App\Models\Post::get()->random()->id,
                'user_id' => \App\Models\User::get()->random()->id,
                'comment' => fake()->paragraph(),
            ]);
        }
    }
}
