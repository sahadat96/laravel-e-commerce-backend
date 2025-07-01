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
										<th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 269.406px;">Sl</th>
										<th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 430.078px;">Product Name</th>
										<th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 430.078px;">Category Name</th>
										<th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 198.453px;">Sub Category Name</th>
										<th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 198.453px;">Product Image</th>
										<th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending" style="width: 100.359px;">Slug</th>
										<th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Start date: activate to sort column ascending" style="width: 186.719px;">status</th>
										<th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Start date: activate to sort column ascending" style="width: 186.719px;">Action</th>
									</tr>
									
								</thead>
								<tbody>	
										@php $sl = 1; @endphp
											@if(count($products) > 0)
												@foreach($products as $product)
											   <tr >
													<td>{{ $sl }}</td>
													<td >{{ $product->product_name }}</td>
													<td >{{ $product->cat->cat_name }}</td>
													<td >{{ $product->s_cat_id->subcat_name }}</td>
													<td> <image src="{{ asset('uploads/product/product_photo/'.$product->product_image) }}" height="120" width="120"></image></td><br>
													<td>{{ $product->slug}}</td>
													<td>{{ $product->status}}</td>
													<td>
													<a href="{{ route('product_edite', $product->id) }}"> <button  class="btn btn-info btn-sm">Edit</button> </a>
												    <a href="{{ route('product_delete', $product->id) }}"> <button  class="btn btn-danger btn-sm">Delete</button> </a>
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
										<th rowspan="1" colspan="1">Product Name</th>
										<th rowspan="1" colspan="1">Category Name</th>
										<th rowspan="1" colspan="1">Sub Category Name</th>
										<th rowspan="1" colspan="1">Product Image</th>
										<th rowspan="1" colspan="1">Slug</th>
										<th rowspan="1" colspan="1">status</th>
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