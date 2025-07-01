@extends('admin.master')
@section('admin')

     <div class="page-content pt-150 pb-150">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 m-auto">
                        <div class="row">
                            <div class="col-md-9">
                                <div class="tab-content account dashboard-content pl-50">
                                    <div class="tab-pane fade active show" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                                    <div class="row">
                                    <div class="col-md-6">
                                            <div class="card">
                                                <div class="card-header" style="background:#F4F6FA;font-weight: 600;"><h4>Shipping Details</h4> </div> 
                                                    <hr>
                                                
                                                    <table class="table" style="background:#F4F6FA;font-weight: 600;">
                                                        <tr>
                                                            <th>Shipping Name:</th>
                                                            <th>{{ $order->name }}</th>
                                                        </tr>

                                                        <tr>
                                                            <th>Shipping Phone:</th>
                                                            <th>{{ $order->phone }}</th>
                                                        </tr>

                                                        <tr>
                                                            <th>Shipping Email:</th>
                                                            <th>{{ $order->email }}</th>
                                                        </tr>

                                                        <tr>
                                                            <th>Shipping Address:</th>
                                                            <th>{{ $order->adress }}</th>
                                                        </tr>


                                                        <tr>
                                                            <th>Division:</th>
                                                        <th>{{ $order->division_name->division_name }}</th>
                                                        </tr>

                                                        <tr>
                                                            <th>District:</th>
                                                        <th>{{ $order->district_name->distric_name }}</th>
                                                        </tr>

                                                        <tr>
                                                            <th>State :</th>
                                                            <th>{{ $order->state_name->state_name }}</th>
                                                        </tr>

                                                        <tr>
                                                            <th>Order Date   :</th>
                                                            <th>{{ $order->order_date }}</th>
                                                        </tr>

                                                    </table>

                                                </div>
                                            </div>

                                                <div class="col-md-6">
                                                    <div class="card">
                                                        <div class="card-header" style="background:#F4F6FA;font-weight: 600;"><h4>
                                                            <span class="text-danger" >Invoice : {{ $order->invoice_no }} </span></h4>
                                                        </div> 
                                                         <hr>
                                                    
                                                        <table class="table" style="background:#F4F6FA;font-weight: 600;">
                                                            <tr>
                                                                <th> Name :</th>
                                                                <th>{{ $order->user_name->name }}</th>
                                                            </tr>

                                                            <tr>
                                                                <th>Phone :</th>
                                                            <th>{{ $order->user_name->phone }}</th>
                                                            </tr>

                                                            <tr>
                                                                <th>Payment Type:</th>
                                                            <th>{{ $order->payment_type }}</th>
                                                            </tr>


                                                            <tr>
                                                                <th>Transx ID:</th>
                                                            <th>{{ $order->transaction_id }}</th>
                                                            </tr>

                                                            <tr>
                                                                <th>Invoice:</th>
                                                            <th class="text-danger">{{ $order->invoice_no }}</th>
                                                            </tr>

                                                            <tr>
                                                                <th>Order Amonut:</th>
                                                                <th>৳{{ $order->total_amount }}</th>
                                                            </tr>

                                                            <tr>
                                                             <th>Order Status:</th>
                                                                @if($order->status == 'pending')
                                                                <th ><span style="height: 35px; width: 110px;" class="badge rounded-pill bg-warning"><h4  style="color: white;">Pending</h4></span></th>
                                                                @elseif($order->status == 'confirm')
                                                                <th> <span style="height: 35px; width: 110px;" class="badge rounded-pill bg-info"><h4  style="color: white;">Confirm</h4></span></th>
                                                                @elseif($order->status == 'processing')
                                                                <th>  <span style="height: 35px; width: 110px;" class="badge rounded-pill bg-danger"><h4  style="color: white;">Processing</h4></span></th>
                                                                @elseif($order->status == 'shiped')
                                                                <th>  <span style="height: 35px; width: 110px;" class="badge rounded-pill bg-success"><h4  style="color: white;">Shiped</h4></span></th>
                                                                @elseif($order->status == 'delivered')
                                                                <th>  <span style="height: 35px; width: 110px;" class="badge rounded-pill bg-success"><h4  style="color: white;">Delivered</h4></span></th>
                                                                @elseif($order->status == 'received')
                                                                <th>  <span style="height: 35px; width: 110px;" class="badge rounded-pill bg-success"><h4  style="color: white;">Received</h4></span></th>
                                                                @endif
                                                            </tr>
                                                            <tr>
                                                                 
                                                                @if($order->status == 'pending')
                                                                <th><a href="{{ route( 'confirm.order', $order->id ) }}" class="btn btn-block btn-success" >Confirm Order</a> </th>
                                                                @elseif($order->status == 'confirm')
                                                                <th><a href="{{ route( 'confirm.order', $order->id ) }}" class="btn btn-block btn-success" >Processing Order</a> </th>
                                                                @elseif($order->status == 'processing')
                                                                <th><a href="{{ route( 'confirm.order', $order->id ) }}" class="btn btn-block btn-success" >Shiped Order</a> </th>
                                                                @elseif($order->status == 'shiped')
                                                                <th><a href="{{ route( 'confirm.order', $order->id ) }}" class="btn btn-block btn-success" >Delivered Order</a> </th>
                                                                @elseif($order->status == 'delivered')
                                                                <th><a href="{{ route( 'confirm.order', $order->id ) }}" class="btn btn-block btn-success" >received Order</a> </th>
                                                                @endif

                                                            </tr>

                                                        </table>
                                                    </div>
                                               </div>
                                        </div>
                                </div>
                            </div>
                            
                        </div>
                                                        <!-- orderItem table -->

                                                        <table class="table" style="font-weight: 600;"  >
                                                            <tbody>
                                                                <tr>
                                                                    <td class="col-md-1">
                                                                        <label>Image </label>
                                                                    </td>
                                                                    <td class="col-md-2">
                                                                        <label>Product Name </label>
                                                                    </td>
                                                                    
                                                                    <td class="col-md-2">
                                                                        <label>Product Code  </label>
                                                                    </td>
                                                                    <td class="col-md-1">
                                                                        <label>Color </label>
                                                                    </td>
                                                                    <td class="col-md-1">
                                                                        <label>Size </label>
                                                                    </td>
                                                                    <td class="col-md-1">
                                                                        <label>Quantity </label>
                                                                    </td>

                                                                    <td class="col-md-3">
                                                                        <label>Price  </label>
                                                                    </td> 

                                                                </tr>


                                                                @foreach($order_items as $item)
                                                                <tr>
                                                                    <td class="col-md-1">
                                                                        <label><img src="{{ asset('uploads/product/product_photo/'.$item->img) }}" style="width:80px; height:80px;" > </label>
                                                                    </td>
                                                                    <td class="col-md-2">
                                                                        <label>{{ $item->getProducts->product_name }}</label>
                                                                    </td>

                                                                    <td class="col-md-2">
                                                                        <label>{{ $item->getProducts->product_code }} </label>
                                                                    </td>
                                                                    @if($item->color == NULL)
                                                                    <td class="col-md-1">
                                                                        <label>.... </label>
                                                                    </td>
                                                                    @else
                                                                    <td class="col-md-1">
                                                                        <label>{{ $item->color }} </label>
                                                                    </td>
                                                                    @endif

                                                                    @if($item->size == NULL)
                                                                    <td class="col-md-1">
                                                                        <label>.... </label>
                                                                    </td>
                                                                    @else
                                                                    <td class="col-md-1">
                                                                        <label>{{ $item->size }} </label>
                                                                    </td>
                                                                    @endif
                                                                    <td class="col-md-1">
                                                                        <label>{{ $item->quantity }} </label>
                                                                    </td>

                                                                    <td class="col-md-3">
                                                                        <label>৳{{ $item->price }} <br> Total = ৳{{ $item->price * $item->quantity }}   </label>
                                                                    </td> 

                                                                </tr>
                                                                @endforeach

                                                            </tbody>
                                                        </table>
                    </div>
                </div>
            </div>

@endsection