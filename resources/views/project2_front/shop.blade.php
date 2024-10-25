{{-- Project 2 --}}
@extends('project2_front.layouts.app')
@section('title','Shope Page')
@section('content')
<section class="section-5 pt-3 pb-3 mb-3 bg-white">
    <div class="container">
        <div class="light-font">
            <ol class="breadcrumb primary-color mb-0">
                <li class="breadcrumb-item"><a class="white-text" href="{{ route('front.home')}}">Home</a></li>
                <li class="breadcrumb-item active"> <a href="{{route('front.shop')}}"> Shop</a> </li>
            </ol>
        </div>
    </div>
</section>

<section class="section-6 pt-3">
    <div class="container">
        <div class="row">            
            <div class="col-md-3 sidebar">
                <div class="sub-title">
                    <h2>Categories</h3>
                </div>
                
                <div class="card">
                    <div class="card-body">
                        <div class="accordion accordion-flush" id="accordionExample">
                           @if (count($categories)>0)
                                @foreach ($categories as $key => $category )
                                    <div class="accordion-item">
                                        @if ($category->sub_category->isNotEmpty())
                                        <h2 class="accordion-header" id="headingOne">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne-{{ $key }}" aria-expanded="false" aria-controls="collapseOne-{{ $key }}">
                                            {{$category->name}}
                                            </button>
                                        </h2>
                                        @else
                                            <a href="{{route("front.shop",$category->slug)}}" class="nav-item nav-link {{ ($categorySelected==$category->id)? 'text-primary' : '' }}">{{ $category->name }}</a>  
                                        @endif
                                        @if ($category->sub_category->isNotEmpty())
                                           <div id="collapseOne-{{ $key }}" class="accordion-collapse collapse {{ ($categorySelected==$category->id) ? 'show':'' }}" aria-labelledby="headingOne" data-bs-parent="#accordionExample" style="">
                                            <div class="accordion-body">
                                                <div class="navbar-nav">
                                                    @foreach ($category->sub_category as $subCategory )
                                                        <a href="{{ route("front.shop",[$category->slug,$subCategory->slug]) }}" class="nav-item nav-link {{ ($subCategorySelected==$subCategory->id)? 'text-primary' : '' }}">{{$subCategory->name}}</a>  
                                                    @endforeach                                                                   
                                                    </div>
                                                </div>
                                            </div> 
                                        @endif
                                </div>   
                                @endforeach          
                           @else
                               <h5 class="text-danger text-center">No Category Found</h5>
                           @endif                                                 
                        </div>
                    </div>
                </div>
                <div class="sub-title mt-2">
                    <h2>Brand</h3>
                </div>
                
                <div class="card">
                    <div class="card-body">
                        @if (count($brands)>0)
                            @foreach ($brands as $brand)
                             <div class="form-check mb-2">
                                <input {{ (in_array($brand->id,$brandsArray)) ? 'checked' : '' }} class="form-check-input brand-label" type="checkbox" name="brand[]" value="{{ $brand->id }}" id="brand-{{ $brand->id }}">
                               
                                <label class="form-check-label" for="brand-{{ $brand->id }}">
                                    {{ $brand->name }}
                                </label>
                            </div>   
                            @endforeach
                         
                        @else
                        <h5 class="text-danger text-center">No Brands Found</h5>
                        @endif
                    </div>
                </div>

                <div class="sub-title mt-2">
                    <h2>Price</h3>
                </div>
                
                <div class="card">
                    <div class="card-body">
                        <input type="text" class="js-range-slider" name="my_range" value="" /> 

                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-end mb-4">
                            <div class="ml-2">
                                <select name="sort" id="sort" class="form-control">
                                    <option value="latest" {{ ($sort == 'latest') ? 'selected' : ''}}>Latest</option>
                                    <option value="price_desc" {{ ($sort == 'price_desc') ? 'selected' : ''}}>Price High</option>
                                    <option value="price_asc"{{ ($sort == 'price_asc') ? 'selected' : ''}}>Price Low</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    @if ( count($products)>0 )
                        @foreach ($products as $product )
                            @php
                            $productImage = $product->products_images->first();   
                            @endphp
                            <div class="col-md-4">
                            <div class="card product-card">
                                <div class="product-image position-relative">
                                    <a href="{{ route("front.product",$product->slug)}}" class="product-img">       
                                        @if (!empty($productImage))
                                        <img src="{{ asset('public/uploads/product/small/'.$productImage->image) }}" 
                                        alt="Product Image" class="card-img-top"/>
                                        @else
                                            <img src="{{asset('assets/admin/img/default-150x150.png')}}" 
                                            class="text-danger img-thumbnail" width="50"/>
                                        @endif
                                    </a>
                                    <a onclick="add_To_Wishlist({{ $product->id }})" class="whishlist" href="javascript:void(0);"><i class="far fa-heart"></i></a>                           

                                    <div class="product-action">
                                        @if ($product->track_qty == 'Yes')
                                            @if ($product->qty > 0)
                                                <a class="btn btn-dark" href="javascript:void(0);" onclick="addToCart( {{ $product->id }} );">
                                                    <i class="fa fa-shopping-cart"></i> Add To Cart
                                                </a>
                                            @else
                                            <a class="btn btn-dark" href="javascript:void(0);">
                                               Out of Stock
                                            </a>
                                            @endif
                                        @else
                                            <a class="btn btn-dark" href="javascript:void(0);" onclick="addToCart( {{ $product->id }} );">
                                                <i class="fa fa-shopping-cart"></i> Add To Cart
                                            </a>
                                        @endif                             
                                    </div>
                                    
                                </div>                        
                                <div class="card-body text-center mt-3">
                                    <a class="h6 link" href="{{ route("front.product",$product->slug)}}">{{ Illuminate\Support\Str::limit($product->title,20 ) }}</a>
                                    <div class="price mt-2">
                                        <span class="h5"><strong>{{config('stripe.currency_symbol')}}{{$product->price}}</strong></span>
                                            @if($product->compare_price>0)
                                            <span class="h6 text-underline"><del>{{config('stripe.currency_symbol')}}{{$product->compare_price}}</del></span>     
                                            @endif
                                        
                                    </div>
                                </div>                        
                            </div>                                               
                        </div>
                        @endforeach
                        
                    @else
                        <h5 class="text-center text-danger"> No Product Found </h5>
                    @endif


                    <div class="col-md-12 pt-5">
                       <div class="pagination justify-content-end"> {{ $products->withQueryString()->links() }}</div>                 
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('script')
    <script>
            
 //ion.rangeSlider

        rangeSlider = $(".js-range-slider").ionRangeSlider({
       
        type: "double",
        min: 0,
        max: 1000,
        from: {{ ($priceMin) }}, 
        step: 10,
        to: {{ ($priceMax) }}, 
        skin:"round",
        max_postfix: "+", 
        prefix: "৳",
        onFinish: function() {
            apply_filters()
        }
    }); 
    // Saving it's instance to var
    var slider = $(".js-range-slider").data("ionRangeSlider");

        // Filter Apply
        $(".brand-label").change(function(){
            apply_filters();
        });

        //sort function apply
            $("#sort").change(function(){
                apply_filters();
            } );
        //end sort function apply

        function apply_filters(){
            var brands = [];

            $(".brand-label").each(function(){
                if( $(this).is(":checked")== true){
                    brands.push( $(this).val() );
                }
            } );
            // console.log(brands.toString());

            var url ='{{ url()->current() }}? ';
            //Brand filter
            if(brands.length){
              url+=  '&brand='+brands.toString();
            }
            //price Range filter
            url += '&price_min='+slider.result.from+'&price_max='+slider.result.to;

            //sorting
            var keyword = $("#search").val();
            if(keyword.length > 0){
                url += '&search='+keyword;
            }
            url += '&sort='+$("#sort").val()

            window.location.href = url;
        }
    
    </script>
@endsection