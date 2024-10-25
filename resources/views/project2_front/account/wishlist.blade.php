{{-- Project 2 --}}@extends('project2_front.layouts.app')

@section('title','Wish List')

@section('content')
<section class="section-5 pt-3 pb-3 mb-3 bg-white">
    <div class="container">
        <div class="light-font">
            <ol class="breadcrumb primary-color mb-0">
                <li class="breadcrumb-item"><a class="white-text" href="#">My Account</a></li>
                <li class="breadcrumb-item">Wish list</li>
            </ol>
        </div>
    </div>
</section>

<section class="section-11">
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-3">
                @include('project2_front.account.common.sidebar')
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <h2 class="h5 mb-0 pt-2 pb-2">My Wish list</h2>
                    </div>
                    <div class="card-body p-4">
                        @if (count($wishlists) > 0)
                            @foreach ($wishlists as $wishlist)
                            <div class="d-sm-flex justify-content-between mt-lg-4 mb-4 pb-3 pb-sm-2 border-bottom" id="wishlist-item-{{ $wishlist->product_id }}">
                                <div class="d-block d-sm-flex align-items-start text-center text-sm-start">
                                    @php
                                        $productImage = getProductImage($wishlist->product_id);
                                    @endphp
                                    <a class="d-block flex-shrink-0 mx-auto me-sm-4" href="{{ route('front.product', $wishlist->product->slug) }}" style="width: 10rem;">
                                        @if (!empty($productImage))
                                            <img src="{{ asset('public/uploads/product/small/' . $productImage->image) }}" alt="Product Image" class="img-fluid" style="border-radius:5%">
                                        @else
                                            <img src="{{ asset('assets/admin/img/default-150x150.png') }}" class="text-danger img-thumbnail" width="50"/>
                                        @endif
                                    </a>
                                    <div class="pt-2">
                                        <h5 class="product-title fs-base mb-2">
                                            <a href="{{ route('front.product', $wishlist->product->slug) }}">{{ $wishlist->product->title }}</a>
                                        </h5>
                                        <div class="fs-lg text-accent pt-2">
                                            <small>
                                                <span class="h5"><strong>${{ $wishlist->product->price }}</strong></span>
                                                @if ($wishlist->product->compare_price > 0)
                                                    <span class="h6 text-underline"><del>${{ $wishlist->product->compare_price }}</del></span>
                                                @endif
                                            </small>
                                        </div>
                                    </div>
                                </div>
                                <div class="pt-2 ps-sm-3 mx-auto mx-sm-0 text-center">
                                    <button onclick="removeProduct({{ $wishlist->product_id }});" class="btn btn-outline-danger btn-sm" type="button" data-product-id="{{ $wishlist->product_id }}">
                                       Remove
                                    </button>
                                </div>
                            </div> 
                            @endforeach
                        @else
                            <h4 class="text-danger text-center">Wish list is empty now</h4>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('script')
<script>
    function removeProduct(id) {
        $.ajax({
            url: '{{ route('account.remove_Wishlist_Product') }}',
            type: 'post',
            data: {id: id, _token: '{{ csrf_token() }}'},
            dataType: 'json',
            success: function(response) {
                if (response.status) {
                    // Remove the product from the DOM
                    $('#wishlist-item-' + id).remove();
                    // Display success message
                    toastr.success(response.message);
                } else {
                    // Display error message
                    toastr.error(response.message);
                }
            },
            error: function() {
                toastr.error('An error occurred while removing the wishlist item.');
            }
        });
    }
</script>
@endsection
