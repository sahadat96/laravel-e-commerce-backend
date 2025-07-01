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
										<h5 class="mb-0 text-info">Add Division</h5>
									</div>
									<hr>
									<form action="{{ route('add.division') }}" method="POST" enctype="multipart/form-data" >
                                            @csrf
                                            <div class="row mb-3">
                                              
                                                        <label for="division_name" class=" col-sm-3 col-form-label">Division name :</label>
                                                        <div class="col-sm-6">
                                                            <input required name="division_name" type="text" class=" form-control" id="division_name" placeholder="Enter Division Name">
                                                        </div>
                                            </div>		
                                                <div class="row">
                                                    <label class="col-sm-3 col-form-label"></label>
                                                    <div class="col-sm-9">
                                                        <button type="submit" class="btn btn-info px-5">Add New</button>
                                                 </div>
										
									           </div>
                                    </form>
								</div>
							</div>
						</div>
					</div>
				</div>
@endsection