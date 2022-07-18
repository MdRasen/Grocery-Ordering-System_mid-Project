<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Order;

class cart extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'c_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'p_id');
    }

    // public function order()
    // {
    //     return $this->belongsTo(Oder::class, 'c_id');
    // }
}
