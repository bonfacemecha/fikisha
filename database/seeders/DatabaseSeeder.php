<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        
        $this->call(UserTableSeeder::class);
        $this->command->info('Users table seeded!');

        $this->call(CustomerTableSeeder::class);
        $this->command->info('Customers table seeded!');

        $this->call(VehicleTableSeeder::class);
        $this->command->info('Vehicles table seeded!');

        $this->call(OrderTableSeeder::class);
        $this->command->info('Orders table seeded!');

    }
}
