{{-- Project 2 --}}
@extends('layouts.admin')

@section('title', 'DiscountCoupons List')

@section('css')
@endsection

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>DiscountCoupons</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('coupons.create') }}" class="btn btn-primary">New Coupon</a>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="container-fluid">
        @include('layouts.message')
        <div class="card">
            <form action="" method="get">
                <div class="card-header">
                    <div class="card-title">
                        <button title="reset" type="button" onclick="window.location.href='{{ route('coupons.index') }}'" class="btn btn-default btn-sm">X</button>
                    </div>
                    <div class="card-tools">
                        <div class="input-group input-group" style="width: 250px;">
                            <input type="text" value="{{ Request::get('keyword') }}" name="keyword" class="form-control float-right" placeholder="Search">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <div class="card-body table-responsive p-0">
                @if (count($DiscountCoupons) > 0)
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th width="60">ID</th>
                                <th width="60">Code</th>
                                <th>Name</th>
                                <th>Discount</th>
                                <th>Type</th>
                                <th>StartDate</th>
                                <th>EndDate</th>
                                <th width="100">Status</th>
                                <th width="100">Details</th>
                                <th width="100">Action</th>
                            </tr>
                        </thead>
                        @foreach ($DiscountCoupons as $DiscountCoupon)
                            <tbody>
                                <tr>
                                    <td>{{ $DiscountCoupon->id ? $DiscountCoupon->id : '' }}</td>
                                    <td>{{ $DiscountCoupon->code ? $DiscountCoupon->code : '' }}</td>
                                    <td>{{ $DiscountCoupon->name ? $DiscountCoupon->name : '' }}</td>
                                    <td>
                                        @if ($DiscountCoupon->type == 'percent')
                                            {{ $DiscountCoupon->discount_amount }}%
                                        @else
                                            ${{ $DiscountCoupon->discount_amount }}
                                        @endif
                                    </td>
                                    <td>{{ $DiscountCoupon->type }}</td>
                                    <td>
                                        {{ (!empty($DiscountCoupon->starts_at)) ? \Carbon\Carbon::parse($DiscountCoupon->starts_at)->format('Y/m/d H:i:s A') : '' }}
                                    </td>
                                    <td>{{ $DiscountCoupon->expires_at ? $DiscountCoupon->expires_at : '' }}</td>
                                    <td>
                                        @if ($DiscountCoupon->status == 1)
                                            <svg class="text-success h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        @else
                                            <svg class="text-danger h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        @endif
                                    </td>
                                    <td>
                                        <button type="button" class="btn text-success" data-toggle="modal" data-target="#exampleModalCenter-{{ $DiscountCoupon->id }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                                <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
                                                <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7"/>
                                            </svg>
                                        </button>
                                        <!-- Modal -->
                                        @include('admin.coupon.common.coupon_details')
                                    </td>
                                    <td>
                                        <a href="{{ route('coupons.edit', $DiscountCoupon->id) }}">
                                            <svg class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                            </svg>
                                        </a>
                                        <a href="#" onclick="deleteCoupon({{ $DiscountCoupon->id }})" class="text-danger w-4 h-4 mr-1">
                                            <svg wire:loading.remove.delay="" wire:target="" class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        @endforeach
                    </table>
                    <div class="card-footer clearfix">
                        <ul class="pagination m-0 float-right">
                            {{ $DiscountCoupons->links() }}
                        </ul>
                    </div>
                @else
                    <h3 class="text-center text-danger">No Coupon Found</h3>
                @endif
            </div>
        </div>
    </div>
    <!-- /.card -->
</section>
<!-- /.content -->
@endsection

@section('scripts')
<script>
    function deleteCoupon(id) {
        var url = '{{ route('coupons.delete', 'ID') }}';
        var newUrl = url.replace('ID', id);

        // Use toastr for confirmation
        toastr.options = {
            closeButton: true,
            progressBar: true,
            preventDuplicates: true,
            positionClass: 'toast-top-right',
            // Change toastr color to green
            showMethod: 'slideDown',
            hideMethod: 'slideUp',
            showDuration: 300,
            hideDuration: 300,
            hideEasing: 'linear'
        };

        // Custom HTML for toastr buttons
        var toastrButtons = '<a type="button"  onclick="confirmDelete(\'' + newUrl + '\')">Yes</a>';

        toastr.warning(toastrButtons, 'Are you sure you want to delete?', {
            closeButton: true,
            timeOut: 0,
            extendedTimeOut: 0,
            // Use custom HTML content for buttons
            escapeHtml: false,
            // Override default buttons
            showCloseButton: false,
            extendedTimeOut: 0,
            tapToDismiss: false
        });
    }

    // Function to handle deletion confirmation
    function confirmDelete(url) {
        // If user clicks "Yes", proceed with deletion
        $.ajax({
            url: url,
            type: 'DELETE',
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.status) {
                    window.location.href = "{{ route('coupons.index') }}";
                }
            }
        });
    }
</script>



</script>

@endsection
