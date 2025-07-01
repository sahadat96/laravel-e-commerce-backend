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
										<h5 class="mb-0 text-info">Add Category</h5>
									</div>
									<hr>
									<form action="{{ route('update.category', $category->id) }}" method="POST" enctype="multipart/form-data" >
									 @csrf
									<div class="row mb-3">
									 @if (Session::has('message'))
         							 @endif
											<label  for="cat_name" class=" col-sm-3 col-form-label">Category name</label>
											<div class="col-sm-9">
												<input value="{{ $category->cat_name }}" name="cat_name" type="text" class=" form-control" id="cat_name">
											</div>
										</div>
										<div class="row mb-3">
											<label for="" class="col-sm-3 col-form-label">Category Image</label>
											<div class="col-sm-9">
												<input name="cat_image" type="file" class="form-control cat_image"  id="">
                                                <br>
                                                <img class="imagePre" src="{{ asset('uploads/category/'.$category->cat_image) }}" alt="" height="150" width="150">
											</div>
										</div>
										<div class="row">
											<label class="col-sm-3 col-form-label"></label>
											<div class="col-sm-9">
												<button type="submit" class="btn btn-info px-5">Add New</button>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

                <script>
                    jQuery(".cat_image").change(".cat_image",function(){
                        let reader = new FileReader();
                        var file = document.querySelector('.cat_image').files[0];
                        reader.onload = function(e){
                            jQuery(".imagePre").attr('src',e.target.result);
                        }
                        reader.readAsDataURL(file);

                    })
              </script>
@endsection