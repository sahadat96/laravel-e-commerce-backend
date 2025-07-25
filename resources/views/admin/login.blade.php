
<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
	<link rel="icon" href="{{ asset('backend')}}/assets/images/favicon-32x32.png" type="image/png" />
	<!--plugins-->
	<link href="{{ asset('backend')}}/assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
	<link href="{{ asset('backend')}}/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
	<link href="{{ asset('backend')}}/assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
	<!-- loader-->
	<link href="{{ asset('backend')}}/assets/css/pace.min.css" rel="stylesheet" />
	<script src="{{ asset('backend')}}/assets/js/pace.min.js"></script>
	<!-- Bootstrap CSS -->
	<link href="{{ asset('backend')}}/assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="{{ asset('backend')}}/assets/css/bootstrap-extended.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
	<link href="{{ asset('backend')}}/assets/css/app.css" rel="stylesheet">
	<link href="{{ asset('backend')}}/assets/css/icons.css" rel="stylesheet">
	<title>admin-cheaprategallery.com</title>
</head>

<body class="bg-login">
	<!--wrapper-->
	<div class="wrapper">
		<div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
			<div class="container-fluid">
				<div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
					<div class="col mx-auto">
						<div class="mb-4 text-center">
							<img src="{{ asset('backend')}}/assets/images/" width="180" alt="" />
						</div>
						<div class="card">
							<div class="card-body">
								<div class="border p-4 rounded">
									<div class="text-center">
										<h3 class="">Sign in</h3>
										
									</div><br>
									<br>
									<div class="form-body">
										<form action="{{ route('login') }}" method="POST" class="row g-3">
                                            @csrf
											<div class="col-12">
												<label for="inputEmailAddress" class="form-label">Email Address</label>
												<input name="email" type="email" class="form-control" id="inputEmailAddress" placeholder="Email Address">
                                                <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger" />

											</div>
											<div class="col-12">
												<label for="inputChoosePassword" class="form-label">Enter Password</label>
												<div class="input-group" id="show_hide_password">
													<input name="password" type="password" class="form-control border-end-0" id="inputChoosePassword" value="12345678" placeholder="Enter Password"> <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
                                                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-danger" />

												</div>
												 
											</div>
											<div class="login_footer form-group">
                                                <div class="chek-form">
                                                    <input type="text"  name="security"  required placeholder="Security code *" />
                                                    @error('security')
                                                     <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                    @error('code')
                                                     <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                  @php
                                                    $code = rand(10, 10000)
                                                  @endphp
                                                <span class="security-code">    
                                                    <b class="text-new">{{ $code }}</b>
                                                    <input readonly type="hidden" name="code" value="{{ $code }}" required>
                                                </span>
                                            </div>
											<div class="col-12">
												<div class="d-grid">
													<button type="submit" class="btn btn-primary"><i class="bx bxs-lock-open"></i>Sign in</button>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--end row-->
			</div>
		</div>
	</div>
	<!--end wrapper-->
	<!-- Bootstrap JS -->
	<script src="{{ asset('backend')}}/assets/js/bootstrap.bundle.min.js"></script>
	<!--plugins-->
	<script src="{{ asset('backend')}}/assets/js/jquery.min.js"></script>
	<script src="{{ asset('backend')}}/assets/plugins/simplebar/js/simplebar.min.js"></script>
	<script src="{{ asset('backend')}}/assets/plugins/metismenu/js/metisMenu.min.js"></script>
	<script src="{{ asset('backend')}}/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
	<!--Password show & hide js -->
	<script>
		$(document).ready(function () {
			$("#show_hide_password a").on('click', function (event) {
				event.preventDefault();
				if ($('#show_hide_password input').attr("type") == "text") {
					$('#show_hide_password input').attr('type', 'password');
					$('#show_hide_password i').addClass("bx-hide");
					$('#show_hide_password i').removeClass("bx-show");
				} else if ($('#show_hide_password input').attr("type") == "password") {
					$('#show_hide_password input').attr('type', 'text');
					$('#show_hide_password i').removeClass("bx-hide");
					$('#show_hide_password i').addClass("bx-show");
				}
			});
		});
	</script>
	<!--app JS-->
	<script src="{{ asset('backend')}}/assets/js/app.js"></script>
</body>

</html>