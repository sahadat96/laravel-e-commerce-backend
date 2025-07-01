<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\AddToCart;
use Illuminate\Support\Facades\Auth;
use App\Models\Division;
use App\Models\Districs;
use App\Models\ShippingState;
use App\Models\Order;
use App\Models\OrderDetails;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;



class ProductOrderController extends Controller
{

 // Place Oreder
    public function place_order(Request $request){

        $user_id  = auth('api')->user()->id;
        $carts = new AddToCart;

        $cartsItem = $carts->where('user_id', $user_id , 'ASC')->get();

        // Total calculation
        $totalPrice = 0;
        $totalDeliveryCharge = 0;
        $sub_total = 0;
        $total_items = 0;

        foreach ($cartsItem as $item){
            $totalPrice +=$item->price * $item->qnt; 
            $totalDeliveryCharge += $item->delivery_charge;
            $total_items+= $item->qnt;
        }
        // delivery charge limit
        $delivery_charge_linit = 100;
        if ($totalDeliveryCharge >= $delivery_charge_linit) {
            $totalDeliveryCharge = 100;
        }

        $grandTotal = $totalPrice + $totalDeliveryCharge;
        // End total calculation
        
        //Auto code generation 
        $code_generate = 'PR'.mt_rand(10000000,99999999);

        $order_id = Order::insertGetId([
            'user_id' => auth('api')->user()->id,
            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'state_id' => $request->state_id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'adress' => $request->address,
            'notes' => $request->note,
            'payment_type' => "cash on delivery",
            'amount' => $totalPrice,
            'delivery_charge' => $totalDeliveryCharge,
            'total_amount' => $grandTotal,
            'currency' => "BDT",
            'order_number' => $code_generate,
            'invoice_no' => $code_generate, 
            'order_date' => Carbon::now()->format('Y-m-d H:i:s'),
            'order_month' => Carbon::now()->format('F'),  
            'order_year' => Carbon::now()->format('Y'),  
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),  
        ]);

        foreach($cartsItem as $cartsItems){ 
            OrderDetails::insert([
                'order_id' => $order_id,
                'product_id' => $cartsItems->product_id,
                'color' => $cartsItems->color,
                'size' => $cartsItems->size,
                'price' => $cartsItems->price,
                'quantity' => $cartsItems->qnt,
                'img' => $cartsItems->image,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        }

       return response()->json([
           'stauts' => true,
           'message' => "Place order successfull"
       ]);

    }

    // order show
    public function order_show(){
        $user = auth('api')->user();
        $order = new Order;

        $get_order = $order->where('user_id', $user->id )->orderBy('id', 'DESC')->get();
        
        return response()->json([
            'get_order' => $get_order
        ]);
   }

    // For pdf report
    public function orderDetailpdf($order_id){
        $get_user = Auth::user()->id;
        $get_order = new Order;
        $get_orderitem = new OrderDetails;

        $order = $get_order->where('user_id', $get_user )->where('id', $order_id)->first();
        $order_items = $get_orderitem->where('order_id', $order_id )->orderBy('id', 'DESC')->get();

        $pdf = Pdf::loadView('frontend.page.order.order_invoice', compact('order', 'order_items'))
        ->setPaper('a4', 'landscape')->setOption([
            'tempDir' => public_path(), 
            'chroot' => public_path()
        ]);

        return $pdf->download('invoice.pdf');

    }

    // function for order details
   public function orderDetails($order_id){
    $get_order = new Order;
    $order_details = OrderDetails::with(['order_id', 'getProducts']);

   $order = $get_order->where('id', $order_id)->first();
   $order_items = $order_details->where('order_id', $order_id)->orderBy('id', 'ASC')->get();
  
  return response()->json([
     'order' => $order,
     'orderItem' => $order_items,
  ]);
 }



}
