@extends('project2_front.layouts.app')

@section('title', 'Cart Page')

@section('css')
<!-- Add your custom CSS here -->
@endsection

@section('content')
<section class="section-5 pt-3 pb-3 mb-3 bg-white">
    <div class="container">
        <div class="light-font">
            <ol class="breadcrumb primary-color mb-0">
                <li class="breadcrumb-item"><a class="white-text" href="{{ route('front.home') }}">Home</a></li>
                <li class="breadcrumb-item"><a class="white-text" href="{{ route('front.shop') }}">Shop</a></li>
                <li class="breadcrumb-item">Cart</li>
            </ol>
        </div>
    </div>
</section>

<section class="section-9 pt-4">
    <div class="container">
        @if (Cart::count() > 0)
        <div class="row">
            @if (Session::has('success'))
            <div class="col-md-12">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {!! Session::get('success') !!}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
            @endif
            @if (Session::has('error'))
            <div class="col-md-12">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {!! Session::get('error') !!}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
            @endif
            <div class="col-md-8">
                <div class="table-responsive">
                    <table class="table" id="cart">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Size</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cartContent as $item)
                            <tr>
                                <td class="text-start">
                                    <div class="d-flex align-items-center">
                                        @if (!empty($item->options->productImage->image))
                                        <img src="{{ asset('public/uploads/product/small/' . $item->options->productImage->image) }}" alt="Product Image"/>
                                        @else
                                        <img src="{{ asset('assets/admin/img/default-150x150.png') }}" class="text-danger img-thumbnail" width="50"/>
                                        @endif
                                        <h2>{{ Str::limit($item->name, 50) }}</h2>
                                    </div>
                                </td>
                                <td>
                                    @isset($productDetails[$item->id])
                                    @php
                                    $sizes = json_decode($productDetails[$item->id]->size);
                                    @endphp
                                    @if (!empty($sizes))
                                    <select name="size[{{ $item->rowId }}]" class="form-control custom-select mb-3 size-select" style="width: 80px" required data-rowid="{{ $item->rowId }}">
                                        @if (is_array($sizes))
                                        <option value="">Select</option>
                                        @foreach ($sizes as $size)
                                        <option value="{{ $size->value }}" {{ old('size.' . $item->rowId) == $size->value ? 'selected' : '' }}>{{ $size->value }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                    @endif
                                    @endisset
                                </td>
                                <td>{{ config('stripe.currency_symbol') }}{{ $item->price }}</td>
                                <td>
                                    <div class="input-group quantity mx-auto" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-dark btn-minus p-2 pt-1 pb-1 sub" data-id="{{ $item->rowId }}">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text" class="form-control form-control-sm border-0 text-center" value="{{ $item->qty }}">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-dark btn-plus p-2 pt-1 pb-1 add" data-id="{{ $item->rowId }}">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    {{ config('stripe.currency_symbol') }}{{ $item->price * $item->qty }}
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-danger" onclick="deleteItem('{{ $item->rowId }}');"><i class="fa fa-times"></i></button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card cart-summery">
                    <div class="card-body">
                        <div class="sub-title">
                            <h2 class="bg-white">Cart Summary</h2>
                        </div>
                        <div class="d-flex justify-content-between pb-2">
                            <div>Subtotal</div>
                            <div>{{ config('stripe.currency_symbol') }}{{ Cart::subtotal() }}</div>
                        </div>
                        <div class="d-flex justify-content-between summery-end">
                            <div>Total</div>
                            <div>{{ config('stripe.currency_symbol') }}{{ Cart::subtotal() }}</div>
                        </div>
                        <div class="pt-5">
                            <form id="checkoutForm" action="{{ route('front.checkout') }}" method="GET">
                                @csrf
                                @foreach ($cartContent as $item)
                                <input type="hidden" name="selectedSizes[{{ $item->rowId }}]" value="" class="selected-size-input" data-rowid="{{ $item->rowId }}">
                                @endforeach
                                <button type="submit" class="btn-dark btn btn-block w-100">Proceed to Checkout</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="card">
            <div class="card-body">
                <h3 class="text-danger text-center">Your Cart is empty.</h3>
            </div>
        </div>
        @endif
    </div>
</section>
@endsection

@section('script')<script>
    $(document).ready(function() {
        console.log('Script Loaded');

        // Add item quantity
        $('.add').click(function() {
            var qtyElement = $(this).parent().prev();
            var qtyValue = parseInt(qtyElement.val());
            if (qtyValue < 10) {
                qtyElement.val(qtyValue + 1);

                var rowId = $(this).data('id');
                var newQty = qtyElement.val();
                var size = $(this).closest('tr').find('.size-select').val();
                console.log('Add Clicked - RowId:', rowId, 'Qty:', newQty, 'Size:', size);
                updateCart(rowId, newQty, size);
            }
        });

        // Subtract item quantity
        $('.sub').click(function() {
            var qtyElement = $(this).parent().next();
            var qtyValue = parseInt(qtyElement.val());
            if (qtyValue > 1) {
                qtyElement.val(qtyValue - 1);

                var rowId = $(this).data('id');
                var newQty = qtyElement.val();
                var size = $(this).closest('tr').find('.size-select').val();
                console.log('Sub Clicked - RowId:', rowId, 'Qty:', newQty, 'Size:', size);
                updateCart(rowId, newQty, size);
            }
        });

        // Size change
        $('.size-select').change(function() {
            var rowId = $(this).data('rowid');
            var newQty = $(this).closest('tr').find('input.form-control').val();
            var size = $(this).val();
            console.log('Size Changed - RowId:', rowId, 'Qty:', newQty, 'Size:', size);
            updateCart(rowId, newQty, size);
        });

        function updateCart(rowId, qty, size) {
            console.log('Update Cart - RowId:', rowId, 'Qty:', qty, 'Size:', size);

            $.ajax({
                url: '{{ route('front.updateCart') }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    rowId: rowId,
                    qty: qty,
                    size: size
                },
                success: function(response) {
                    console.log('Update Cart Response:', response);
                    $('#cart').html(response.cartHtml);
                    $('.selected-size-input[data-rowid="' + rowId + '"]').val(size);
                    toastr.success(response.message); // Toastr success notification
                },
                error: function(xhr, status, error) {
                    console.error('Update Cart Error:', error);
                    toastr.error('Failed to update cart.'); // Toastr error notification
                }
            });
        }

        window.deleteItem = function(rowId) {
        console.log('Delete Item - RowId:', rowId);

        $.ajax({
            url: '{{ route('front.deleteItem.cart') }}',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                rowId: rowId
            },
            success: function(response) {
                console.log('Delete Item Response:', response);
                $('#cart').html(response.cartHtml);
                toastr.success(response.message); // Toastr success notification

                // Reload the page after 2 seconds
                setTimeout(function() {
                    location.reload();
                }, 2000);
            },
            error: function(xhr, status, error) {
                console.error('Delete Item Error:', error);
                toastr.error('Failed to remove item.'); // Toastr error notification
            }
        });
    }

});
</script>

<script>
    $(document).ready(function() {
    // Function to save selected size to session storage
    function saveSelectedSizes() {
        $('.size-select').each(function() {
            const rowId = $(this).data('rowid');
            const size = $(this).val();
            sessionStorage.setItem('size-' + rowId, size);
        });
    }

    // Function to load selected sizes from session storage
    function loadSelectedSizes() {
        $('.size-select').each(function() {
            const rowId = $(this).data('rowid');
            const savedSize = sessionStorage.getItem('size-' + rowId);
            if (savedSize) {
                $(this).val(savedSize);
            }
        });
    }

    // Load selected sizes when the page loads
    loadSelectedSizes();

    // Save selected sizes when the form is submitted
    $('#checkoutForm').submit(function(event) {
        saveSelectedSizes();
        let sizeSelected = true;
        $('.size-select').each(function() {
            if ($(this).val() === '') {
                sizeSelected = false;
                $(this).addClass('is-invalid');
            } else {
                $(this).removeClass('is-invalid');
                let rowId = $(this).data('rowid');
                $(this).closest('tr').find('.selected-size-input').val($(this).val());
            }
        });
        if (!sizeSelected) {
            event.preventDefault();
            alert('Please select a size for all items.');
        }
    });
});

</script>

@endsection