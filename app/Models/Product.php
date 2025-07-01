<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    function vendor_id(){
        return $this->belongsTO(Vendor::class, 'vendor_id', 'id');
    }

    function cat(){
        return $this->belongsTO(Category::class, 'cat_id', 'id' );
    }

    function s_cat_id(){
        return $this->belongsTO(SubCategory::class, 'sub_cat_id', 'id');
    }

    function brand_id(){
        return $this->belongsTO(Brand::class, 'brand_id', 'id');
    }

    public function getImage(){

        return $this->hasMany(ProductGallery::class, 'product_id')->orderBy('id', 'asc');
    }


    protected $fillable = [
        'vendor_id',
        'cat_id',
        'sub_cat_id',
        'product_name',
        'slug',
        'brand_id',
        'product_price',
        'product_code',
        'discount_price',
        'short_desc',
        'product_tags',
        'product_size',
        'product_color',
        'quantity',
        'status',
        'long_desc',
        'product_image',
        
    ];

    // static public function getProduct($category_id = '', $subcategory_id = ''){
        
    //     $return = Product::select('products.*', 'vendors.shop_name' )
    //                        ->join('vendors', 'vendors.id', '=', 'products.vendor_id');

    //             if(!empty($category_id)){
    //                 $return = $return->where('products.cat_id', '=', $category_id);
    //             }
    //             if(!empty($subcategory_id)){
    //                 $return = $return->where('products.sub_cat_id', '=', $subcategory_id);
    //             }
    //             $return = $return->where('products.status', '=', 'active')
    //                                ->orderBy('products.id', 'desc')
    //                                ->paginate(6);
                                 
    //     return $return;
    // }

    // static public function getSingleSlug($slug){
    //     return self::where('slug', '=', $slug)
    //                 ->where('products.status', '=', 'active')
    //                 ->first();
    // }

    // static public function getProductDetail(){
    //     return self::where('products.status', '=', 'active')
    //                 ->first();
    // }

        // static public function getReletedProduct($product_id, $sub_cat_id){
        //     $return = Product::select('products.*', 'vendors.operator_name as create_by_name', 
        //     'categories.cat_name as category_name', 'categories.cat_slug as category_slug', 
        //     'sub_categories.subcat_name as sub_cat_name', 'sub_categories.subcat_slug as sub_cat_slug')
        //     ->join('vendors', 'vendors.id', '=', 'products.vendor_id')
        //     ->join('categories','categories.id', '=', 'products.cat_id')
        //     ->join('sub_categories', 'sub_categories.id', '=', 'products.sub_cat_id')
        //     ->where('products.id', '!=', $product_id)
        //     ->where('products.sub_cat_id', '=', $sub_cat_id)
        //     ->where('products.status', '=', 'active')
        //     ->groupBy('products.id',  'vendors.operator_name', 'categories.cat_name', 
        //     'categories.cat_slug', 'sub_categories.subcat_name', 'sub_categories.subcat_slug', 
        //     'products.vendor_id', 'products.cat_id', 'products.sub_cat_id', 'products.brand_id', 
        //     'products.product_name','products.slug', 'products.slug',
        //     'products.product_image','products.product_price','products.discount','products.product_code',
        //     'products.discount_price','products.short_desc','products.product_tags','products.product_size',
        //     'products.product_color','products.long_desc','products.hot_deal','products.special_offer',
        //     'products.special_deal','products.featured','products.thumb','products.quantity','products.status',
        //     'products.created_at','products.updated_at','products.delivery_Charge')
        //     ->orderBy('products.id', 'desc')
        //     ->limit(4) 
        //     ->get();
    
        //     return $return;

        // }
}
