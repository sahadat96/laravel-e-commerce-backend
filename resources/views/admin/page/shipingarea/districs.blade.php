@extends('admin.master')
@section('admin')
<div class="row">
					<div class="col-xl-9 mx-auto">

					  
						<hr>
						<div class="card border-top border-0 border-4 border-info">
							<div class="card-body">
								<div class="border p-4 rounded">
									<div class="card-title d-flex align-items-center">
										<div><i class="bx bxs-user me-1 font-22 text-info"></i>
										</div>
										<h5 class="mb-0 text-info">Add Distric</h5>
									</div>
									<hr>
									<form action="{{ route('add_distric') }}" method="POST" enctype="multipart/form-data" >
									 @csrf
									 	
									<div class="row mb-3">
										@if (Session::has('message'))
										@endif
												<label for="division" class=" col-sm-3 col-form-label">Select Division</label>
											<div class="col-sm-6">
												<select name="division_id" id="division" class="form-control" >
													<option > Select Division</option>
													@foreach($show_division as $show_divisions)
														<option value="{{ $show_divisions->id }}">{{ $show_divisions->division_name }}</option>
													@endforeach
													</select>
											</div>	
										</div>
										<div class="row mb-3">
										@if (Session::has('message'))
										@endif
												<label for="cat_name" class=" col-sm-3 col-form-label">Distric name</label>
												<div class="col-sm-6">
													<input required name="distric_name" type="text" class=" form-control" id="cat_name" placeholder="Enter Distric">
												</div>
                                     </div>	
										<div class="row">
											<label class="col-sm-3 col-form-label"></label>
											<div class="col-sm-9">
												<button type="submit" class="btn btn-info px-5">Add Distric</button>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
@endsection