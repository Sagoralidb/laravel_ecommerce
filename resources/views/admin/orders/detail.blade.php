@extends('layouts.admin')
@section('title','Order details')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">					
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Order: #{{$order->id ? $order->id: '' }}</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{route('order.index')}}" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header pt-3">
                            <div class="row invoice-info">
                                <div class="col-sm-4 invoice-col">
                                <h1 class="h5 mb-3">Shipping Address</h1>
                                <address>
                                    <strong>{{($order->first_name ? $order->first_name:''). ' '.($order->last_name? $order->last_name:'')}}</strong><br>
                                    {{$order->address ? $order->address: '' }}<br>
                                    {{$order->city ? 'City: ' .$order->city: '' }},{{$order->zip ?' Zip:' .$order->zip. ',': '' }} {{$order->countryName ? ' Country : '. $order->countryName: '' }}<br>
                                    Phone: {{$order->mobile ? $order->mobile: '' }}<br>
                                    Email: {{$order->email ? $order->email: '' }}
                                </address>
                                </div>
                                
                                
                                
                                <div class="col-sm-4 invoice-col">
                                    {{-- <b>Invoice #007612</b><br> --}}
                                    <br>
                                    <b>Order ID:</b> {{$order->id ? $order->id: '' }}<br>
                                    <b>Total:</b> {{config('stripe.currency_symbol')}} {{number_format($order->grand_total,2)}}<br>
                                    <b>Status:</b> 
                                    @if ($order->status== 'pending')
                                        <span class="badge text-danger">Pending</span>
                                    @elseif ($order->status=='shipped')
                                        <span class="badge text-info">Shipped</span>
                                    @elseif (($order->status=='cancelled'))
                                        <span class="badge text-danger">Cancelled</span>
                                    @else
                                        <span class="badge text-success">Delivered</span>
                                    @endif
                                    <br>
                                    <strong>
                                       @if ( !empty($order->shipped_date) )
                                        @php   
                                             echo "Shipped Date :" 
                                        @endphp
                                        {{\Carbon\Carbon::parse($order->shipped_date)->format('d,M,Y')}} 
                                     @else
                                        @php  
                                          echo "Shipped Date :" 
                                        @endphp
                                        N/A
                                     @endif 
                                    </strong>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="card-body table-responsive p-3">								
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Size</th>
                                        <th width="100">Price</th>
                                        <th width="100">Qty</th>                                        
                                        <th width="100">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orderItems as $Item)
                                    <tr>
                                        <td>{{$Item->name}}</td>
                                        <td>{{$Item->size}}</td>
                                        <td>{{config('stripe.currency_symbol')}} {{number_format($Item->price,2)}}</td>                                        
                                        <td>{{$Item->qty}}</td>
                                        <td>{{config('stripe.currency_symbol')}} {{number_format($Item->price*$Item->qty,2)}}</td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <th colspan="3" class="text-right">Subtotal:</th>
                                        <td>{{config('stripe.currency_symbol')}} {{number_format($order->subtotal,2)}}</td>
                                    </tr>
                                    <tr>
                                        <th colspan="3" class="text-right">Discount: {{(! empty($order->coupon_code)) ? '(' .$order->coupon_code.')':''}}</th>
                                        <td>{{config('stripe.currency_symbol')}} {{number_format($order->discount,2)}}</td>
                                    </tr>
                                    
                                    <tr>
                                        <th colspan="3" class="text-right">Shipping:</th>
                                        <td>{{config('stripe.currency_symbol')}} {{number_format($order->shipping,2)}}</td>
                                    </tr>
                                    <tr>
                                        <th colspan="3" class="text-right">Grand Total:</th>
                                        <td>{{config('stripe.currency_symbol')}} {{number_format($order->grand_total,2)}}</td>
                                    </tr>
                                </tbody>
                            </table>								
                        </div>                            
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                     <form action=""method='post' name="ChangeOrderStatusForm" id="ChangeOrderStatusForm">
                        @csrf
                        <div class="card-body">
                            <h2 class="h4 mb-3">Order Status</h2>
                            <div class="mb-3">
                                <select name="status" id="status" class="form-control">
                                    <option value="pending" {{($order->status=='pending') ? 'selected' : ''}}>Pending</option>
                                    <option value="shipped"{{($order->status=='shipped')  ? 'selected':''}}>Shipped</option>
                                    <option value="delivered"{{($order->status=='delivered')? 'selected':''}}>Delivered</option>
                                    <option value="cancelled"{{($order->status=='cancelled')? 'selected':''}}>Cancelled</option>
                                </select>
                                <div class="mb-3 mt-2">
                                    <label for="">Shipped Date</label>
                                    <input type="text" autocomplete="off" value="{{$order->shipped_date}}"  name="shipped_date" id="shipped_date" placeholder="Shipped date" class="form-control">
                                </div>
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </form>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <form action="" method="POST" name="sendInvoiceEmail" id="sendInvoiceEmail">
                                @csrf
                                <h2 class="h4 mb-3">Send Inovice Email</h2>
                                <div class="mb-3">
                                    <select name="userType" id="usmce39rType" class="form-control">
                                        <option value="mc"39>Customer</option>                                                
                                        <option value="admin">Admin</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary">Send</button>
                                </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
@endsection

@section('scripts')
<script>
    //Calender code
    $(document).ready(function(){
        $('#shipped_date').datetimepicker({
            // options here
            format:'Y-m-d H:i:s',
        }); 
    });
</script>
<script>
    $("#ChangeOrderStatusForm").submit(function(event){
        event.preventDefault();
        if(confirm("Are you sure want to change shipping status ?") ) {
            $.ajax({
            url:'{{route("order.changeOrderStatus", $order->id) }}',
            type: 'post',
            data: $(this).serializeArray(),
            dataType: 'json',
            success: function(response){
                if(response.status) {
                    // Set the session message to be displayed after redirection
                    sessionStorage.setItem('toastrMessage', response.message);
                    window.location.href = '{{ route('order.detail', $order->id) }}';
                }
            }
        });
        }
       
    });

    // Display the toastr message if it exists in sessionStorage
    $(document).ready(function() {
        var toastrMessage = sessionStorage.getItem('toastrMessage');
        if (toastrMessage) {
            toastr.success(toastrMessage);
            sessionStorage.removeItem('toastrMessage');
        }
    });

      // //sendInvoiceEmail form submit ajax 

      $(document).ready(function() {
    $("#sendInvoiceEmail").submit(function(event) {
        event.preventDefault();

        if(confirm("Are you sure you want to send email ?")) {
            // সাবমিট বাটনটি খুঁজে বের করা এবং ডিসএবল করা
            var submitButton = $(this).find('button[type="submit"]');
            submitButton.prop('disabled', true);
            submitButton.text('Sending...');

            $.ajax({
                url: '{{ route("order.sendInvoiceEmail", $order->id) }}',
                type: 'post',
                data: $(this).serializeArray(),
                dataType: 'json',
                success: function(response) {
                    if(response.status) {
                        toastr.success(response.message);
                        // সফল হলে পেজ রিডাইরেক্ট করার জন্য
                        // window.location.href = '{{ route("order.detail", $order->id) }}';
                    } else {
                        toastr.error('There was an error sending the email.');
                        submitButton.prop('disabled', false);
                        submitButton.text('Send');
                    }
                },
                error: function() {
                    toastr.error('An unexpected error occurred.');
                    submitButton.prop('disabled', false);
                    submitButton.text('Send');
                }
            });

            // "Sending..." বার্তা ৫ সেকেন্ড পর "Send" এ ফিরে আসবে
            setTimeout(function() {
                submitButton.prop('disabled', false);
                submitButton.text('Send');
            }, 5000);
        }
    });

    // অপশন পরিবর্তনের ক্লিক ইভেন্ট ম্যানেজ করা
    $("#userType").change(function() {
        var submitButton = $("#sendInvoiceEmail button[type='submit']");
        submitButton.prop('disabled', false);
        submitButton.text('Send');
    });
});


</script>
@endsection