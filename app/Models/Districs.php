<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Districs extends Model
{
    use HasFactory;

    protected $guarded = [];

    function division(){
        return $this->belongsTO(Division::class, 'division_Id', 'id');
    }
}
