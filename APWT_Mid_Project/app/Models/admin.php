<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\notice;

class admin extends Model
{
    use HasFactory;
    
    public function notices()
    {
        return $this->hasMany(Notice::class, 'a_id');
    }
}
