<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
      use HasFactory;

      protected $fillable = [
        'status',
    ];

    function user_name(){
        return $this->belongsTO(User::class, 'user_id', 'id');
    }

    function division_name(){
        return $this->belongsTO(Division::class, 'division_id', 'id');
    }

    function district_name(){
        return $this->belongsTO(Districs::class, 'district_id', 'id');
    }

    function state_name(){
        return $this->belongsTO(ShippingState::class, 'state_id', 'id');
    }
}
