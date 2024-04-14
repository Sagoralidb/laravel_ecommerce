@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                {{-- <div class="card-header">{{ __('Dashboard') }}</div> --}}
                <div class="card-header">Purchased Products</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{-- {{ __('You are logged in!') }} --}}
                    
                    @if ( count($purchasedProducts)>0)
                        <table class="table">
                       <thead>
                            <th>#</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Purchased Date</th>
                       </thead>
                       <tbody>
                            @foreach ($purchasedProducts as $key=> $product )
                                <tr>
                                    <td>{{$key + 1}}</td>
                                    <td>
                                       <img src="{{$product->image}}" alt="Product Image" width="40px;">
                                    </td>
                                    <td>{{$product->name}}</td>
                                    <td>{{$product->quantity}}</td>
                                    <td>{{$product->price}}</td>
                                    <td>{{ $product->created_at->diffForHumans() }} || {{ date('d-m-Y', strtotime($product->created_at)) }} </td>
                                </tr>
                            @endforeach      
                       </tbody>
                    </table>
                    @else
                        <h3 class="text-center text">No Purchased Product, Please <a href="{{route('site.home')}}" style="text-decoration:none" > Buy</a> Some Thing</h3>
                    @endif
                    

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
