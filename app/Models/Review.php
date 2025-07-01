<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
     use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'comment',
        'review',
        'value',
        'status',
    ];

    function user__id(){
        return $this->belongsTO(User::class, 'user_id', 'id');
    }
    function p_id(){
        return $this->belongsTO(Product::class, 'product_id', 'id');
    }
}
