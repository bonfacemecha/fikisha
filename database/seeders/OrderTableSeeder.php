<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OrderTableSeeder extends Seeder
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

        $orders = [
            [
                'order_number' => 'Fik-001-22',
                'payment_type' => 'mpesa',
                'destination' => 'Nairobi',
                'amount' => '450000',
                'customer_id' => '1',
                'vehicle_id' => '1',
                'status' => 'pending',
            ],
            [
                'order_number' => 'Fik-002-22',
                'payment_type' => 'Visa',
                'destination' => 'Kisumu',
                'amount' => '780000',
                'customer_id' => '2',
                'vehicle_id' => '2',
                'status' => 'pending',
            ],
            [
                'order_number' => 'Fik-003-22',
                'payment_type' => 'mpesa',
                'destination' => 'Kampala',
                'amount' => '150000',
                'customer_id' => '3',
                'vehicle_id' => '3',
                'status' => 'pending',
            ]

        ];
        foreach ($orders as $order) {
            Order::create($order);
        }
    }
}
