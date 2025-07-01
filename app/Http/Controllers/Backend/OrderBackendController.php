<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetails;

class OrderBackendController extends Controller
{
 // Show Pending Order
   public function showOrder(){
      $order =  new Order;

      $get_order = $order->where('status', 'pending')
                         ->orderBy('id', 'ASC')
                         ->get();

     return view('admin.page.order.pending_order', compact('get_order'));

   }

   // function for order details
   public function orderDetails($order_id){
      $get_order = new Order;
      $order_details = new OrderDetails;

     $order = $get_order->where('id', $order_id)->first();
     $order_items = $order_details->where('order_id', $order_id)->orderBy('id', 'ASC')->get();
   
    
    return view('admin.page.order.order_details', compact('order', 'order_items'));
   }
 

   // Order Confirm
   public function confirm($id){

         $order = Order::where('id', $id)->first();

         if($order->status === 'pending'){
            $order->update(['status' => 'confirm']);
            return redirect()->route('pending.order')->with('message', "Status Changed to confirmed");
         }
         elseif($order->status === 'confirm'){
            $order->update(['status' => 'processing']);
            return redirect()->route('confirmed.order')->with('message', "Status Changed to processing");
         }
         elseif($order->status === 'processing'){
            $order->update(['status' => 'shiped']);
            return redirect()->route('proccessing.order')->with('message', "Status Changed to shiped");
         }
         elseif($order->status === 'shiped'){
            $order->update(['status' => 'delivered']);
            return redirect()->route('shiped.order')->with('message', "Status Changed to delivered");
         }
         elseif($order->status === 'delivered'){
            $order->update(['status' => 'received']);
            return redirect()->route('delivered.order')->with('message', "Status Changed to received");
         }
         else {
            return redirect()->back()->with('error', "Invalid status transition");
        }
  
     }

   // Get confirmed order
    public function get_confirmed_order(){
        $get_order = Order::where('status', 'confirm')
                     ->orderBy('id', 'ASC')
                     ->get();
       return view('admin.page.order.confirmed_order', compact('get_order'));
    } 

   // Get proccessing order
   public function get_proccesing_order(){
      $get_order = Order::where('status', 'processing')->orderBy('id', 'ASC')->get();

      return view('admin.page.order.proccessing_order', compact('get_order'));
   }


   //Get shiped order
   public function get_shiped_order(){
      $get_order = Order::where('status', 'shiped')->orderBy('id', 'ASC')->get();

      return view('admin.page.order.shiped', compact('get_order'));
   }

   //Get delivered order
   public function get_delivered_order (){ 
      $get_order = Order::where('status', 'delivered')->orderBy('id', 'ASC')->get();

      return view('admin.page.order.delivered', compact('get_order'));
   }

   // Get received order
   public function get_received_order(){
      $get_order = Order::where('status', 'received')->orderBy('id', 'ASC')->get();

      return view('admin.page.order.received', compact('get_order'));
   }


}
