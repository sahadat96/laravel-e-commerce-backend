<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingState extends Model
{
      use HasFactory;

    protected $guarded = [];

    function areadivision(){
        return $this->belongsTO(Division::class, 'division_id', 'id');
    }
    
    function distric(){
        return $this->belongsTO(Districs::class, 'districs_id', 'id');
    }
}
