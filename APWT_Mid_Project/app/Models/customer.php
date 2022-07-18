<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Cart;
use App\Models\Review;
use App\Models\Order;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\Deliveryman;

class customer extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function carts()
    {
        return $this->hasMany(Cart::class, 'c_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'c_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class,'c_id');
    }

    public function coupons()
    {
        return $this->belongsToMany(Coupon::class,'customer_coupons','c_id','co_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class,'customer_products','c_id','p_id');
    }

    // public function deliverymen()
    // {
    //     return $this->belongsToMany(Deliveryman::class,'customer_deliverymen','c_id','d_id');
    // }
}
