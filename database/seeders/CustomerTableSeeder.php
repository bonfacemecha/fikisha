<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CustomerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        DB::table('orders')->delete();


        $customers = [
            [
                'name' => 'Bonface Mecha',
                'email' => 'ambonface@gmail.com',
                'phone_number' => '0712345678',
                'kra_pin' => 'A12345678P',
                'id_number' => '12345678',
                'status' => 'active',
            ],
            [
                'name' => 'Jane Kimani',
                'email' => 'jane.test@gmail.com',
                'phone_number' => '0767345678',
                'kra_pin' => 'A65345678P',
                'id_number' => '86345678',
                'status' => 'active',
            ],
            [
                'name' => 'Sammy Musa',
                'email' => 'sammy.test@gmail.com',
                'phone_number' => '0767345678',
                'kra_pin' => 'A65445678P',
                'id_number' => '79245678',
                'status' => 'banned',
            ],
            [
                'name' => 'Oloo Miguna',
                'email' => 'oloo.miguna@gmail.com',
                'phone_number' => '0700345678',
                'kra_pin' => 'A02345678P',
                'id_number' => '46345673',
                'status' => 'active',
            ],
            [
                'name' => 'Sasha Aisha',
                'email' => 'sasha@gmail.com',
                'phone_number' => '070044678',
                'kra_pin' => 'A02392678P',
                'id_number' => '32345673',
                'status' => 'active',
            ],

        ];


        foreach ($customers as $customer) {
            Customer::create($customer);
        }
    }
}
