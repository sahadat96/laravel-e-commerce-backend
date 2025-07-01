<!-- Bootstrap JS -->
<script src="{{ asset('backend') }}/assets/js/bootstrap.bundle.min.js"></script>
	<!--plugins-->
	<script src="{{ asset('backend') }}/assets/plugins/simplebar/js/simplebar.min.js"></script>
	<script src="{{ asset('backend') }}/assets/plugins/metismenu/js/metisMenu.min.js"></script>
	<script src="{{ asset('backend') }}/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
	<script src="{{ asset('backend') }}/assets/plugins/chartjs/js/Chart.min.js"></script>
	<script src="{{ asset('backend') }}/assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="{{ asset('backend') }}/assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js"></script>
	<script src="{{ asset('backend') }}/assets/plugins/jquery.easy-pie-chart/jquery.easypiechart.min.js"></script>
	<script src="{{ asset('backend') }}/assets/plugins/sparkline-charts/jquery.sparkline.min.js"></script>
	<script src="{{ asset('backend') }}/assets/plugins/jquery-knob/excanvas.js"></script>
	<script src="{{ asset('backend') }}/assets/plugins/jquery-knob/jquery.knob.js"></script>
		<script>
			$(function() {
				$(".knob").knob();
			});
		</script>
	  <script src="{{ asset('backend') }}/assets/js/index.js"></script>
	<!--app JS-->
	<script src="{{ asset('backend') }}/assets/js/app.js"></script>
	<script src="{{ asset('backend') }}/assets/js/ajas_backend.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
	<script src="https:////cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
	<script>
       toastr.options ={
          "closeButton": true,
             "progressBar": true,
             }

          @if (Session::has('message'))
               toastr.success(" {{ session('message') }} ");
          @endif
     </script>
	 <script>
        let table = new DataTable('#sohel');
     </script>

     <script src="{{ asset('backend') }}/assets/plugins/input-tags/js/tagsinput.js"></script>

    <script>
		function imagePre(imageInput){
            if(imageInput.files && imageInput.files[0]){
                 var reader = new FileReader;
				 reader.onload = function (e){
					$("#imageView").attr('src',e.target.result);
				 }
				 reader.readAsDataURL(imageInput.files[0]);
			}
		}
	</script>
	