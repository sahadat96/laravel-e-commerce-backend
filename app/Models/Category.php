<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Category extends Model
{
    use HasFactory;

    //for showing categories in menu
    static public function getRecordMenu(){
        return self::select('categories.*')
        ->get();
    }

    public function getSubCategory(){
         return $this->hasMany(SubCategory::class, 'cat_id');
    }

    static public function getSingleSlug($slug){
        return self::where('cat_slug', '=', $slug)
                    ->where('categories.status', '=', 'active')
                    ->first();
    }
}
