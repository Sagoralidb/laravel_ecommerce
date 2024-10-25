<div class="modal fade" id="exampleModalCenter-{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Product Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="row modal-body ">
                <div class="col-md-12">
                    <ul class="text-left">
                        <li>ID: {{ $product->id ? $product->id : '' }}</li>
                        <li>Status: {!! ($product->status==1) ? '<b class="text-success">Active</b>' : '<b class="text-danger">Blocked</b>' !!}</li>
                        <li>Published: {{ $product->created_at ? \Carbon\Carbon::parse($product->created_at)->setTimezone('Asia/Dhaka')->diffForHumans() . ' - ' . \Carbon\Carbon::parse($product->created_at)->setTimezone('Asia/Dhaka')->format('d M Y \a\t h:i A') : '' }}</li>
                        <li>Price:{{config('stripe.currency_symbol')}} {{ $product->price ? $product->price : '' }}</li>
                        <li>Compare Price:{{config('stripe.currency_symbol')}} {{ $product->compare_price ? $product->compare_price : '' }}</li>
                        <li>Quantity: {{ $product->qty ? $product->qty : '' }}</li>
                        <li>SKU: {{ $product->sku ? $product->sku : '' }}</li>
                       
                        @if (!empty($product->size))
                        @php
                            $sizes = json_decode($product->size, true); // `true` to get array
                        @endphp
                        <li style="overflow: hidden; word-wrap: break-word;">Size:
                           
                            @foreach ($sizes as $size)
                                @if (isset($size['value']))
                                    <span class="badge badge-primary"style="display: block; margin-bottom: 5px;">{{ $size['value'] }}</span>
                                @endif
                            @endforeach
                        </li>
                        @endif
                    
                    
                        <li>Barcode: {{ $product->barcode ? $product->barcode : '' }}</li>
                        <li>Category:{{ $product->category->name ??  '' }}</li>
                        <li>SubCategory:  {{ $product->subCategory->name ?? '' }}</li>
                        <p class="text-info">Sales accounting
                        <li><h6>Order Count: {{ $product->order_count ? $product->order_count : '0' }}</h6></li>
                        <li>Total Ordered Quantity: {{ $product->orderItems->sum('qty') }}</li>
                        <li class="text-success">Total Sold Quantity: {{ $product->soldQuantity() }}</li>
                        <li class="text-danger">Total Cancelled Quantity: {{ $product->CancelledQuantity() }}</li>
                        </p> 
                    </ul>
                </div>
                
                <h6 class="text-left text-success" style="white-space: pre-wrap; text-align: justify; overflow: hidden; word-wrap: break-word;">Title: {{ $product->title ? $product->title : '' }}</h6>
                <h6 style="white-space: pre-wrap; text-align: justify; overflow: hidden; word-wrap: break-word;"><b>Short Description:</b> {!! $product->short_description ? $product->short_description : '' !!}</h6>
                <h6 style="white-space: pre-wrap; text-align: justify; overflow: hidden; word-wrap: break-word;"><b>Description:</b>{!! $product->description ? $product->description : '' !!}</h6>
                <h6 style="white-space: pre-wrap; text-align: justify; overflow: hidden; word-wrap: break-word;"><b>Shipping & Returns:</b>{!! $product->shipping_returns ? $product->shipping_returns : '' !!}</h6>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>      