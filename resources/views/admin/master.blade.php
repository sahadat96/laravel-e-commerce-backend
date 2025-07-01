<!doctype html>
<html lang="en">

 @include('admin.includes.head')

<body>
	<!--wrapper-->
	<div class="wrapper">
		<!--sidebar wrapper -->
		  @include('admin.includes.sidebar')
		<!--end sidebar wrapper -->

		<!--start header -->
		  @include('admin.includes.header')
		<!--end header -->

		<!--start page wrapper -->
		<div class="page-wrapper">
			<div class="page-content">
					@yield('admin')
		</div>
		<!--end page wrapper -->
		<!--start overlay-->
		<div class="overlay toggle-icon"></div>
		<!--end overlay-->
		<!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
		<!--End Back To Top Button-->
	@include('admin.includes.footer')
	</div>
	<!--end wrapper-->
	<!--start switcher-->
	@include('admin.includes.switcher')
	<!--end switcher-->

	@include('admin.includes.js')
</body>

</html>