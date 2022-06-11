<?php

namespace Database\Seeders;

use App\Models\Vehicle;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class VehicleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        DB::table('vehicles')->delete();

       $vehicles = [
           [
            'veh_reg_number' => 'KGH 123F',
            'tonnage' => '5',
            'engine_number' => 'RT-ER4343',
            'veh_make' => 'Toyota',
            'veh_model' => 'Nexus',
            'veh_cc' => '1200',
            'status' => 'loading',
           ],
           [
            'veh_reg_number' => 'KAK 563D',
            'tonnage' => '4',
            'engine_number' => 'DFGDG57-YT',
            'veh_make' => 'Fuso',
            'veh_model' => 'Ranger',
            'veh_cc' => '1200',
            'status' => 'On Transit',
           ],
           [
            'veh_reg_number' => 'KBC T63S',
            'tonnage' => '4',
            'engine_number' => 'ERDG57-YT',
            'veh_make' => 'Nissan',
            'veh_model' => 'Titan',
            'veh_cc' => '1600',
            'status' => 'On Transit',
           ],
           [
            'veh_reg_number' => 'KBA 463G',
            'tonnage' => '4',
            'engine_number' => 'DFGDG57-YT',
            'veh_make' => 'Ford',
            'veh_model' => 'Tacoma',
            'veh_cc' => '1600',
            'status' => 'On Transit',
           ],
        ];
        foreach ($vehicles as $vehicle) {
            Vehicle::create($vehicle);
        }
    }
}
