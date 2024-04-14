@extends('layouts.site')

@section('content')

{{-- <div class="container">
    <div class="row pt120">
        <div class="col-lg-8 col-lg-offset-2">
            <div class="heading align-center mb60">
                <h4 class="h1 heading-title">E-commerce tutorial</h4>

                <p class="heading-text">Buy books, and we ship to you.
                   
                </p>
            </div>
        </div>
    </div>
</div> --}}

<div class="container">
	<div class="row medium-padding120 bg-border-color">
		<div class="container">

			<div class="row">
	
				<div class="col-lg-12">
			<div class="order">
				<h2 class="h1 order-title text-center">Your Order</h2>

<!-- /resources/views/post/create.blade.php -->
	
			@if ($errors->any())
			<div class="alert alert-danger">
				<ul>
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif
		
<!-- Create Post Form -->

		@if ( count($products) > 0 )
			<form action="{{route('charge')}}" method="post" class="cart-main">
				@csrf
					<table class="shop_table cart">
						<thead class="cart-product-wrap-title-main">
						<tr>
							<th class="product-thumbnail">Product</th>
							<th class="product-quantity">Quantity</th>
							<th class="product-quantity">Unit</th>
							<th class="product-subtotal">Total</th>
						</tr>
						</thead>
						<tbody>
							<?php $cartItemsTotalAmount=0; ?>
				@foreach ($products as $product )

				<?php  
					$cartItemsTotalAmount += $product->price * $product->quantity;
				?>

				<tr class="cart_item">

					<td class="product-thumbnail">

						<div class="cart-product__item">
							<div class="cart-product-content">
								<h5 class="cart-product-title"> {{$product->name ? $product->name:''}} </h5>
							</div>
						</div>
					</td>

					<td class="product-quantity">

						<div class="quantity">
							  {{$product->quantity? $product->quantity:1}} x
						</div>

					</td>
					<td class="product-quantity">
				
						<div class="quantity">
							{{config('product.currency') }} {{$product->price}} 
						</div>

					</td>
					
					<td class="product-subtotal">
						<h5 class="total amount">{{ config('stripe.currency_symbol') }} {{ $product->price * $product->quantity }} </h5>
					</td>

				</tr>
				@endforeach
					
						{{-- <tr class="cart_item subtotal">
							<td class="product-thumbnail">
								<div class="cart-product-content">
									<h5 class="cart-product-title">	Subtotal:</h5>
								</div>
							</td>
							<td class="product-quantity">
							</td>
							<td class="product-subtotal">
								<h5 class="total amount">$100.97</h5>
							</td>
						</tr> --}}

						<tr class="cart_item total">

							<td class="cart-product-content"> 
								
							</td>

							<td class="product-thumbnail">


								<div class="cart-product-content">
									<h5 class="cart-product-title">Total</h5> 
								</div>


							</td>

							<td class="product-quantity">
								<h5 class="cart-product-title"> : </h5>
							</td>

							<td class="product-subtotal">
								<h5 class="total amount">{{config('stripe.currency_symbol') }} {{$cartItemsTotalAmount}}</h5>
							<input type="hidden" name="cartItemsTotalAmount" value="{{$cartItemsTotalAmount}}">
							</td>
							
						</tr>
						<tr>
							<td colspan="5" class="actions">

								<div class="coupon">
									<input name="coupon_code" class="email input-standard-grey" value="{{old('coupon_code')}}" placeholder="Coupon code" type="text">
									{{-- <div class="btn btn-medium btn--breez btn-hover-shadow">
										<span class="text">Apply Coupon</span>
										<span class="semicircle--right"></span>
									</div> --}}
								</div>

								{{-- <div class="btn btn-medium btn--dark btn-hover-shadow" style="  background: #1112;
								border-radius: 50px 50px 50px 50px;
								float: right;
								background: #def;
								height: 64px;
								padding-top: 21px;">
									<span class="text">Apply Coupon</span>
									<span class="semicircle"></span>
								</div> --}}

							</td>
						</tr>

						</tbody>
					</table>

					<div class="cheque">

						<div class="logos">
							<a href="#" class="logos-item">
								<img src="{{asset('assets/site/img/visa.png')}}" alt="Visa">
							</a>
							<a href="#" class="logos-item">
								<img src="{{asset('assets/site/img/mastercard.png')}}" alt="MasterCard">
							</a>
							<a href="#" class="logos-item">
								<img src="{{asset('assets/site/img/discover.png')}}" alt="DISCOVER">
							</a>
							<a href="#" class="logos-item">
								<img src="{{asset('assets/site/img/amex.png')}}" alt="Amex">
							</a>
							<a href="#" class="logos-item">
								<img src="{{asset('assets/site/img/stripe.png')}}" alt="Stripe">
							</a>

						<button type="submit" class="btn btn-sm" style="background-color: #828df1; font-size:20px;color:white;"> Pay with Strip</button>
							{{-- <span style="float: right;">
								<form action="/your-server-side-code" method="POST">
									  <script
									    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
									    data-key="pk_test_6pRNASCoBOKtIshFeQd4XMUh"
									    data-amount="999"
									    data-name="Stripe.com"
									    data-description="Widget"
									    data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
									    data-locale="auto"
									    data-zip-code="true">
									  </script>
								</form>
							</span> --}}
						</div>
					</div>

			</form>
			</div>
		</div>
	@else
		<h3 class="text-center text-danger">No Item Found.</h3>
@endif
			</div>
		</div>
	</div>
</div>

    
@endsection