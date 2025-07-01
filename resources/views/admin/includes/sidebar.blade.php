<div class="sidebar-wrapper" style="height: 100%; overflow: hidden; background-color: #6BE8D9;" data-simplebar="true">
			<div class="sidebar-header">
				
				<div>
					<h4 class="logo-text">cheaprategallery</h4>
				</div>
				<div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
				</div>
			</div>
			<!--navigation-->
			<ul class="metismenu" id="menu">
				<li>
					<a href="{{ route('admin.dashboard') }}" class="has-arrow">
						<div class="parent-icon"><i class='bx bx-home-circle'></i>
						</div>
						<div class="menu-title">Dashboard</div>
					</a>
					
				</li>
				<!-- for order -->
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="bx bx-category"></i>
						</div>
						<div class="menu-title">Order Managment</div>
					</a>
					<ul>
						<li>
							<a href="javascript:;" class="has-arrow">
								<div class="parent-icon"><i class="bx bx-right-arrow-alt"></i>
								</div>
								<div class="menu-title">Order</div>
							</a>
							<ul>
								<li> 
								   <a href="{{ route('pending.order')}}"><i class="bx bx-right-arrow-alt"></i>New Order/Pending Order</a>
								</li>
								<li> 
								   <a href="{{ route('confirmed.order') }}"><i class="bx bx-right-arrow-alt"></i>Confirmed Order </a>
								</li>
								<li> 
								   <a href="{{ route('proccessing.order') }}"><i class="bx bx-right-arrow-alt"></i>Processing Order</a>
								</li>
								<li> 
								  <a href="{{ route('shiped.order') }}"><i class="bx bx-right-arrow-alt"></i>shiped Order</a>
								</li>
								<li> 
								   <a href="{{ route('delivered.order') }}"><i class="bx bx-right-arrow-alt"></i>Delivered Order</a>
								</li>
								<li> 
								 <a href="{{ route('received.order') }}"><i class="bx bx-right-arrow-alt"></i>received Order</a>
								</li>
								
							</ul>
						</li>

					
						<!-- for distcis state -->
					
					</ul>
				</li>



				 <!-- end menu for order -->
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="bx bx-category"></i>
						</div>
						<div class="menu-title">Category</div>
					</a>
					<ul>
						<li> <a href="{{ route('category')}}"><i class="bx bx-right-arrow-alt"></i>Add Category</a>
						</li>
						<li> <a href="{{ route('manage.category') }}"><i class="bx bx-right-arrow-alt"></i>Manage Category</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="bx bx-category"></i>
						</div>
						<div class="menu-title">Sub Category</div>
					</a>
					<ul>
						<li> <a href="{{ route('subcategory')}}"><i class="bx bx-right-arrow-alt"></i>Add Sub Category</a>
						</li>
						<li> <a href="{{ route('manage.subcategory') }}"><i class="bx bx-right-arrow-alt"></i>Manage Sub Category</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="bx bx-category"></i>
						</div>
						<div class="menu-title">Brands</div>
					</a>
					<ul>
						<li> <a href="{{ route('brand')}}"><i class="bx bx-right-arrow-alt"></i>Add Brands</a>
						</li>
						<li> <a href="{{ route('manage.brand') }}"><i class="bx bx-right-arrow-alt"></i>Manage Brands</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="bx bx-category"></i>
						</div>
						<div class="menu-title">Products</div>
					</a>
					<ul>
						<li> <a href="{{ route('product')}}"><i class="bx bx-right-arrow-alt"></i>Add Products</a>
						</li>
						<li> <a href="{{ route('manage.product') }}"><i class="bx bx-right-arrow-alt"></i>Manage Products</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="bx bx-category"></i>
						</div>
						<div class="menu-title">Review Managment</div>
					</a>
					<ul>
						<li> <a href="{{ route('pending.review')}}"><i class="bx bx-right-arrow-alt"></i>Pending Review</a>
						</li>
						<li> <a href="{{ route('published.review') }}"><i class="bx bx-right-arrow-alt"></i>Published Review</a>
						</li>
					</ul>
				</li>

				<!-- menu for adding slider -->
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="bx bx-category"></i>
						</div>
						<div class="menu-title">Slider Managment</div>
					</a>
					<ul>
						<li> <a href="{{ route('add.slider')}}"><i class="bx bx-right-arrow-alt"></i>Add Slider</a>
						</li>
						<li> <a href="{{ route('slider.manage') }}"><i class="bx bx-right-arrow-alt"></i>Slider Manage</a>
						</li>
					</ul>
				</li>

				<!-- This menu is for shipping area managment -->
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="bx bx-category"></i>
						</div>
						<div class="menu-title">Delivery Area</div>
					</a>
					<ul>
						<li>
							<a href="javascript:;" class="has-arrow">
								<div class="parent-icon"><i class="bx bx-right-arrow-alt"></i>
								</div>
								<div class="menu-title">Division</div>
							</a>
							<ul>
								<li> 
								<a href="{{ route('shipping.division')}}"><i class="bx bx-right-arrow-alt"></i>Add Division</a>
								</li>
								<li> <a href="{{ route('show_division')}}"><i class="bx bx-right-arrow-alt"></i>Division Manage</a>
								</li>
							</ul>
						</li>

					 <!-- for districs -->
					   <li>
							<a href="javascript:;" class="has-arrow">
								<div class="parent-icon"><i class="bx bx-right-arrow-alt"></i>
								</div>
								<div class="menu-title">Distric</div>
							</a>
							<ul>
							   <li> <a href="{{ route('distric') }}"><i class="bx bx-right-arrow-alt"></i>Add Districs</a>
						       </li>
							   <li> <a href="{{ route('showDistric') }}"><i class="bx bx-right-arrow-alt"></i>Manage Districs</a>
						       </li>
							</ul>
						</li>	
						<!-- for distcis state -->
						<li>
							<a href="javascript:;" class="has-arrow">
								<div class="parent-icon"><i class="bx bx-right-arrow-alt"></i>
								</div>
								<div class="menu-title">State</div>
							</a>
							<ul>
							   <li> <a href="{{ route('distric_state') }}"><i class="bx bx-right-arrow-alt"></i>Add State</a>
						       </li>
							   <li> <a href="{{ route('show_state') }}"><i class="bx bx-right-arrow-alt"></i>Manage State</a>
						       </li>
							</ul>
						</li>	
					</ul>
				</li>



			</ul>
			<!--end navigation-->
		</div>