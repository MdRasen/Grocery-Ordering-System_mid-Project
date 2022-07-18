<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


use App\Models\Order;
use App\Models\Coupon;
use App\Models\Product;

class vendor extends Model
{
    use HasFactory;

    // public function orders()
    // {
    //     return $this->hasMany(Order::class,'v_id');
    // }

    public function coupons()
    {
        return $this->hasMany(Coupon::class, 'v_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class,'v_id');
    }

}
