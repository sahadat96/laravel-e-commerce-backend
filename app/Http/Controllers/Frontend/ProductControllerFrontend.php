<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Product;
use App\Models\AddToCart;


class ProductControllerFrontend extends Controller
{
    


     // Get app product for api 
     public function getAllProducts() {
            $getProduct = Product::with(['vendor_id', 'getImage'])
                ->where('featured', 'Featured')
                ->latest()
                ->paginate(12)
                ->through(function ($product) {
                    $product->gallery_images = $product->getImage->pluck('images');
                    return $product;
                });
            
            return response()->json(
                [ 'getProduct' => $getProduct ]
            );
        }


        public function search_products(Request $request)
        {
            $query = $request->input('query');
            
            if (empty($query)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Search query is required',
                    'data' => []
                ], 400);
            }
    
            // Using Eloquent ORM to search products
            $getProduct = Product::with(['vendor_id', 'getImage'])
                ->where('status', 'active')
                ->where(function($q) use ($query) {
                    $q->where('product_name', 'LIKE', "%{$query}%")
                      ->orWhere('product_tags', 'LIKE', "%{$query}%")
                      ->orWhere('short_desc', 'LIKE', "%{$query}%")
                      ->orWhere('product_code', 'LIKE', "%{$query}%");
                })
                ->latest()
                ->paginate(5)->through(function ($product) {
                    $product->gallery_images = $product->getImage->pluck('images');
                    return $product;
                })->appends(['query' => $query]);
    
            // Transform the products using a resource (optional)
            return response()->json(
                [ 
                    'success' => true,
                    'getProduct' => $getProduct
                ]
            );
        }

         // Get app product for api 
     public function special_deals() {
        $getProduct = Product::with(['vendor_id', 'getImage'])
            ->where('special_deal', 'Special Deals')
            ->latest()
            ->paginate(12)
            ->through(function ($product) {
                $product->gallery_images = $product->getImage->pluck('images');
                return $product;
            });
        
            return response()->json(
                [ 'getProduct' => $getProduct ]
            );
        
    }

       // Category wise product page
        public function getCategoryProducts($slug)
        {
            $category = Category::where('cat_slug', $slug)->firstOrFail();
            
            $getProduct = Product::with(['vendor_id', 'getImage'])
                ->where('cat_id', $category->id)
                ->where('status', 'active')
                ->latest()
                ->paginate(5)
                ->through(function ($product) {
                    $product->gallery_images = $product->getImage->pluck('images');
                    return $product;
                });
                
            return response()->json([
                'category' => $category,
                'products' => $getProduct
            ]);
        }
       
        // Sub category wise product
        public function getSubCategoryProducts($slug)
        {
            $subcategory = SubCategory::where('subcat_slug', $slug)->with('cat')->firstOrFail();
            
            $getProduct = Product::with(['vendor_id', 'getImage'])
                ->where('sub_cat_id', $subcategory->id)
                ->where('status', 'active')
                ->latest()
                ->paginate(5)
                ->through(function ($product) {
                    $product->gallery_images = $product->getImage->pluck('images');
                    return $product;
                });
                
            return response()->json([
                'subcategory' => $subcategory,
                'products' => $getProduct
            ]);
        }

        public function productDetails($id){
                $product = Product::with(['vendor_id', 'getImage'])
                    ->where('id', $id)
                    ->where('status', 'active')
                    ->first();

                return response()->json(['product' => $product]);
       }

       // Add to cart 
        public function addtocart(Request $request){
            
              $request->validate([
                'product_id' => 'required|exists:products,id',
                'quantity' => 'required|integer|min:1',
                'color' => 'required|string',
                'size' => 'required|string'
            ]);

            $user_id = auth('api')->user()->id;
            $product_in = Product::find($request->product_id);
        
            $addtocart = new AddToCart;
            
            $addtocart->user_id = $user_id;
            $addtocart->product_id = $product_in->id;
            $addtocart->product_name = $product_in->product_name;
            $addtocart->qnt = $request->quantity;
            $addtocart->price = $product_in->discount_price;
            $addtocart->delivery_charge = $product_in->delivery_Charge;
            $addtocart->image = $product_in->product_image;
            $addtocart->size = $request->size;
            $addtocart->color = $request->color;
            $addtocart->save();
            
            return response()->json([
                "status" => true,
                 "message" =>  "Cart added succesfull"
            ]);
        }

        //Get cart

        public function getcart(){ 

                $user_id = auth('api')->user()->id;
                $carts = AddToCart::where("user_id", $user_id, 'ASC')->get();
                
                // $cartTotal = $carts->sum(function ($item) {
                //     return $item->price * $item->qnt;
                // });
                
                $totalPrice = 0;
                $total_items = 0;
                $totalDeliveryCharge = 0;

                foreach($carts as $item){
                    $totalPrice += $item->price * $item->qnt; 
                    $total_items += $item->qnt;
                   // $total_items ++;
                   $totalDeliveryCharge += $item->delivery_charge;
                }

                 // delivery charge limit
                    $delivery_charge_limit = 100;
                    if ($totalDeliveryCharge >= $delivery_charge_limit) {
                        $totalDeliveryCharge = 100;
                    }

                $grandTotal = $totalPrice + $totalDeliveryCharge;

                return response()->json([
                    'carts' => $carts,
                    'total_items' => $total_items,
                    'totalPrice' => $totalPrice,
                    'grandTotal' => $grandTotal,
                    'totalDeliveryCharge' => $totalDeliveryCharge
                ]);
            
        }
        
        public function removeCart($cartId){ 
              
               $user_id = auth('api')->user()->id;
              
               $cart = AddToCart::find($cartId);
                                          
               $cart->delete();

            return response()->json([
                 'status' => true,
                 'message' => 'Cart item remove successful'
            ]);
        
    }

     

 
        
}
