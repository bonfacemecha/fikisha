<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'veh_reg_number',
        'tonnage',
        'engine_number',
        'veh_make',
        'veh_model',
        'veh_cc',
        'status',
    ];
}
