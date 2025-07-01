@extends('admin.master')
@section('admin')
<div class="card">
		<div class="card-body">
			<div class="table-responsive">
				<div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap5">
					 <div class="row">
							<div class="col-sm-12">
								<table id="sohel" class="table table-striped table-bordered dataTable" role="grid" aria-describedby="example2_info">
								<thead>
									<tr role="row">
										<th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 10px;">Sl</th>
										<th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 150px;">Order Date</th>
										<th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 430.078px;">Order Number</th>
										<th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 198.453px;">Invoice </th>
										<th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 198.453px;">Ammount</th>
										<th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 198.453px;">Total Ammount</th>
										<th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 198.453px;">Payment Type</th>
										<th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending" style="width: 100.359px;">status</th>
										<th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Start date: activate to sort column ascending" style="width: 186.719px;">Action</th>
									</tr>
									
								</thead>
								<tbody>	
										@php $sl = 1; @endphp
											@if(count($get_order) > 0)
												@foreach($get_order as $get_orders)
											   <tr >
													<td>{{ $sl }}</td>
													<td >{{  $get_orders->order_date }}</td>
													<td >{{  $get_orders->order_number }}</td>
													<td >{{  $get_orders->invoice_no }}</td>
													<td >{{  $get_orders->amount }}</td>
													<td >{{  $get_orders->total_amount }}</td>
													<td >{{  $get_orders->payment_type }}</td>
													<td ><span class="badge rounded-pill bg-success">{{  $get_orders->status }} </span> </td>
													<td>
												    
													<a href="{{ route('order_details', $get_orders->id ) }}" class="btn btn-info" title="Details"><i class="fa fa-eye"></i> </a>

													</td>
												</tr>
												@php $sl++; @endphp
											@endforeach
										@else
										<tr>
											<td colspan="8" class="text-center">Date Not Found</td>
										</tr>
								</tbody>
								     @endif 
									<tfoot>
									<tr>
										<th rowspan="1" colspan="1">Sl</th>
										<th rowspan="1" colspan="1">Order Date</th>
										<th rowspan="1" colspan="1">Order Number</th>
										<th rowspan="1" colspan="1">Invoice</th>
										<th rowspan="1" colspan="1">Ammount</th>
										<th rowspan="1" colspan="1">Total Ammount</th>
										<th rowspan="1" colspan="1">Payment Type</th>
										<th rowspan="1" colspan="1">Status</th>
										<th rowspan="1" colspan="1">Action</th>
									</tr>
								</tfoot>
							 </table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection