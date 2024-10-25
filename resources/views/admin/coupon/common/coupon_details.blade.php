<div class="modal fade" id="exampleModalCenter-{{ $DiscountCoupon->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Coupon Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h6>ID: {{ $DiscountCoupon->id ? $DiscountCoupon->id : '' }}</h6>
                <h6>Code: {{ $DiscountCoupon->code ? $DiscountCoupon->code : '' }}</h6>
                <h6>Name: {{ $DiscountCoupon->name ? $DiscountCoupon->name : '' }}</h6>
                <h6>Coupon Discount:
                    @if ($DiscountCoupon->type == 'percent')
                        {{ $DiscountCoupon->discount_amount }}%
                    @else
                        ${{ $DiscountCoupon->discount_amount }}
                    @endif
                </h6>
                <h6>Coupon Type: {{ $DiscountCoupon->type }}</h6>
                <h6>Maximum Use: {{ $DiscountCoupon->max_uses ? $DiscountCoupon->max_uses : '' }}</h6>
                <h6>Maximum User: {{ $DiscountCoupon->max_uses_user ? $DiscountCoupon->max_uses_user : '' }}</h6>
                <h6>Minimum Amount: ${{ $DiscountCoupon->min_amount ? $DiscountCoupon->min_amount : '' }}</h6>
                <h6>Status: {{ ($DiscountCoupon->status==1) ? 'Active':'Blocked' }}</h6>
                <h6>Coupon Start At: {{ $DiscountCoupon->starts_at ? $DiscountCoupon->starts_at : '' }}</h6>
                <h6>Coupon Expire At: {{ $DiscountCoupon->expires_at ? $DiscountCoupon->expires_at : '' }}</h6>
                <h6>Text:</h6>
                <h6 style="white-space: pre-wrap; text-align: justify; overflow: auto; word-wrap: break-word;">{{ $DiscountCoupon->description ? $DiscountCoupon->description : '' }}
                </h6>
                
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>