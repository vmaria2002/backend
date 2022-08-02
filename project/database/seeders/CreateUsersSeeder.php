<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Maria',
            'email' => 'maria.vasilache02@gmail.com',
            'password' => bcrypt('password')
        ]);
    }
}