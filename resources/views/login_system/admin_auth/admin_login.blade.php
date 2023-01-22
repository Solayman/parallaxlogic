<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Parallaxlogic</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!--===============================================================================================-->
		<link rel="icon" type="image/png" href="{{asset('assets/auth_asset/admin_auth_system/images/icons/favicon.ico')}}"/>
		<!--===============================================================================================-->
		<link rel="stylesheet" type="text/css" href="{{asset('assets/auth_asset/admin_auth_system/vendor/bootstrap/css/bootstrap.min.css')}}">
		<!--===============================================================================================-->
		<link rel="stylesheet" type="text/css" href="{{asset('assets/auth_asset/admin_auth_system/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
		<!--===============================================================================================-->
		<link rel="stylesheet" type="text/css" href="{{asset('assets/auth_asset/admin_auth_system/fonts/Linearicons-Free-v1.0.0/icon-font.min.css')}}">
		<!--===============================================================================================-->
		<link rel="stylesheet" type="text/css" href="{{asset('assets/auth_asset/admin_auth_system/vendor/animate/animate.css')}}">
		<!--===============================================================================================-->
		<link rel="stylesheet" type="text/css" href="{{asset('assets/auth_asset/admin_auth_system/vendor/css-hamburgers/hamburgers.min.css')}}">
		<!--===============================================================================================-->
		<link rel="stylesheet" type="text/css" href="{{asset('assets/auth_asset/admin_auth_system/vendor/animsition/css/animsition.min.css')}}">
		<!--===============================================================================================-->
		<link rel="stylesheet" type="text/css" href="{{asset('assets/auth_asset/admin_auth_system/vendor/select2/select2.min.css')}}">
		<!--===============================================================================================-->
		<link rel="stylesheet" type="text/css" href="{{asset('assets/auth_asset/admin_auth_system/vendor/daterangepicker/daterangepicker.css')}}">
		<!--===============================================================================================-->
		<link rel="stylesheet" type="text/css" href="{{asset('assets/auth_asset/admin_auth_system/css/util.css')}}">
		<link rel="stylesheet" type="text/css" href="{{asset('assets/auth_asset/admin_auth_system/css/main.css')}}">
		<!--===============================================================================================-->
	</head>
	<body>

		<div class="limiter">
			<div class="container-login100">
				<div class="wrap-login100 p-t-90 p-b-30">
					@if ($message = Session::get('warning'))
					<div class="alert alert-dark alert-block">
						<button type="button" class="close" data-dismiss="alert">×</button>
						<strong class="text-dark font-weight">{{ $message }}</strong>
					</div>
					@endif
					@if ($message = Session::get('success'))
					<div class="alert alert-success alert-block">
						<button type="button" class="close" data-dismiss="alert">×</button>
						<strong class="text-dark font-weight">{{ $message }}</strong>
					</div>
					@endif
					<form class="login100-form validate-form" action="{{url('login-status')}}" method="post">
						@csrf
						<span class="login100-form-title p-b-40 text-info ">
							<span class="text-danger">Parallaxlogic</span> Login
						</span>


						<div class="wrap-input100 validate-input m-b-16" data-validate="Please enter email: ex@abc.xyz">
							<input class="input100" type="email" name="email" placeholder="Email">
							<span class="focus-input100"></span>
							@error('email')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
							@enderror
							<span style="color: red;" class="text-danger"> {{$errors->first('email')}}</span>
						</div>
						<div class="wrap-input100 validate-input m-b-20" data-validate = "Please enter password">
							<span class="btn-show-pass">
								<i class="fa fa fa-eye"></i>
							</span>
							<input class="input100" type="password" name="password" placeholder="Password">
							<span class="focus-input100"></span>
							<span style="color: red;" class="text-danger"> {{$errors->first('password')}}</span>
							@error('email')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
							@enderror
						</div>
						<p class="text-center mb-3"><input type="checkbox" value="remember" name="remember"><span> Remember me</span></p>
						<div class="container-login100-form-btn">
							<button class="login100-form-btn">
							Login
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>


		<!--===============================================================================================-->
		<script src="{{asset('assets/auth_asset/admin_auth_system/vendor/jquery/jquery-3.2.1.min.js')}}"></script>
		<!--===============================================================================================-->
		<script src="{{asset('assets/auth_asset/admin_auth_system/vendor/animsition/js/animsition.min.js')}}"></script>
		<!--===============================================================================================-->
		<script src="{{asset('assets/auth_asset/admin_auth_system/vendor/bootstrap/js/popper.js')}}"></script>
		<script src="{{asset('assets/auth_asset/admin_auth_system/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
		<!--===============================================================================================-->
		<script src="{{asset('assets/auth_asset/admin_auth_system/vendor/select2/select2.min.js')}}"></script>
		<!--===============================================================================================-->
		<script src="{{asset('assets/auth_asset/admin_auth_system/vendor/daterangepicker/moment.min.js')}}"></script>
		<script src="{{asset('assets/auth_asset/admin_auth_system/vendor/daterangepicker/daterangepicker.js')}}"></script>
		<!--===============================================================================================-->
		<script src="{{asset('assets/auth_asset/admin_auth_system/vendor/countdowntime/countdowntime.js')}}"></script>
		<!--===============================================================================================-->
		<script src="{{asset('assets/auth_asset/admin_auth_system/js/main.js')}}"></script>
	</body>
</html>
