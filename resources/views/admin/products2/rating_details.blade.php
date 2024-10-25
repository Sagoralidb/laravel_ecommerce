<div class="modal fade" id="exampleModalCenter-{{ $rating->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Coupon Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
                <h6>ID: {{ $rating->id ? $rating->id : '' }}</h6>
                <h6>Name: {{ $rating->username ? $rating->username : '' }}</h6>
                <h6>Rating: {{ $rating->rating ? $rating->rating : '' }}</h6>
                <h6>Product Title: {{ $rating->productTitle ? $rating->productTitle : '' }}</h6>
                <h6>Comments: <p style="white-space: pre-wrap; text-align: justify; overflow: auto; word-wrap: break-word;">{{ $rating->comment ? $rating->comment : '' }}
                            </p>
                </h6>
                 <h6 class=" btn btn-light">
                 Click to Change Status :<button class="btn  " type="button">@include('admin.products2.common.rating_ststus')</button> 
                 </h6>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>