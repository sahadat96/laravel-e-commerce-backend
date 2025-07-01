@extends('admin.master')
@section('admin')
<div class="page-content">

<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
	<div class="breadcrumb-title pe-3">eCommerce</div>
	<div class="ps-3">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb mb-0 p-0">
				<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
				</li>
				<li class="breadcrumb-item active" aria-current="page">Add New Product</li>
			</ol>
		</nav>
	</div>
	
</div>
<!--end breadcrumb-->

<div class="card">
  <div class="card-body p-4">
	  <h5 class="card-title">Add New Product</h5>
	  <hr>
	   <div class="form-body mt-4">
		<div class="row">
		   <div class="col-lg-8">
		   <div class="border border-3 p-4 rounded">
			<form action="{{ route('add.product') }}" method="POST" enctype="multipart/form-data">
				@csrf
			<div class="mb-3">
				<label for="inputProductTitle" class="form-label">Product Name</label>
				<input name="product_name" type="text" class="form-control" id="inputProductTitle" placeholder="Enter Product name">
			  </div>
			  <div class="mb-3">
				<label for="">Product Color</label>
			     <input name="product_color" type="text" class="form-control visually-hidden" data-role="tagsinput" value="Red, Black,White, Blue">
			  </div>
			  <div class="mb-3">
				<label for="">Product Size</label>
			     <input name="product_size" type="text" class="form-control visually-hidden" data-role="tagsinput" value="S, M, L, XL">
			  </div>
			  <div class="mb-3">
				<label for="">Product Tags</label>
			     <input name="product_tags" type="text" class="form-control visually-hidden" data-role="tagsinput" value="">
			  </div>
			  <div class="mb-3">
				<label for="inputProductDescription" class="form-label">Short Description</label>
				<textarea name="short_desc" class="form-control" id="inputProductDescription" rows="3"></textarea>
			  </div>
			  <div class="mb-3">
				<label for="inputProductDescription" class="form-label">Long Description</label>
				<textarea name="long_desc" class="form-control" id="long_desc" rows="3"></textarea>
			  </div>
			  <div class="mb-3">
					<label for="inputProductDescription" class="form-label">Product Images</label>
					 <input onchange="imagePre(this)" name="image" class="form-control" id="image-uploadify" type="file" accept=".xlsx,.xls,image/*,.doc,audio/*,.docx,video/*,.ppt,.pptx,.txt,.pdf" >
					 <br>
                       <img height="120" wide="120" src="" alt="" id="imageView">
					   
						<div class="imageuploadify well">
						</div>
					    <br>
					<div class="mb-3">
					<label for="inputProductDescription" class="form-label">Images gallery</label>
					<input name="images[]" class="form-control" id="image-uploadify" type="file" accept=".xlsx,.xls,image/*,.doc,audio/*,.docx,video/*,.ppt,.pptx,.txt,.pdf" multiple="" >
			   </div>
			  </div>
			</div>
		   </div>
		   <div class="col-lg-4">
			<div class="border border-3 p-4 rounded">
			  <div class="row g-3">
				<div class="col-md-6">
					<label for="inputPrice" class="form-label">Sell Price</label>
					<input name="product_price" type="text" class="form-control" id="inputPrice" placeholder="00.00">
				  </div>
				  <div class="col-md-6">
					<label for="inputCompareatprice" class="form-label">Discount Price</label>
					<input name="discount_price" type="text" class="form-control" id="inputCompareatprice" placeholder="00.00">
				  </div>
				  <div class="col-md-6">
					<label for="inputCompareatprice" class="form-label">Delivery charge</label>
					<input name="delivery_Charge" type="text" class="form-control" id="inputCompareatprice" placeholder="00.00">
				  </div>
				  <div class="col-md-6">
					<label for="inputStarPoints" class="form-label">Product Code</label>
					<input name="product_code" type="text" class="form-control" id="inputStarPoints" placeholder="">
				  </div>
				  <div class="col-md-6">
					<label for="inputStarPoints" class="form-label">Quantity</label>
					<input name="quantity" type="text" class="form-control" id="inputStarPoints" placeholder="">
				  </div>

				  <div class="mb-3">
					<label for="" class="form-label">Category</label>
					<select name="cat_id" id="" class="form-select">
						<option value="cat_id"> - Select Category -</option>
						@foreach($categories as $category)
						   <option value="{{ $category->id }}">{{ $category->cat_name }}</option>
						@endforeach
					</select>
				  </div>
				  <div class="mb-3">
					<label for="" class="form-label">Sub Category</label>
					<select name="sub_cat_id" id="" class="form-select">
						<option value="sub_cat_id">- Sub Category -</option>
						@foreach($subcategories as $subcat)
						   <option value="{{ $subcat->id }}">{{ $subcat->subcat_name }}</option>
						@endforeach
					</select>
				  </div>
				  <div class="mb-3">
					<label for="" class="form-label">Brands</label>
					<select name="brand_id" id="" class="form-select">
						<option value="brand_id">- Brands -</option>
						@foreach($brands as $brand)
						   <option value="{{ $brand->id }}">{{ $brand->name }}</option>
						@endforeach
					</select>
				  </div>
				  <div class="col-md-6">
					<label for="inputStarPoints" class="form-label">Operator Phone </label>
					<input name="operator_phone" type="text" class="form-control" id="inputStarPoints" placeholder="">
				  </div>
				  <div class="mb-3">
					<label for="" class="form-label">Vendor</label>
					<select name="vendor_id" id="" class="form-select">
						<option value="vendor_id">- Vendor -</option>
						@foreach($vendors as $vendor)
						   <option value="{{ $vendor->id }}">{{ $vendor->shop_name }}</option>
						@endforeach
					</select>
				  </div>
				  <div class="col-6">
				      <div class="form-check">
						<input name="hot_deal" class="form-check-input" type="checkbox" value="Hot Deals" id="">
						<label class="form-check-label" for="flexCheckChecked">Hot Deals</label>
					</div>
				  </div>
				  <div class="col-6">
				      <div class="form-check">
						<input name="special_offer" class="form-check-input" type="checkbox" value="Special Offer" id="" >
						<label class="form-check-label" for="flexCheckChecked">Special Offer</label>
					</div>
				  </div>
				  <div class="col-6">
				      <div class="form-check">
						<input name="special_deal" class="form-check-input" type="checkbox" value="Special Deals" id="" >
						<label class="form-check-label" for="flexCheckChecked">Special Deals</label>
					</div>
				  </div>
				  <div class="col-6">
				      <div class="form-check">
						<input name="featured" class="form-check-input" type="checkbox" value="Featured" id="" checked="">
						<label class="form-check-label" for="flexCheckChecked">Popular Products</label>
					</div>
				  </div>
				  <div class="col-12">
					  <div class="d-grid">
						 <button class="btn btn-primary">Save Product</button>
					  </div>
				  </div>
			  </div> 
            </form>
		  </div>
		  </div>
	   </div><!--end row-->
	</div>
  </div>
 </div>
</div>
@endsection