<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Brand extends Model
{
    use HasFactory;


    function s_cat(){
        return $this->belongsTO(SubCategory::class, 'sub_cat_id', 'id');
    }
}
