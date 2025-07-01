<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    function cat(){
        return $this->belongsTO(Category::class, 'cat_id', 'id' );
    }


}
