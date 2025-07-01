<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Product;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use App\Models\ProductGallery;
use App\Models\AddToCart;



class FrontendController extends Controller
{
    //show category to menu 
    public static function showCat(){
      $cats = Category::all();

      return $cats;
    }
    //show feature products
    public static function getfeature(){
        $feautured = Product::where('featured', 'Featured')->get();
        return $feautured;
    }

    public function index(){
        $userData = User::find(Auth::user()->id);
        $allproducts = Product::all();
        return view('dashboard', compact('userData','allproducts'));
    }

    public function home(){
        $allproducts = Product::all();
        return view('welcome', compact('allproducts'));
    }
    //static function for product gallery
    public static function gallery($product_id){
         return ProductGallery::where('product_id', $product_id)->get();
    }

 //static function for get  color
  public static function productAttribute($prodcut_id){
    $product = new Product;
    $get_product = $product->where('id', $prodcut_id)->first();

    $color = $get_product->product_color;
    $product_color = explode(',', $color);

    $size = $get_product->product_size;
    $product_size = explode(',', $size);
  
    return $product_color;
  }

//function for get size

 public static function product_size($product_id){
    $product = new Product;
    $get_size = $product->where('id', $product_id)->first();

    $size = $get_size->product_size;
    $product_size = explode(', ', $size);

    return $product_size;
 }
 
//function for add to cart
public function addtocart(Request $request, $id){
    $user_id = Auth::user()->id;
    $product_in = Product::find($id);

    $addtocart = new AddToCart();
    $addtocart->user_id = $user_id;
    $addtocart->product_id = $product_in->id;
    $addtocart->product_name = $product_in->product_name;
    $addtocart->qnt = $request->product_quantity;
    $addtocart->price = $product_in->discount_price;
    $addtocart->delivery_charge = $product_in->delivery_Charge;
    $addtocart->image = $product_in->product_image;
    $addtocart->size = $request->product_size;
    $addtocart->color = $request->product_color;
    $addtocart->save();
    
    return response()->json([
     'msg' => "This Product Added In Cart"
    ]);
 }

    public function addtocartshow(){
        $user_id = Auth::user()->id;
        $carts = AddToCart::where("user_id", $user_id)->get();
        return response()->json([
            'data' => $carts
        ]);

    }

    public function removeitem($id){
        $carts = AddToCart::find($id);
        $carts->delete();
        return response()->json([
            'msg' => "Item Successfully Removed"
        ]);

    }

    public function viewcart(){
        $user_id = Auth::user()->id;
        $cartItems = AddToCart::where('user_id', $user_id)->get();
        $allproducts = Product::all();

        return view('includes.viewcart', compact('cartItems','allproducts'));
   }

   public function cartViewpage(){
        $user_id = Auth::user()->id;
        $cart = new AddToCart;

        $cartItems = $cart->where('user_id', $user_id)->get();
        return response()->json([
           'data' => $cartItems
        ]);
   }
   
   
}
