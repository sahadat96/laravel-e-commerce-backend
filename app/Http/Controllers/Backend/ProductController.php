<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Brand;
use App\Models\Vendor;
use App\Models\Product;
use App\Models\ProductGallery;
use File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Str;


class ProductController extends Controller
{
    public function index(){
        $categories = Category::all();
        $subcategories = SubCategory::all();
        $brands = Brand::all();
        $vendors = Vendor::where('role', 'vendor')->get();

       return view('admin.page.product.add', compact('categories', 'subcategories', 'brands', 'vendors'));
   }
   
    public function store(Request $request){

   if( $image = $request->file('image')){

       $manager = new ImageManager(new Driver());
       $customName = rand().'.'.$image->getClientOriginalExtension();
       $img = $manager->read($image);
       $img = $img->resize(1100, 1100);
       $path = public_path('uploads/product/product_photo/'.$customName);
       $img->toPng()->save($path);
       
       $pid = Product::insertGetId([
             'vendor_id' => "$request->vendor_id",
             'cat_id' => $request->cat_id,
             'sub_cat_id' => $request->sub_cat_id,
             'brand_id' => $request->brand_id,
             'product_name' => $request->product_name,
             'slug' => Str::slug($request->product_name),
             'product_image' => $customName,
             'product_code' => $request->product_code,
             'product_price' => $request->product_price,
             'discount_price' => $request->discount_price,
             'delivery_Charge' => $request->delivery_Charge,
             'short_desc' => $request->short_desc,
             'product_tags' => $request->product_tags,
             'product_size' => $request->product_size,
             'product_color' => $request->product_color,
             'long_desc' => $request->long_desc,
             'hot_deal' => $request->hot_deal,
             'special_offer' => $request->special_offer,
             'special_deal' => $request->special_deal,
             'featured' => $request->featured,
             'quantity' => $request->quantity,
             'operator_phone' => $request->operator_phone,
             
       ]);

       if($request->images){
           $images = $request->file('images');
           foreach($images as $image1){
            $customName1 = rand().'.'.$image1->getClientOriginalExtension();
            $img = $manager->read($image1);
            $img = $img->resize(1100, 1100);
            $path1 = public_path('uploads/product/productgallery/'.$customName1);
            $img->toPng()->save($path1);
            ProductGallery::insert([
                'product_id' => $pid,
                'images' => $customName1,
            ]);

           }
       }
      
   }
       return back()->with('message', 'Product addeed Successfull ');
   
 }



  public function show(){
    $products = Product::orderBy('id', 'desc')->get();
    return view('admin.page.product.manage', compact('products'));
  }
  
 // Delete Product
  public function productDelete($id){
    // Find the product by ID
    $product = Product::find($id);

    // Get all gallery images associated with the product
    $galleries = ProductGallery::where('product_id', $id)->get();

    // Check if the product and its image exist
    if ($product && File::exists(public_path('uploads/product/product_photo/' . $product->product_image))) {
        // Delete the product image
        File::delete(public_path('uploads/product/product_photo/' . $product->product_image));
    }

    // Loop through each gallery image and delete if exists
    foreach ($galleries as $gallery) {
        if (File::exists(public_path('uploads/product/productgallery/' . $gallery->images))) {
            File::delete(public_path('uploads/product/productgallery/' . $gallery->images));
        }
        // Delete the gallery record
        $gallery->delete();
    }

    // Delete the product record
    if ($product) {
        $product->delete();
    }

    // Redirect or return a response
    return redirect()->back()->with('message', 'Product deleted successfully');
}
  

}
