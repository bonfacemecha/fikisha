<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

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
            'name' => 'Fikisha Admin',
            'location' => 'Nairobi',
            'email' => 'admin@fikisha.com',
            'password' => bcrypt('12345678@'),
        ]);
        User::create([
            'name' => 'Mombasa Admin',
            'location' => 'Mombasa',
            'email' => 'mombasa@fikisha.com',
            'password' => bcrypt('12345678@'),
        ]);
    }
}
