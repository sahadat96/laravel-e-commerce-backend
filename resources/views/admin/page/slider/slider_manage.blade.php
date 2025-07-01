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
                                    <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 100.359px;">Sl</th>
										<th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 430.078px;">Title</th>
										<th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 430.078px;">Category </th>
										<th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 198.453px;">Description</th>
										<th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 198.453px;">Image</th>
										<th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 100.359px;">Status</th>
										<th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending" style="width: 100.359px;">Action</th>
									</tr>
									
								</thead>
								<tbody>	
										@php $sl = 1; @endphp
											@if(count($slider_manage) > 0)
												@foreach($slider_manage as $slider_manages)
											   <tr >
													<td>{{ $sl }}</td>
													<td >{{ $slider_manages->title }}</td>
													<td >{{ $slider_manages->category }}</td>
													<td >{{ $slider_manages->description }}</td>
													<td> <image src="{{ asset('uploads/slider/'.$slider_manages->pic) }}" height="120" width="120"></image></td><br>
													 
													<td>
                                                         @if($slider_manages->status == 'active')
                                                          <span class="badge rounded-pill bg-success">Active </span>
                                                         @elseif($slider_manages->status == 'inactive')
                                                         <span class="badge rounded-pill bg-info">Published</span>
                                                         @endif
                                                    </td>
													<td>
												    <a href="{{ route('delete.slider', $slider_manages->id) }}"> <button  class="btn btn-danger btn-sm">Delete</button> </a>
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
										<th rowspan="1" colspan="1">Title</th>
										<th rowspan="1" colspan="1">Category</th>
										<th rowspan="1" colspan="1">Description</th>
										<th rowspan="1" colspan="1">Image</th>
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