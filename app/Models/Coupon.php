<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    function p_id(){
        return $this->belongsTO(Product::class, 'product_id', 'id');
    }
}
