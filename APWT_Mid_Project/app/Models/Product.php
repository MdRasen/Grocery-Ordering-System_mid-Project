<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Cart;
use App\Models\Customer;
use App\Models\Review;
use App\Models\Vendor;
use App\Models\Order;

class Product extends Model
{
    use HasFactory;
    public function carts()
    {
        return $this->belongsTo(Cart::class);
    }
    public function customers()
    {
        return $this->belongsToMany(Customer::class,'customer_products','p_id','c_id');
    }
    public function reviews()
    {
        return $this->hasMany(Review::class, 'p_id');
    }
    public function vendor()
    {
        return $this->belongsTo(Vendor::class,'v_id');
    }
    public function order()
    {
        return $this->belongsToMany(order::class,'product_orders','p_id','o_id');
    }
    public function orders()
    {
        return $this->hasMany(order::class,'p_id');
    }
    public function oneorder()
    {
        return $this->hasOne(order::class,'p_id');
    }
}
