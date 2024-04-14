
@extends('layouts.site')
 
    @section('style')
    <link rel="stylesheet" href="{{ asset('assets/site/css/toastr.min.css') }}">
    @endsection
    @section('styles')
    @parent
    <style>
        .toast-success {
            background-color: rgba(14, 182, 70, 0.671);
            color: white;
        }
    </style>
    @endsection
@section('content')
    <div class="content-wrapper">

       
        <div class="container">
            <div class="row pt120">
                <div class="books-grid">

                   @if (session('alert-success') )
                    <div class="alert alert-success" role="alert">
                        {{session()->get('alert-success') }}
                    </div>
                   @endif

                   @if (session('alert-danger') )
                    <div class="alert alert-danger" role="alert">
                        {{session()->get('alert-danger') }}
                          </button>
                    </div>
                   @endif

                   

                <div class="row mb30">
                    @if (count($products)>0 )

                        @foreach ($products as $product)
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 mb-2">
                            <div class="books-item">
                                <div class="books-item-thumb">
                                    @if ($product->gallery)
                                      <img src="{{ $product->gallery->image }}" alt="book">                              
                                    @endif

                                    {{-- <div class="new">New</div>
                                    <div class="sale">Sale</div>
                                    <div class="overlay overlay-books"></div> --}}
                                </div>
                               
                                <div class="books-item-info">
                                    <h5 class="books-title"> <a class="btn" href="{{route('site.product.details',$product->slug) }}">{{ $product ? $product->name:'' }}</a> </h5>
                                    <div class="books-price">{{ config('stripe.currency_symbol').' '.$product->price}}</div>
                                </div>
    
                                <a href="javascript:void(0)" data-id="{{ $product? $product->id:'' }}" class="btn btn-small btn--dark add add_to_card_btn">
                                    <span class="text">Add to Cart</span>
                                    <i class="seoicon-commerce"></i>
                                </a>
    
                            </div>
                        </div>
                        @endforeach

                    @endif
                    

                



                </div>
            @php
                $currentPage = $products->currentPage();
                $totalPages = $products->lastPage();
            @endphp

                @if ($totalPages > 1)
                <div class="row pb120">
                    <div class="col-lg-12">
                        <nav class="navigation align-center">
                            @for ($page = 1; $page <= min($totalPages, 2); $page++)
                                <a href="{{ $products->url($page) }}" class=" page-numbers bg-border-color {{ $page === $currentPage ? 'current' : '' }}">
                                    <span>{{ $page }}</span>
                                </a>
                            @endfor
            
                            @if ($currentPage < $totalPages)
                                <a href="{{ $products->nextPageUrl() }}" class=" btn-next">
                                    <svg class="btn-prev">
                                        <use xlink:href="#arrow-right"></use>
                                    </svg>
                                </a>
                            @endif
            
                            @if ($currentPage > 1)
                                <a href="{{ $products->previousPageUrl() }}" class="btn-prev">
                                    <svg class="btn-prev">
                                        <use xlink:href="#arrow-left"></use>
                                    </svg>
                                </a>
                            @endif
                        </nav>
                    </div>
                </div>
            @else
                <h4 class="text-center text-danger mb-4">No product Found</h4>
            @endif
            
                

            </div>
            </div>
        </div>
    </div>
@endsection
<!-- Footer -->
@section('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script> --}}
   <script src="{{ asset('assets/site/js/toastr.min.js') }}"></script>
   <script>
        
        $(document).ready(function(){

            $('.add_to_card_btn').click(function(){
              var product_id = $(this).data('id');      
                console.log(product_id);
                $.ajax({
                    url     :"{{ route('add.to.cart') }}",
                    method  :"GET",    
                    data: { product_id }, // if key & value is same
                    success: function (data){
                        
                        if(data.message){
                            toastr['success'](data.message);
                        }
                        calculateCartItems();
                    },
                    error:function (response){
                        if( response.responseJSON.error ){
                            toastr['error'](response.responseJSON.error)           
                        }
                        else{
                            toastr['error']('Something went wrong. Check you login or refres the webpage & try again')
                        }
                    }
                })

            } );

         } );
    </script>

    <script>    
        // ajax again call 
function calculateCartItems(){
            $.ajax({
                        url     :"{{ route('calculate.add_to_cart') }}",
                        method  :"GET",
                        success: function (data){ 
                        
                            if (data.cart_total_items) {
                                $('.cart_total_items').html(data.cart_total_items)
                            }
                       

                        },
                        error:function (response){
                            console.log(response);

                        }
                });


                function calculateCartItems(itemsCount){
                    return itemsCount;
                }
        }
    </script>
    
    
@endsection



