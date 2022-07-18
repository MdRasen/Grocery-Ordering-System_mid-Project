<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Customer;
use App\Models\Order;

class deliveryman extends Model
{
    use HasFactory;

    protected $guarded = [];

    // public function orders()
    // {
    //     return $this->hasMany(Order::class);
    // }
    // public function customers()
    // {
    //     return $this->belongsToMany(Customer::class,'customer_deliverymen','d_id','c_id');
    // }
}
