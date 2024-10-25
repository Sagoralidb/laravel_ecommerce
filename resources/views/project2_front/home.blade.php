{{-- Project 2 --}}
@extends('project2_front.layouts.app')

@section('content')
<section class="section-1">
    <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="false">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <!-- <img src="images/carousel-1.jpg" class="d-block w-100" alt=""> -->

                <picture>
                    <source media="(max-width: 799px)" srcset="{{asset('public/front-asset(project2)/images/carousel-1-m.jpg')}}" />
                    <source media="(min-width: 800px)" srcset="{{asset('public/front-asset(project2)/images/carousel-1.jpg')}}" />
                    <img src="{{asset('public/front-asset(project2)/images/carousel-1.jpg')}}" alt="" />
                </picture>

                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                    <div class="p-3">
                        <h1 class="display-4 text-white mb-3">Kids Fashion</h1>
                        <p class="mx-md-5 px-5">Lorem rebum magna amet lorem magna erat diam stet. Sadips duo stet amet amet ndiam elitr ipsum diam</p>
                        <a class="btn btn-outline-light py-2 px-4 mt-3" href="{{route('front.shop')}}">Shop Now</a>
                    </div>
                </div>
            </div>
            <div class="carousel-item">

                <picture>
                    <source media="(max-width: 799px)" srcset="{{asset('public/front-asset(project2)/images/carousel-2-m.jpg')}}" />
                    <source media="(min-width: 800px)" srcset="{{asset('public/front-asset(project2)/images/carousel-2.jpg')}}" />
                    <img src="{{asset('public/front-asset(project2)/images/carousel-2.jpg')}}" alt="" />
                </picture>
                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                    <div class="p-3">
                        <h1 class="display-4 text-white mb-3">Womens Fashion</h1>
                        <p class="mx-md-5 px-5">Lorem rebum magna amet lorem magna erat diam stet. Sadips duo stet amet amet ndiam elitr ipsum diam</p>
                        <a class="btn btn-outline-light py-2 px-4 mt-3" href="{{route('front.shop')}}">Shop Now</a>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <picture>
                    <source media="(max-width: 799px)" srcset="{{asset('public/front-asset(project2)/images/carousel-3-m.jpg')}}" />
                    <source media="(min-width: 800px)" srcset="{{asset('public/front-asset(project2)/images/carousel-3.jpg')}}" />
                    <img src="{{asset('public/front-asset(project2)/images/carousel-2.jpg')}}" alt="" />
                </picture>

                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                    <div class="p-3">
                        <h1 class="display-4 text-white mb-3">Shop Online at Flat 70% off on Branded Clothes</h1>
                        <p class="mx-md-5 px-5">Lorem rebum magna amet lorem magna erat diam stet. Sadips duo stet amet amet ndiam elitr ipsum diam</p>
                        <a class="btn btn-outline-light py-2 px-4 mt-3" href="{{route('front.shop')}}">Shop Now</a>
                    </div>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</section>
<section class="section-2">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="box shadow-lg">
                    <div class="fa icon fa-check text-primary m-0 mr-3"></div>
                    <h2 class="font-weight-semi-bold m-0">Quality Product</h5>
                </div>                    
            </div>
            <div class="col-lg-3 ">
                <div class="box shadow-lg">
                    <div class="fa icon fa-shipping-fast text-primary m-0 mr-3"></div>
                    <h2 class="font-weight-semi-bold m-0">Free Shipping</h2>
                </div>                    
            </div>
            <div class="col-lg-3">
                <div class="box shadow-lg">
                    <div class="fa icon fa-exchange-alt text-primary m-0 mr-3"></div>
                    <h2 class="font-weight-semi-bold m-0">14-Day Return</h2>
                </div>                    
            </div>
            <div class="col-lg-3 ">
                <div class="box shadow-lg">
                    <div class="fa icon fa-phone-volume text-primary m-0 mr-3"></div>
                    <h2 class="font-weight-semi-bold m-0">24/7 Support</h5>
                </div>                    
            </div>
        </div>
    </div>
</section>
<section class="section-3">
    <div class="container">
        <div class="section-title">
            <h2>Categories</h2>
        </div>                 
        <div class="row pb-3">
            @if (getCategories()->isNotEmpty() )
                @foreach (getCategories() as $category )
                <div class="col-lg-3">
                    <div class="cat-card">
                        <div class="left">
                            @if ($category->image != "")
                            <img src="{{asset('public/uploads/category/thumb/'.$category->image)}}" alt="" class="img-fluid" style="height: 80px;">
                            @endif
                            {{-- <img src="{{asset('public/front-asset(project2)/images/cat-1.jpg')}}" alt="" class="img-fluid"> --}}
                        </div>
                        <div class="right">
                            <div class="cat-data">
                                <h2>{{$category->name }}</h2>
                                {{-- <p>100 Products</p> --}}
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            
            @else
                <h5 class="text-center text-danger">No Category Found</h5>
            @endif

        </div>
    </div>
</section>

<section class="section-4 pt-5">
    <div class="container">
        <div class="section-title">
            <h2>Featured Products</h2>
        </div>    
        <div class="row pb-3">
            @if (count($featuredProducts) > 0)
                @foreach ($featuredProducts as $product)
                    @php
                        $productImage = $product->products_images->first();
                    @endphp
                    <div class="col-md-3">
                        <div class="card product-card">
                            <div class="product-image position-relative">
                                <a href="{{ route('front.product', $product->slug) }}" class="product-img">
                                    @if (!empty($productImage))
                                        <img src="{{ asset('public/uploads/product/small/' . $productImage->image) }}" alt="Product Image" class="card-img-top"/>
                                    @else
                                        <img src="{{ asset('assets/admin/img/default-150x150.png') }}" class="text-danger img-thumbnail" width="50"/>
                                    @endif
                                </a>
                                <a onclick="add_To_Wishlist({{ $product->id }})" class="whishlist" href="javascript:void(0);"><i class="far fa-heart"></i></a>
                                <div class="product-action">
                                    @if ($product->track_qty == 'Yes')
                                        @if ($product->qty > 0)
                                            <a class="btn btn-dark" onclick="addToCart({{ $product->id }});">
                                                <i class="fa fa-shopping-cart"></i> Add To Cart
                                            </a>
                                        @else
                                            <a class="btn btn-dark" href="javascript:void(0);">Out of Stock</a>
                                        @endif
                                    @else
                                        <a class="btn btn-dark" onclick="addToCart({{ $product->id }});">
                                            <i class="fa fa-shopping-cart"></i> Add To Cart
                                        </a>
                                    @endif
                                </div>
                            </div>
                            <div>
                                @if (!empty($product->size))
                                    @php
                                        $sizes = json_decode($product->size, true);
                                    @endphp
                                    <select name="size" id="size-{{ $product->id }}" class="form-select">
                                        <option value="">Select Size</option>
                                        @foreach ($sizes as $size)
                                            @if (isset($size['value']))
                                                <option value="{{ $size['value'] }}">{{ $size['value'] }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                @else
                                    <h5 class="text-info text-center">No size found</h5>
                                @endif
                            </div>
                            <div class="card-body text-center mt-3">
                                <a class="h6 link" href="{{ route('front.product', $product->slug) }}">{{ Illuminate\Support\Str::limit($product->title, 20) }}</a>
                                <div class="price mt-2">
                                    <span class="h5"><strong>{{ config('stripe.currency_symbol') }}{{ $product->price }}</strong></span>
                                    @if ($product->compare_price > 0)
                                        <span class="h6 text-underline"><del>{{ config('stripe.currency_symbol') }}{{ $product->compare_price }}</del></span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <h5 class="text-center text-danger">No Featured Products Found</h5>
            @endif
        </div>
    </div>
</section>

<section class="section-4 pt-5">
    <div class="container">
        <div class="section-title">
            <h2>Latest Produsts</h2>
        </div>    
        <div class="row pb-3">
            @if ( count($latestProducts)>0 )
                @foreach ($latestProducts as $product )
                    @php
                    $productImage = $product->products_images->first();   
                    @endphp
                    <div class="col-md-3">
                    <div class="card product-card">
                        <div class="product-image position-relative">
                            <a href="{{ route("front.product",$product->slug)}}" class="product-img">
                                {{-- <img class="card-img-top" src="{{asset('public/front-asset(project2)/images/product-1.jpg')}}" alt=""> --}}
                                @if (!empty($productImage))
                                <img src="{{ asset('public/uploads/product/small/'.$productImage->image) }}" alt="Product Image" class="card-img-top"/>
                            @else
                                <img src="{{asset('assets/admin/img/default-150x150.png')}}" class="text-danger img-thumbnail" width="50"/>
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
                        <div>
                            @if (!empty($product->size))
                                @php
                                    $sizes = json_decode($product->size, true);
                                @endphp
                                <select name="size" id="size-{{ $product->id }}" class="form-select">
                                    <option value="">Select Size</option>
                                    @foreach ($sizes as $size)
                                        @if (isset($size['value']))
                                            <option value="{{ $size['value'] }}">{{ $size['value'] }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            @else
                                <h5 class="text-info text-center">No size found</h5>
                            @endif
                        </div>                      
                        <div class="card-body text-center mt-3">
                            <a class="h6 link" href="{{ route("front.product",$product->slug)}}">{{ Illuminate\Support\Str::limit($product->title, 20) }}
                            </a>
                            <div class="price mt-2">
                                <span class="h5"><strong>{{config('stripe.currency_symbol')}}{{$product->price  }}</strong></span>
                                 @if ($product->compare_price>0)
                                 <span class="h6 text-underline"><del>{{config('stripe.currency_symbol')}}{{ $product->compare_price }}</del></span>
                                 @endif
                                 
                            </div>
                        </div>                        
                    </div>                                               
                </div>  
                @endforeach
                
            @else
            <h5 class="text-center text-danger">No Featured Products Found</h5>
            @endif           
        </div>
    </div>
</section> 
@endsection
