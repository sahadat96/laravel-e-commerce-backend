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
										<th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 30px">Sl</th>
										<th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 430.078px;">Division Name</th>
										<th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 430.078px;">Distric Name</th>
										<th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 430.078px;">State Name</th>
										<th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 100px;">Action</th>
									</tr>
									
								</thead>
								<tbody>	
										@php $sl = 1; @endphp
											@if(count($get_state) > 0)
												@foreach($get_state as $get_states) 
											   <tr >
													<td>{{ $sl }}</td>
													<td >{{ $get_states->areadivision->division_name }}</td>
													<td >{{ $get_states->distric->distric_name }}</td>
													<td >{{ $get_states->state_name }}</td>
													<td >
												        <a href="{{ route('state_delete', $get_states->id) }}"> <button  class="btn btn-danger btn-sm">Delete</button> </a>
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
										<th rowspan="1" colspan="1">Division Name</th>
										<th rowspan="1" colspan="1">Distric Name</th>
										<th rowspan="1" colspan="1">state Name</th>
										<th rowspan="1" colspan="1">Action </th>
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