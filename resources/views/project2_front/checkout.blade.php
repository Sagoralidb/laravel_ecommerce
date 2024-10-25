{{-- project 2 --}}
@extends('project2_front.layouts.app')

@section('title','Checkout Page')

@section('content')
<section class="section-5 pt-3 pb-3 mb-3 bg-white">
    <div class="container">
        <div class="light-font">
            <ol class="breadcrumb primary-color mb-0">
                <li class="breadcrumb-item"><a class="white-text" href="{{ route('front.home')}}">Home</a></li>
                <li class="breadcrumb-item"><a class="white-text" href="{{ route('front.shop')}}">Shop</a></li>
                <li class="breadcrumb-item">Checkout</li>
            </ol>
        </div>
    </div>
</section>

<section class="section-9 pt-4">
    <div class="container">
        <form  id="orderForm" name="orderForm" action="" method="post">
            @csrf
            <div class="row">
            <div class="col-md-8">
                <div class="sub-title">
                    <h2>Shipping Address</h2>
                </div>
                <div class="card shadow-lg border-0">
                    <div class="card-body checkout-form">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <input type="text" name="first_name" id="first_name" class="form-control" placeholder="First Name" 
                                    value="{{ $customerAddress ? $customerAddress->first_name:'' }}">
                                <p></p>
                                </div>            
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Last Name"
                                    value="{{ $customerAddress ? $customerAddress->last_name:'' }}">
                                    <p></p>
                                </div>            
                            </div>
                            
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <input type="text" name="email" id="email" class="form-control" placeholder="Email" value="{{(!empty($customerAddress)) ? $customerAddress->email:'' }}">
                                    <p></p>
                                </div>            
                            </div>

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <select name="country" id="country" class="form-control">
                                        <option value="">Select a Country</option>
                                        @if ($countries->isNotEmpty() )
                                            @foreach ($countries as $country )
                                                <option  {{ (! empty($customerAddress) && $customerAddress->country_id == $country->id ) ? 'selected':'' }}  value="{{$country->id}}">{{ $country->name }}</option>
                                            @endforeach

                                        @endif                                        
                                    </select>
                                    <p></p>   
                                </div>  
                                       
                            </div>

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <textarea name="address" id="address" cols="30" rows="3" placeholder="Address" class="form-control">{{(!empty($customerAddress)) ? $customerAddress->address:'' }}</textarea>
                                    <p></p>
                                </div>            
                            </div>

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <input type="text" name="apartment" id="apartment" class="form-control" placeholder="Apartment, suite, unit, etc. (optional)"
                                    value="{{(!empty($customerAddress)) ? $customerAddress->apartment:'' }}">
                                    
                                </div>            
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <input type="text" name="city" id="city" class="form-control" placeholder="City"value="{{(!empty($customerAddress)) ? $customerAddress->city:'' }}">
                                    <p></p>
                                </div>            
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <input type="text" name="state" id="state" class="form-control" placeholder="State"value="{{(!empty($customerAddress)) ? $customerAddress->state:'' }}">
                                    <p></p>
                                </div>            
                            </div>
                            
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <input type="text" name="zip" id="zip" class="form-control" placeholder="Zip"value="{{(!empty($customerAddress)) ? $customerAddress->zip:'' }}">
                                    <p></p>
                                </div>            
                            </div>

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <input type="text" name="mobile" id="mobile" class="form-control" placeholder="Mobile No."value="{{(!empty($customerAddress)) ? $customerAddress->mobile:'' }}">
                                    <p></p>
                                </div>            
                            </div>
                            

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <textarea name="order_notes" id="order_notes" cols="30" rows="2" placeholder="Order Notes (optional)" class="form-control"></textarea>
                                    <p></p>
                                </div>            
                            </div>

                        </div>
                    </div>
                </div>    
            </div>
            <div class="col-md-4">
                <div class="sub-title">
                    <h2>Order Summery</h3>
                </div>                    
                <div class="card cart-summery">
                    <div class="card-body">
                        @foreach (Cart::content() as $item )
                        <div class="d-flex justify-content-between pb-2">
{{-- {{$item->options->size ? '('.$item->options->size.')-': ''  }} --}}
                            <div class="h6"> <strong>Size:</strong> ({{ $item->options->size }})-{{$item->name}} X {{$item->qty}}</div>
                            <div class="h6 text-success">{{config('stripe.currency_symbol')}} {{$item->price*$item->qty}}</div>
                        </div>
                        @endforeach
                        
                        {{-- Calculating the order here --}}
                        <div class="d-flex justify-content-between summery-end">
                            <div class="h6"><strong>Subtotal</strong></div>
                            <div class="h6"><strong>{{config('stripe.currency_symbol')}}{{ Cart::subtotal() }}</strong></div>
                        </div>
                        <div class="d-flex justify-content-between summery-end">
                            <div class="h6"><strong>Discount</strong></div>
                            <div class="h6"><strong id="discount_value">{{config('stripe.currency_symbol')}}{{ $discount }}</strong></div>
                        </div>
                        <div class="d-flex justify-content-between mt-2">
                            <div class="h6"><strong >Shipping</strong></div>
                            <div class="h6"><strong id="shippingAmount">{{config('stripe.currency_symbol')}}{{ number_format($totalShippingCharge,2) }}</strong></div>
                        </div>
                        <div class="d-flex justify-content-between mt-2 summery-end">
                            <div class="h5"><strong>Total</strong></div>
                            <div class="h5"><strong id="grandTotal">{{config('stripe.currency_symbol')}}{{ $grandTotal }}</strong></div>
                        </div>                            
                    </div>
                </div>   
                {{-- Apply Coupon --}}
                <div class="input-group apply-coupan mt-4">
                    <input type="text" name="discount_code" id="discount_code" placeholder="Coupon Code" class="form-control">
                    <button class="btn btn-dark" type="button" id="apply-discount">Apply Coupon</button>
                </div> 
                <div id="discount-response-wrapper">
                    @if (Session::has('code'))
                    <div class="mt-4" id="discount-response">
                        <strong class="mr-5">{{ Session::get('code')->code }}</strong>
                        <a class="btn btn-sm text-danger" id="remove-discount"><i class="fa fa-times"></i></a>
                        </div>
                    @endif
                </div>
                <div class="card payment-form ">                        
                    <h3 class="card-title h5 mb-3">Payment Mathods</h3>
                    <div>
                        <input checked type="radio" name="payment_method" value="cod" id="payment_method_one">
                        <label for="payment_method_one" class="form-check-label">Cash On Deliver</label>
                    </div>
                    <div>
                        <input type="radio" name="payment_method" value="cod" id="payment_method_two">
                        <label for="payment_method_two" class="form-check-label">Strip</label>
                    </div>
                    {{-- <div>
                        <input type="radio" name="payment_method" value="cod" id="payment_method_three">
                        <label for="payment_method_three" class="form-check-label">Bkash</label>
                    </div> --}}
                    <div class="card-body p-0 d-none mt-3" id="card-payment-form">
                        <div class="mb-3">
                            <label for="card_number" class="mb-2">Card Number</label>
                            <input type="text" name="card_number" id="card_number" placeholder="Valid Card Number" class="form-control">
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="expiry_date" class="mb-2">Expiry Date</label>
                                <input type="text" name="expiry_date" id="expiry_date" placeholder="MM/YYYY" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="expiry_date" class="mb-2">CVV Code</label>
                                <input type="text" name="expiry_date" id="expiry_date" placeholder="123" class="form-control">
                            </div>
                        </div>
                    </div>          
                    <div class="pt-4">
                        {{-- <a href="#" class="btn-dark btn btn-block w-100">Pay Now</a> --}}
                        <button type="submit" class="btn-dark btn btn-block w-100">Pay Now</button>
                    </div>                    
                </div>   
                <!-- CREDIT CARD FORM ENDS HERE -->
            </div>
        </div>
        </form>
        
    </div>
</section>
@endsection

@section('script')
    <script>
        $("#payment_method_one").click(function() {
            if ( $(this).is(":checked") == true ) {
                $("#card-payment-form").addClass('d-none');
            }
        });

        $("#payment_method_two").click(function() {
            if ( $(this).is(":checked") == true ) {
                $("#card-payment-form").removeClass('d-none');
            }
        });
        // from Submite code...
                $("#orderForm").submit(function(event){
            event.preventDefault();
            $('button[type="submit"]').prop('disabled',true);
            $.ajax({
                url: '{{ route("front.processCheckout") }}',
                type: 'post',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(response){
                    $('button[type="submit"]').prop('disabled',false);
                    if(response.status == false ) {
                        // Validation errors handling
                        console.log('Validation errors:', response.errors);
                        var errors = response.errors;

                        if (errors.first_name) {
                            $("#first_name").addClass('is-invalid')
                            .siblings("p").addClass('invalid-feedback')
                            .html(errors.first_name[0]);
                        } else {
                            $("#first_name").removeClass('is-invalid')
                            .siblings("p").removeClass('invalid-feedback')
                            .html('');
                        }
                        if (errors.last_name) {
                            $("#last_name").addClass('is-invalid')
                            .siblings("p").addClass('invalid-feedback')
                            .html(errors.last_name[0]);
                        } else {
                            $("#last_name").removeClass('is-invalid')
                            .siblings("p").removeClass('invalid-feedback')
                            .html('');
                        }
                        if (errors.email) {
                            $("#email").addClass('is-invalid')
                            .siblings("p").addClass('invalid-feedback')
                            .html(errors.email[0]);
                        } else {
                            $("#email").removeClass('is-invalid')
                            .siblings("p").removeClass('invalid-feedback')
                            .html('');
                        }
                        if (errors.country) {
                            $("#country").addClass('is-invalid')
                            .siblings("p").addClass('invalid-feedback')
                            .html(errors.country[0]);
                        } else {
                            $("#country").removeClass('is-invalid')
                            .siblings("p").removeClass('invalid-feedback')
                            .html('');
                        }
                        if (errors.address) {
                            $("#address").addClass('is-invalid')
                            .siblings("p").addClass('invalid-feedback')
                            .html(errors.address[0]);
                        } else {
                            $("#address").removeClass('is-invalid')
                            .siblings("p").removeClass('invalid-feedback')
                            .html('');
                        }
                        if (errors.city) {
                            $("#city").addClass('is-invalid')
                            .siblings("p").addClass('invalid-feedback')
                            .html(errors.city[0]);
                        } else {
                            $("#city").removeClass('is-invalid')
                            .siblings("p").removeClass('invalid-feedback')
                            .html('');
                        }
                        if (errors.state) {
                            $("#state").addClass('is-invalid')
                            .siblings("p").addClass('invalid-feedback')
                            .html(errors.state[0]);
                        } else {
                            $("#state").removeClass('is-invalid')
                            .siblings("p").removeClass('invalid-feedback')
                            .html('');
                        }
                        if (errors.zip) {
                            $("#zip").addClass('is-invalid')
                            .siblings("p").addClass('invalid-feedback')
                            .html(errors.zip[0]);
                        } else {
                            $("#zip").removeClass('is-invalid')
                            .siblings("p").removeClass('invalid-feedback')
                            .html('');
                        }
                        if (errors.mobile) {
                            $("#mobile").addClass('is-invalid')
                            .siblings("p").addClass('invalid-feedback')
                            .html(errors.mobile[0]);
                        } else {
                            $("#mobile").removeClass('is-invalid')
                            .siblings("p").removeClass('invalid-feedback')
                            .html('');
                        }
                        
                        console.log('Order processed successfully:', response);
                    } else {
                        window.location.href="{{ url('/thankyou/') }}/"+response.orderId;
                    }
                },
                error: function(error) {
                    console.error('AJAX error:', error);
                }
            });
        });
    
    var currencySymbol = '{{ config('stripe.currency_symbol') }}';  // currency declear
    
// If someone change the country at a time shipping charge should be change
    $("#country").change(function(){
        $.ajax({
            url:'{{route("front.getOrderSummery")}}',
            type:'post',
            data:{country_id: $(this).val() ,_token: '{{ csrf_token() }}'},
            dataType:'json',
            success: function(response){
                if(response.status == true) {
                    $("#shippingAmount").html(currencySymbol +response.shippingCharge);
                    $("#grandTotal").html(currencySymbol + response.grandTotal);
                }
            }
        });
    });


// Apply discount coupon
$("#apply-discount").click(function(){
    $.ajax({
        url: '{{ route("front.applyDiscount") }}',
        type: 'post',
        data: {code: $("#discount_code").val(), country_id: $("#country").val(), _token: '{{ csrf_token() }}'},
        dataType: 'json',
        success: function(response){
            if(response.status == true) {
                $("#shippingAmount").html(currencySymbol + response.shippingCharge);
                $("#grandTotal").html(currencySymbol + response.grandTotal);
                $("#discount_value").html(currencySymbol + response.discount);
                $("#discount-response-wrapper").html(response.discountString);
            } else {
                $("#discount-response-wrapper").html("<span class='text-danger'>" + response.message + "</span>");
            }
        }
    });
});
     // Rimove discount  coupon
    $('body').on('click',"#remove-discount",function(){
        $.ajax({
            url:'{{route("front.removeCoupon")}}',
            type:'post',
            data:{country_id:$("#country").val() ,_token: '{{ csrf_token() }}'},
            dataType:'json',
            success: function(response){
                if(response.status == true) {
                    $("#shippingAmount").html(currencySymbol+response.shippingCharge);
                    $("#grandTotal").html(currencySymbol+response.grandTotal);
                    $("#discount_value").html(currencySymbol+response.discount);

                    $("#discount-response").html('');
                    $("#discount_code").val('');
                }
            }
        });
    });
   

    </script>
@endsection
