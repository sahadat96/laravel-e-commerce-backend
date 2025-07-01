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
										<h5 class="mb-0 text-info">Add Slider</h5>
									</div>
									<hr>
									<form action="{{ route('create.slider') }}" method="POST" enctype="multipart/form-data" >
									 @csrf
									   <div class="row mb-3">
                                            <label  for="cat_name" class=" col-sm-3 col-form-label">Slider Title</label>
                                            <div class="col-sm-9">
                                                <input name="slider_title" type="text" class=" form-control" id="cat_name" placeholder="Enter Slider Title">
                                            </div>
										</div>
                                        <div class="row mb-3">
                                            <label  for="cat_name" class=" col-sm-3 col-form-label">Slider Category</label>
                                            <div class="col-sm-9">
                                                <input name="slider_category" type="text" class=" form-control" id="cat_name" placeholder="Enter Slider Category">
                                            </div>
										</div>
                                        <div class="row mb-3">
                                            <label  for="cat_name" class=" col-sm-3 col-form-label">Slider Description</label>
                                            <div class="col-sm-9">
                                                <input name="slider_description" type="text" class=" form-control" id="cat_name" placeholder="Enter Slider Description">
                                            </div>
										</div>
										<div class="row mb-3">
											<label for="" class="col-sm-3 col-form-label">Slider Image</label>
											<div class="col-sm-9">
                                            <input onchange="imagePre(this)" name="slide_image" class="form-control" id="image-uploadify" type="file" accept="image/*," >
					                          <br>
                                           <img height="210" wide="210" src="" alt="" id="imageView">
											</div>
										</div>
										
										<div class="row">
											<label class="col-sm-3 col-form-label"></label>
											<div class="col-sm-9">
												<button type="submit" class="btn btn-info px-5">Add New Slider</button>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
@endsection