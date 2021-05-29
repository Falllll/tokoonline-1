<?php

namespace Database\Seeders;

use App\Models\User;
use illuminate\Support\Str;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        User::create([
            'name' => 'Admin',
            'level' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin'),
            'no_hp' => '08123456789',
            'alamat' => 'Indramayu',
            'remember_token' => Str::random(60),
        ]);
    }
}
