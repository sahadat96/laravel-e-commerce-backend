<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddToCart extends Model
{
    
    use HasFactory;

    function userId(){
        return $this->belongsTO(User::class, 'user_id', 'id');
    }
    function product_id(){
        return $this->belongsTO(Product::class, 'product_id', 'id');
    }
    
    protected $table = 'addtocarts';

    protected $fillable = [
        'user_id',
        'product_id',
        'product_name',
        'qnt',
        'price',
        'image',
    ];
}
