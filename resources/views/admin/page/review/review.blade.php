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
										<th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 430.078px;">Comment</th>
										<th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 430.078px;">User </th>
										<th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 198.453px;">Product Name</th>
										<th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 198.453px;">Product Image</th>
										<th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 198.453px;">Rating</th>
										<th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending" style="width: 100.359px;">status</th>
										<th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Start date: activate to sort column ascending" style="width: 186.719px;">Action</th>
									</tr>
									
								</thead>
								<tbody>	
										@php $sl = 1; @endphp
											@if(count($review) > 0)
												@foreach($review as $reviews)
											   <tr >
													<td>{{ $sl }}</td>
													<td >{{  Str::limit($reviews->comment, 60)  }}</td>
													<td >{{ $reviews->user__id->name }}</td>
													<td >{{ $reviews->p_id->product_name }}</td>
													<td> <image src="{{ asset('uploads/product/product_photo/'.$reviews->p_id->product_image) }}" height="120" width="120"></image></td><br>
													<td>
                                                        @if($reviews->rating == NULL)
                                                            <i class="bx bxs-star text-warning"></i>
                                                            <i class="bx bxs-star text-warning"></i>
                                                            <i class="bx bxs-star text-warning"></i>
                                                            <i class="bx bxs-star text-warning"></i>
                                                            <i class="bx bxs-star text-warning"></i>
                                                        @elseif($reviews->rating == 1)
                                                            <i class="bx bxs-star text-warning"></i>
                                                            <i class="bx bxs-star text-secondary"></i>
                                                            <i class="bx bxs-star text-secondary"></i>
                                                            <i class="bx bxs-star text-secondary"></i>
                                                            <i class="bx bxs-star text-secondary"></i>
                                                        @elseif($reviews->rating == 2)
                                                            <i class="bx bxs-star text-warning"></i>
                                                            <i class="bx bxs-star text-warning"></i>
                                                            <i class="bx bxs-star text-secondary"></i>
                                                            <i class="bx bxs-star text-secondary"></i>
                                                            <i class="bx bxs-star text-secondary"></i>
                                                        @elseif($reviews->rating == 3)
                                                            <i class="bx bxs-star text-warning"></i>
                                                            <i class="bx bxs-star text-warning"></i>
                                                            <i class="bx bxs-star text-warning"></i>
                                                            <i class="bx bxs-star text-secondary"></i>
                                                            <i class="bx bxs-star text-secondary"></i>
                                                        @elseif($reviews->rating == 4)
                                                            <i class="bx bxs-star text-warning"></i>
                                                            <i class="bx bxs-star text-warning"></i>
                                                            <i class="bx bxs-star text-warning"></i>
                                                            <i class="bx bxs-star text-warning"></i>
                                                            <i class="bx bxs-star text-secondary"></i>
                                                        @elseif($reviews->rating == 5)
                                                            <i class="bx bxs-star text-warning"></i>
                                                            <i class="bx bxs-star text-warning"></i>
                                                            <i class="bx bxs-star text-warning"></i>
                                                            <i class="bx bxs-star text-warning"></i>
                                                            <i class="bx bxs-star text-warning"></i>
                                                        @endif

                                                    </td>
													<td>
                                                         @if($reviews->status == 'inactive')
                                                          <span class="badge rounded-pill bg-danger">Pending </span>
                                                         @elseif($reviews->status == 'active')
                                                         <span class="badge rounded-pill bg-info">Published</span>
                                                         @endif
                                                    </td>
													<td>
												    <a href="{{ route('updated.review', $reviews->id) }}"> <button  class="btn btn-info btn-sm">Approve</button> </a>
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
										<th rowspan="1" colspan="1">Comment</th>
										<th rowspan="1" colspan="1">User</th>
										<th rowspan="1" colspan="1">Product Name</th>
										<th rowspan="1" colspan="1">Product Image</th>
										<th rowspan="1" colspan="1">Rating</th>
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