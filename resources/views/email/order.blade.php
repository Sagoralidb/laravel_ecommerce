<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order Email</title>
</head>
<body style="font-family: Arial, Helvetica, sans-serif;font-size:16px">
    @if ($mailData['userType'] == 'customer')
    <h2>Hello Mr/Ms.{{($mailData['order']->first_name ?:'')}}</h2>
    {{-- <h2>Hello Mr/Ms. {{ $mailData['user']->name ? $mailData['user']->name:'' }}</h2> --}}
    <h2>Thanks for your order!!</h2>
    <h2>Your Order Id is: #{{ $mailData['order']->id }}</h2>
    @else
        <h2>Hello Mr/Ms. {{ $mailData['userType'] == 'admin' ? 'Admin' : '' }}</h2>
        <h2>You have received an order from {{$mailData['order']->email }}</h2>
        <h2>Order Id is: #{{ $mailData['order']->id }}</h2>
    @endif

    

    <h2 class="h5 mb-3">Shipping Address</h2>
    <address>
        <strong>{{($mailData['order']->first_name ? $mailData['order']->first_name:''). ' '.($mailData['order']->last_name? $mailData['order']->last_name:'')}}</strong><br>
        {{$mailData['order']->address ? $mailData['order']->address: '' }}<br>
        {{$mailData['order']->city ? 'City: ' .$mailData['order']->city: '' }},{{$mailData['order']->zip ?' Zip:' .$mailData['order']->zip. ',': '' }} 
       
        {{ getCountryInfo($mailData['order']->country_id)->name ? 'Country: ' . getCountryInfo($mailData['order']->country_id)->name :''}}<br>

        Phone: {{$mailData['order']->mobile ? $mailData['order']->mobile: '' }}<br>
        Email: {{$mailData['order']->email ? $mailData['order']->email: '' }}<br><br><br>

        <b>Status:</b> 
            @if ($mailData['order']->status== 'pending')
                <span style="color:red">Pending</span>
            @elseif ($mailData['order']->status=='shipped')
                <span style="color:rgb(40, 194, 255)">Shipped</span>
            @elseif (($mailData['order']->status=='cancelled'))
                <span style="color:red">Cancelled</span>
            @else
                <span style="color:rgb(26, 241, 134)">Delivered</span>
            @endif
            <br>
            <strong>
                @if ( !empty($mailData['order']->shipped_date) )
                @php   
                        echo "Shipped Date :" 
                @endphp
                {{\Carbon\Carbon::parse($mailData['order']->shipped_date)->format('d,M,Y')}} 
                @else
                @php  
                    echo "Shipped Date :" 
                @endphp
                N/A
                @endif 
            </strong>
    </address>
    <h2> Products </h2>
    <div class="card-body table-responsive p-3">								
        <table cellpadding="3" cellspacing="3" border="0">
            <thead>
                <tr style="background: rgb(147, 190, 233)">
                    <th>Product</th>
                    <th>Size</th>
                    <th>Price</th>
                    <th>Qty</th>                                        
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($mailData['order']->items as $Item)
                <tr style="background: rgb(27, 240, 8)">
                    <td>{{$Item->name}}</td>
                    <td>{{$Item->size}}</td>
                    <td>{{config('stripe.currency_symbol')}}{{number_format($Item->price,2)}}</td>                                        
                    <td>{{$Item->qty}}</td>
                    <td>{{config('stripe.currency_symbol')}}{{number_format($Item->price*$Item->qty,2)}}</td>
                </tr>
                @endforeach
                <tr style="background: rgb(1, 247, 63)">
                    <th colspan="3" align="right">Subtotal:</th>
                    <td>{{config('stripe.currency_symbol')}}{{number_format($mailData['order']->subtotal,2)}}</td>
                </tr>
                <tr style="background: rgb(91, 247, 1)">
                    <th colspan="3" align="right">Discount: {{(! empty($mailData['order']->coupon_code)) ? '(' .$mailData['order']->coupon_code.')':''}}</th>
                    <td>{{config('stripe.currency_symbol')}}{{number_format($mailData['order']->discount,2)}}</td>
                </tr>
                
                <tr style="background: rgb(84, 194, 228)">
                    <th colspan="3" align="right">Shipping:</th>
                    <td>{{config('stripe.currency_symbol')}}{{number_format($mailData['order']->shipping,2)}}</td>
                </tr>
                <tr style="background: rgb(76, 137, 218)">
                    <th colspan="3" align="right">Grand Total:</th>
                    <td>
                        <strong>
                            {{config('stripe.currency_symbol')}}{{number_format($mailData['order']->grand_total,2)}}
                        </strong>
                        
                    </td>
                </tr>
              
                <tr style="background: rgb(147, 190, 233)">
                    <td>Contact us at Whatsapp: +8801773925952</td>
                </tr>
            </tbody>
        </table>								
    </div>
</body>
</html>