<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillingAddress extends Model
{
    use HasFactory;

    function order_id(){
        return $this->belongsTO(Order::class, 'order_id', 'id');
    }

    function user_id(){
        return $this->belongsTO(User::class, 'user_id', 'id');
    }
}
