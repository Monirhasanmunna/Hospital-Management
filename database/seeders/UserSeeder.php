<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        User::updateOrCreate([
            'name'  => 'Admin',
            'email' => 'admin@gmail.com',
            'password'  => bcrypt(11111111)
        ]);

        User::updateOrCreate([
            'name'  => 'Author',
            'email' => 'author@gmail.com',
            'password'  => bcrypt(11111111)
        ]);
    }
}
