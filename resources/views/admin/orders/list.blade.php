@extends('layouts.admin')

@section('title','Order List')

@section('css')
    
@endsection

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">					
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Order List</h1>
            </div>
            <div class="col-sm-6 text-right">
                {{-- <a href="#" class="btn btn-primary">New Category</a> --}}
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
                        <button title="reset" type="button" onclick="window.location.href='{{route('order.index')}}' " class="btn btn-default btn-sm">X</button>
                    {{-- <a href="{{route('categories.index')}}" class="btn">X</a> --}}
                    </div>
                <div class="card-tools">
                    <div class="input-group input-group" style="width: 250px;">
                        <input type="text" value="{{Request::get('keyword')}}" name="keyword" class="form-control float-right" placeholder="Search">
    
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
             @if (count($orders)>0)
                 <table class="table table-hover table-bordered text-nowrap">
                    <thead>
                        <tr>
                            <th>Orders#</th>
                            
                            <th class="text-success">Customer</th>
                            <th class="text-success">Customer Email</th>
                            <th class="text-success">Phone</th>
                            <th >Orders by</th>
                            <th>User Email</th>
                            <th>Status</th>
                            <th>Amount</th>
                            <th>Date Purchased</th>
                        </tr>
                    </thead>
                    @foreach ($orders as $order )
                        <tbody>
                        <tr>
                            <td> <a href="{{route('order.detail',$order->id)}}">#{{$order->id ? $order->id:'' }}</a> </td>
                            <td>
                                <a href="{{route('order.detail',$order->id)}}" class="btn text-success">
                                    {{$order->first_name ? $order->first_name:''}}
                                </a>
                            </td>
                            <td class="text-success">{{$order->email ? $order->email:''}}</td>
                            <td class="text-success">{{$order->mobile ? $order->mobile:''}}</td>
                            <td>{{$order->user_name ? $order->user_name:'N/A'}}</td>
                            <td>{{$order->user_email ? $order->user_email:''}}</td>
                            <td>
                            @if ($order->status== 'pending')
                                    <span class="badge text-danger">Pending</span>
                                @elseif ($order->status=='shipped')
                                    <span class="badge text-info">Shipped</span>
                                @elseif (($order->status=='cancelled'))
                                    <span class="badge text-danger">Cancelled</span>
                                @else
                                    <span class="badge text-success">Delivered</span>
                            @endif
                            </td>
                            <td>
                               {{config('stripe.currency_symbol')}}{{number_format($order->grand_total,2)}}
                            </td>
                            <td>
                                {{Carbon\Carbon::parse($order->created_at)->format('d,M,Y')}}
                            </td>
                        </tr>

                    </tbody>
                    @endforeach
                    
                </table>
            <div class="card-footer clearfix ‍  ">
              <ul class="pagination pagination m-0 float-right">
                {{ $orders->links() }}
                </ul>
            </div>
             @else
                 <h3 class="text-center text-danger">No Category Found</h3>
             @endif   							
                

            </div>
            
        </div>
    </div>
    <!-- /.card -->
</section>
<!-- /.content -->
@endsection
    @section('scripts')

    @endsection