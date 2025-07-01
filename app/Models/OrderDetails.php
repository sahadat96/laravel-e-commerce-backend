<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    use HasFactory;

    function order_id(){
        return $this->belongsTO(Order::class, 'order_id', 'id');
    }

    function getProducts(){
        return $this->belongsTO(Product::class, 'product_id', 'id');
    }
}
