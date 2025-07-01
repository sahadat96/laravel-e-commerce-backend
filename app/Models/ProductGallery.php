<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductGallery extends Model
{
     use HasFactory;

    function brand_id(){
        return $this->belongsTO(Product::class, 'product_id', 'id');
    }

    protected $fillable = [
        'product_id',
        'image',
        
    ];
}
