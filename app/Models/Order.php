<?php

namespace App\Models;

use App\Models\Vehicle;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    public function vehicle()
{
    return $this->belongsTo(Vehicle::class, 'vehicle_id');
}
public function customer()
{
    return $this->belongsTo(Customer::class, 'customer_id');
}
}
