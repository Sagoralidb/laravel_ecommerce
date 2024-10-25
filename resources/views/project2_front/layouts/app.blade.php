{{-- Project 2: Created for Layout  --}}

<!DOCTYPE html>
<html class="no-js" lang="en_AU" />
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>@yield('title','Ecommerce Shop')</title>
	<meta name="description" content="" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, maximum-scale=1, user-scalable=no" />

	<meta name="HandheldFriendly" content="True" />
	<meta name="pinterest" content="nopin" />

	<meta property="og:locale" content="en_AU" />
	<meta property="og:type" content="website" />
	<meta property="fb:admins" content="" />
	<meta property="fb:app_id" content="" />
	<meta property="og:site_name" content="" />
	<meta property="og:title" content="" />
	<meta property="og:description" content="" />
	<meta property="og:url" content="" />
	<meta property="og:image" content="" />
	<meta property="og:image:type" content="image/jpeg" />
	<meta property="og:image:width" content="" />
	<meta property="og:image:height" content="" />
	<meta property="og:image:alt" content="" />

	<meta name="twitter:title" content="" />
	<meta name="twitter:site" content="" />
	<meta name="twitter:description" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:image:alt" content="" />
	<meta name="twitter:card" content="summary_large_image" />
	

	<link rel="stylesheet" type="text/css" href="{{asset('public/front-asset(project2)/css/rating.css')}}" />
	<link rel="stylesheet" type="text/css" href="{{asset('public/front-asset(project2)/css/slick.css')}}" />
	<link rel="stylesheet" type="text/css" href="{{asset('public/front-asset(project2)/css/slick-theme.css')}}" />
	<link rel="stylesheet" type="text/css" href="{{asset('public/front-asset(project2)/css/video-js.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('public/front-asset(project2)/css/style.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('public/front-asset(project2)/css/ion.rangeSlider.min.css')}}" />
	<link rel="stylesheet" href="{{asset('assets/site/css/toastr.min.css')}} ">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;500&family=Raleway:ital,wght@0,400;0,600;0,800;1,200&family=Roboto+Condensed:wght@400;700&family=Roboto:wght@300;400;700;900&display=swap" rel="stylesheet">
	
	<!-- Fav Icon -->
	<link rel="shortcut icon" type="{{asset('front-asset(project2)/image/x-icon')}}" href="{{route('front.home')}}" />
	
	<meta name="csrf-token" content="{{ csrf_token() }}">
	
</head>
<body data-instant-intensity="mousedown">

<div class="bg-light top-header">        
	<div class="container">
		<div class="row align-items-center py-3 d-none d-lg-flex justify-content-between">
			<div class="col-lg-4 logo">
				<a href="{{route('front.home')}}" class="text-decoration-none">
					<img src="{{asset('assets/site/img/orderdin65465.png')}}" alt="" style="height:50%; width:50%">
				</a>
			</div>
			<div class="col-lg-6 col-6 text-left  d-flex justify-content-end align-items-center">
				@if (Auth::check())
				<a href="{{route('account.profile')}}" class="nav-link text-dark">My Account</a>	
				@else
				<a href="{{route('account.login')}}" class="nav-link text-dark">Login/Register</a>
				@endif
				
				<form action="{{route('front.shop')}}" method="get">					
					<div class="input-group">
						<input type="text" value="{{ Request::get('search')}}" placeholder="Search For Products" class="form-control" name="search" id="search">
						<button type="submit" class="input-group-text">
							<i class="fa fa-search"></i>
					  	</button>
					</div>
				</form>
			</div>		
		</div>
	</div>
</div>

<header class="bg-dark">
	<div class="container">
		<nav class="navbar navbar-expand-xl" id="navbar">
			<a href="index.php" class="text-decoration-none mobile-logo">
				<span class="h2 text-uppercase text-primary bg-dark">Online</span>
				<span class="h2 text-uppercase text-white px-2">SHOP</span>
			</a>
			<button class="navbar-toggler menu-btn" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      			<!-- <span class="navbar-toggler-icon icon-menu"></span> -->
				  <i class="navbar-toggler-icon fas fa-bars"></i>
    		</button>
    		<div class="collapse navbar-collapse" id="navbarSupportedContent">
      			<ul class="navbar-nav me-auto mb-2 mb-lg-0">
        			<!-- <li class="nav-item">
          				<a class="nav-link active" aria-current="page" href="index.php" title="Products">Home</a>
        			</li> -->
                    @if ( getCategories()->isNotEmpty())
                        @foreach ( getCategories() as $category )
                            <li class="nav-item dropdown">
                            <button class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                {{$category->name}}
                            </button>
                             @if ($category->sub_category->isNotEmpty())
                             <ul class="dropdown-menu dropdown-menu-dark">
                              @foreach ($category->sub_category as $subCategory )
                              <li><a class="dropdown-item nav-link" href="{{ route('front.shop',[$category->slug,$subCategory->slug]) }}">{{$subCategory->name}}</a></li>
                              @endforeach
                            </ul>
                             @endif
                        </li>
                        @endforeach
                        
                    @else
                    <h5 class="text-danger mt-2">Not Foune</h5>
                      
                    @endif
					@if(Auth::check())
						<li class="nav-item">
							<a class="nav-link" href="{{ route('account.profile')}}">{{ Auth::user()->name }}</a>
						</li>
					@else
						<li class="nav-item">
							<a class="nav-link" href="{{ route('account.login') }}">Login</a>
						</li>
					@endif
      			</ul> 
				     			
      		</div>   
			<div class="right-nav py-0">
				
				<a href="{{route("front.cart")}}" class="ml-3 d-flex pt-2">
					<i class="fas fa-shopping-cart text-primary"></i>					
				</a>
			</div> 
			 		
      	</nav>
		
  	</div>
</header>

<main>
   @yield('content')
</main>

<footer class="bg-dark mt-5">
	<div class="container pb-5 pt-3">
		<div class="row">
			<div class="col-md-4">
				<div class="footer-card">
					<h3>Get In Touch</h3>
					<p>No dolore ipsum accusam no lorem. <br>
					4-No-Goli,Shiroil Colony, Rajshahi, Bangladesh<br>
					exampl@example.com <br>
					000 000 0000</p>
				</div>
				<img src="{{ asset('assets/site/img/payment1.png') }}" alt="Payment Methods" class="img-fluid" style="width: 60%">
			</div>

			<div class="col-md-4">
				<div class="footer-card">
					<h3>Important Links</h3>
					<ul>
						@if (staticPages()->isNotEmpty()) {{-- staticPages is helpers function --}}
							@foreach (staticPages() as $page)
							<li><a href="{{route('front.page',$page->slug)}}" title="{{$page->name}}">{{$page->name}}</a></li>
							@endforeach	
						@endif		
					</ul>
				</div>
			</div>

			<div class="col-md-4">
				<div class="footer-card">
					<h3>My Account</h3>
					<ul>
						<li><a href="{{route('account.login')}}" title="Sell">Login</a></li>
						<li><a href="{{route('account.register')}}" title="Advertise">Register</a></li>
						<li><a href="{{route('account.orders')}}" title="Contact Us">My Orders</a></li>						
					</ul>
				</div>
			</div>			
		</div>
	</div>
	<div class="copyright-area">
		<div class="container">
			<div class="row">
				<div class="col-12 mt-3">
					<div class="copy-right text-center">
						<p><a href="https://sagoralibd.top/" target="_blank">Copyright &copy; 2024-{{ date('Y') }} developed by  SagorAliBD All rights reserved w3techbd.</a></p>
						
					</div>
				</div>
			</div>
		</div>
	</div>
</footer>
<script src="{{asset('public/front-asset(project2)/js/jquery-3.6.0.min.js')}}"></script>
<script src="{{asset('public/front-asset(project2)/js/bootstrap.bundle.5.1.3.min.js')}}"></script>
<script src="{{asset('public/front-asset(project2)/js/instantpages.5.1.0.min.js')}}"></script>
<script src="{{asset('public/front-asset(project2)/js/lazyload.17.6.0.min.js')}}"></script>
<script src="{{asset('public/front-asset(project2)/js/slick.min.js')}}"></script>
<script src="{{asset('public/front-asset(project2)/js/custom.js')}}"></script>
<script src="{{asset('public/front-asset(project2)/js/ion.rangeSlider.min.js')}}"></script>
<script src="{{asset('assets/site/js/toastr.min.js')}}"></script>
<script>
    window.onscroll = function() {myFunction()};

    var navbar = document.getElementById("navbar");
    var sticky = navbar.offsetTop;

    function myFunction() {
    if (window.pageYOffset >= sticky) {
        navbar.classList.add("sticky")
    } else {
        navbar.classList.remove("sticky");
    }
 }
  // js Code for Add to Cart button
   
function addToCart(id) {
    var size = $('#size-' + id).val();
    if (size === "") {
        alert('Please select a size');
        return;
    }

    $.ajax({
        url: '{{ route('front.addToCart') }}',
        type: 'post',
        data: { id: id, size: size, _token: '{{ csrf_token() }}' },
        dataType: 'json',
        success: function(response) {
            if (response.status) {
                window.location.href = "{{ route('front.cart') }}";
            } else {
                alert(response.message);
            }
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
            alert('Something went wrong!');
        }
    });
}




	// code for CSRF Token
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csft-token"]').attr('content')
		}
	});

	function add_To_Wishlist(id) {
            $.ajax({
                url: '{{ route('front.add_To_Wishlist') }}',
                type:'post',
                data:{id:id, _token: '{{ csrf_token() }}'},
                dataType:'json',
                success: function(response){
                   if(response.status == true){
                       toastr.success(response.message);
                   } else {
                       toastr.error('You need to login first!');
                       window.location.href="{{ route('account.login') }}";
                   }
                },
                error: function() {
                    toastr.error('An error occurred while adding to wishlist.');
                }
            });
        }
</script>
@yield('script')
</body>
</html>
