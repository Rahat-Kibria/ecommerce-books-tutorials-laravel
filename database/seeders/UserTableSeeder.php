<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'first_name' => 'Rahat',
            'last_name' =>  'Kibria',
            'contact_number' => '01234567890',
            'email' => 'admin1@yopmail.com',
            'username' => 'wahy',
            'password' => bcrypt('12345678'),
            'role' => 'admin'
        ]);
    }
}
