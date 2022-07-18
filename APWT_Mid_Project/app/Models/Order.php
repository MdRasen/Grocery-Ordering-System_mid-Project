<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Vendor;
use App\Models\Coupon;
use App\Models\Customer;
use App\Models\Deliveryman;
use App\Models\Product;

class order extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function products()
    {
        return $this->belongsToMany(Product::class,'product_orders','o_id','p_id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class,'p_id');
    }
    public function coupon()
    {
        return $this->belongsTo(Coupon::class,'co_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class,'c_id');
    }

    // public function vendor()
    // {
    //     return $this->belongsTo(Vendor::class,'v_id');
    // }

//     public function deliveryman()
//     {
//         return $this->belongsTo(Deliveryman::class);
//     }
}
