{{-- Project 2: Admin  dashboard main layouts or app file page every admin section is connected with
	this main layouts --}}
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>@yield('title')</title>
		<!-- Google Font: Source Sans Pro -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
		<!-- Font Awesome -->
		<link rel="stylesheet" href="{{asset('assets/admin/plugins/fontawesome-free/css/all.min.css')}}">
		
		<link rel="stylesheet" href="{{asset('assets/admin/plugins/dropzone/min/dropzone.min.css')}}">
		<!-- Theme style -->
		<link rel="stylesheet" href="{{asset('assets/admin/css/adminlte.min.css')}}">
		{{-- Dashboard Icon --}}
		<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
		{{-- Dashboard visitor track--}}
		
		<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

		
		<link rel="stylesheet" href="{{asset('assets/admin/plugins/summernote/summernote-bs4.min.css')}}">

		<link rel="stylesheet" href="{{asset('assets/admin/plugins/select2/css/select2.min.css')}}">
		<link rel="stylesheet" href="{{asset('assets/admin/css/datetimepicker.css')}}">
		<!-- Scripts -->
		<link rel="stylesheet" href="{{asset('assets/admin/css/custom.css')}} ">
		<link rel="stylesheet" href="{{asset('assets/site/css/toastr.min.css')}} ">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		@yield('css')
	</head>
	<body class="hold-transition sidebar-mini">
		<!-- Site wrapper -->
		<div class="wrapper">
			<!-- Navbar -->
			<nav class="main-header navbar navbar-expand navbar-white navbar-light">
				<!-- Right navbar links -->
				<ul class="navbar-nav">
					<li class="nav-item">
					  	<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
					</li>					
				</ul>
				<div class="navbar-nav pl-2">
					<!-- <ol class="breadcrumb p-0 m-0 bg-white">
						<li class="breadcrumb-item active">Dashboard</li>
					</ol> -->
				</div>
				
				<ul class="navbar-nav ml-auto">
					<li class="nav-item">
						<a class="nav-link" data-widget="fullscreen" href="#" role="button">
							<i class="fas fa-expand-arrows-alt"></i>
						</a>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link p-0 pr-3" data-toggle="dropdown" href="#">
							<img src="{{asset('assets/site/img/Azahar.jpg')}}" class='img-circle elevation-2' width="40" height="40" alt="">
						</a>
						<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-3">
							<h4 class="h4 mb-0"><strong>{{Auth::guard('admin')->name }}</strong></h4>
							<div class="mb-3">{{ Auth::guard('admin')->check() ? Auth::guard('admin')->user()->email : 'Email Not Found' }}
						
							</div>
							<div class="dropdown-divider"></div>
							<a href="{{route('admin.showChangePasswordForm')}}" class="dropdown-item">
								<i class="fas fa-user-cog mr-2"></i> Settings								
							</a>
							<div class="dropdown-divider"></div>
							<a href="#" class="dropdown-item">
								<i class="fas fa-lock mr-2"></i> Change Password
							</a>
							<div class="dropdown-divider"></div>
							
								
							<a class="dropdown-item text-danger" href="{{ route('admin.logout') }}"
							onclick="event.preventDefault();
										document.getElementById('logout-form').submit();">
								{{ __('Logout') }}
							</a>
							<form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
								@csrf
							</form>

														
						</div>
					</li>
				</ul>
			</nav>
			<!-- /.navbar -->
			<!-- Main Sidebar Container -->
			@include('layouts.sidebar')
			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				@yield('content')
			</div>
			<!-- /.content-wrapper -->
			<footer class="main-footer">
				
				<strong>Copyright &copy; 2024-{{ date('Y') }} developed by  <a href="https://sagoralibd.top/" target="_blank"> SagorAliBD</a>; All rights reserved <a href="https://www.youtube.com/c/w3techbd" target="_blank">w3techbd.</strong>
			</footer>
			
		</div>
	<!-- ./wrapper -->
	<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
		<!-- jQuery -->
		<script src="{{asset('assets/admin/plugins/jquery/jquery.min.js')}}"></script>
		
		<!-- Bootstrap 4 -->
		<script src="{{asset('assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
		<!-- AdminLTE App -->
		
		<script src="{{asset('assets/admin/js/adminlte.min.js')}}"></script>

		{{-- <script src="plugins/summernote/summernote-bs4.min.js"></script> --}}
		<script src="{{asset('assets/admin/plugins/summernote/summernote.min.js')}}"></script>
		
		{{-- <script src="{{asset('assets/admin/plugins/summernote/summernote-bs4.min.js')}}"></script> --}}
		
		<script src="{{asset('assets/admin/plugins/select2/js/select2.min.js')}}"></script> {{-- Select 2 --}}

		<script src="{{asset('assets/admin/plugins/dropzone/min/dropzone.min.js')}}"></script>
		<!-- AdminLTE for demo purposes -->
		
		<script src="{{asset('assets/admin/js/demo.js')}}"></script>
		<script src="{{asset('assets/admin/js/datetimepicker.js')}}"></script>
		<script src="{{asset('assets/site/js/toastr.min.js')}}"></script>

		<script type="text/javascript">
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csft-token"]').attr('content')
				}
			});

			$("document").ready(function(){
				$(".summernote").summernote({
					height: '250px'
				});
			} );
		</script>
		<script type="text/javascript">
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csft-token"]').attr('content')
				}
			});

			$("document").ready(function(){
				$(".summernote-1").summernote({
					height: '120px'
				});
			} );
		</script>
		@yield('scripts')
	</body>
</html>