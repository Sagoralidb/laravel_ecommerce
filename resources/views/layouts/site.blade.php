    <!--Layouts site-->

<!DOCTYPE html>
<html lang="en">
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Ecommerce Shop</title>

    <link rel="stylesheet" type="text/css" href="{{asset('assets/site/css/fonts.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/site/css/crumina-fonts.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/site/css/normalize.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/site/css/grid.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/site/css/styles.css')}}">
    


    <!--Plugins styles-->

    <link rel="stylesheet" type="text/css" href="{{asset('assets/site/css/jquery.mCustomScrollbar.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/site/css/swiper.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/site/css/primary-menu.css ')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/site/css/magnific-popup.css')}}">

    <!--toastr Notification css Plugin-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/site/css/toastr.min.css')}}">
    <!--Styles for RTL-->

    <!--<link rel="stylesheet" type="text/css" href="{{asset('assets/site/css/rtl.css')}}">-->

    <!--External fonts-->

    <link href='https://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css'>
      <!--Bootstrap 5-->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"/>

    @yield('style')
    <style>
        .toast-success {
            background-color: rgba(4, 119, 33, 0.918);
            color: white;
        }
    </style>

</head>

<body class=" ">

    <header class="header" id="site-header">
    
        <div class="container">
    
            <div class="header-content-wrapper">
    
                <ul class="nav-add">
                    <li class="cart" >
                        <a href="{{ auth()->check() ? route('login'):route('user.home') }}" class="btn" style="margin-right:15px"> 
                            {{-- {{auth()->check()?'User':'login'}}  --}}
                            {{ auth()->check() ? substr(Auth::user()->name, 0, 5) : 'login' }}
                        </a>
                    </li>
                    
                    <li class="cart">
    
                        <a href="#" class="js-cart-animate">
                            <i class="seoicon-basket"></i>
                            <span class="cart-count cart_total_items" > {{ countTotalItems()  }}</span>
                        </a>
    
                        <div class="cart-popup-wrap">
                            <div class="popup-cart">
                                <h4 class="title-cart"> <span class="cart_total_items"> {{ countTotalItems()  }} </span> Products in the cart!</h4>
                                <p class="subtitle">Please make your choice.</p>
                                <div class="btn btn-small">
                                    <span class="text"> <a href="{{route('site.cart')}}" class="btn btn-dark" >View all catalog</a> </span>
                                </div>
                            </div>
                        </div>
    
                    </li>
                </ul>
            </div>
    
        </div>
    
    </header>


{{-- Content --}}
@yield('content')

    <footer class="footer">
        <div class="sub-footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    </div>
                </div>
            </div>
        </div>
    </footer>
    


<script src="{{asset('assets/site/js/jquery-2.1.4.min.js')}}"></script>
<script src="{{asset('assets/site/js/crum-mega-menu.js')}}"></script>
<script src="{{asset('assets/site/js/swiper.jquery.min.js')}}"></script>
<script src="{{asset('assets/site/js/theme-plugins.js')}}"></script>
<script src="{{asset('assets/site/js/main.js')}}"></script>
<script src="{{asset('assets/site/js/form-actions.js')}}"></script>

<script src="{{asset('assets/site/js/velocity.min.js')}}"></script>
<script src="{{asset('assets/site/js/ScrollMagic.min.js')}}"></script>
<script src="{{asset('assets/site/js/animation.velocity.min.js')}}"></script>

 <!--toastr Notification Js Plugin-->
  <script src="{{ asset('assets/site/js/toastr.min.js') }}"></script>
<!-- ...end JS Script -->
<!-- ...end JS Script for Bootrap 5 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>

@yield('scripts')

<script>
    @if (session('alert-success') )
        toastr['success']("{{session()->get('alert-success') }}");
    @endif
</script>
</body>

</html>