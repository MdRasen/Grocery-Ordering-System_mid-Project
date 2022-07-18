<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;
use App\Models\vendor;
use App\Models\admin;

class notice extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'c_id');
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'v_id');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'a_id');
    }
}
