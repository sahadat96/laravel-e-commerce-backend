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
										<h5 class="mb-0 text-info">Add State</h5>
									</div>
									<hr>
									<form action="{{ route('add_state') }}" method="POST" enctype="multipart/form-data">
										@csrf

										<div class="row mb-3">
											@if (Session::has('message'))
												<div class="alert alert-success">{{ Session::get('message') }}</div>
											@endif
											<label for="division" class="col-sm-3 col-form-label">Select Division</label>
											<div class="col-sm-6">
												<select name="division_id" class="form-control">
													<option>Select Division</option>
													@foreach($show_division as $show_divisions)
														<option value="{{ $show_divisions->id }}">{{ $show_divisions->division_name }}</option>
													@endforeach
												</select>
											</div>    
										</div>

										<div class="row mb-3">
											<label for="district" class="col-sm-3 col-form-label">Select District</label>
											<div class="col-sm-6">
												<select name="district_id" class="form-control">
													<option></option>
												</select>
											</div>    
										</div>

										<div class="row mb-3">
											<label for="cat_name" class="col-sm-3 col-form-label">State Name</label>
											<div class="col-sm-6">
												<input required name="state_name" type="text" class="form-control" id="cat_name" placeholder="Enter District">
											</div>
										</div>    

										<div class="row">
											<label class="col-sm-3 col-form-label"></label>
											<div class="col-sm-9">
												<button type="submit" class="btn btn-info px-5">Add State</button>
											</div>
										</div>
									</form>

									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				

				<script type="text/javascript">
					$(document).ready(function() {
						$('select[name="division_id"]').on('change', function() {
							var division_id = $(this).val();
							if (division_id) {
								$.ajax({
									url: "{{ route('district.ajax', '') }}/" + division_id,
									type: "GET",
									dataType: "json",
									success: function(data) {
										$('select[name="district_id"]').html('');
										$.each(data, function(key, value) {
											$('select[name="district_id"]').append('<option value="' + value.id + '">' + value.distric_name + '</option>');
										});
									},
									error: function(jqXHR, textStatus, errorThrown) {
										console.log(textStatus, errorThrown);
									}
								});
							} else {
								alert('Please select a division.');
							}
						});
					});
				</script>


				
@endsection