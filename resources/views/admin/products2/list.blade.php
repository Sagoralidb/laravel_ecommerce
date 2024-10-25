@extends('layouts.admin')
@section('title','Product List')



@section('css')  
{{-- css --}}
@endsection


@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">					
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Products List</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{route('products.create')}}" class="btn btn-primary">New Product</a>
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
            <form action="" method="get" enctype="multipart/form-data" >          
                <div class="card-header">
                    <div class="card-title">
                        <button title="reset" type="button" onclick="window.location.href='{{route('products.index')}}' " class="btn btn-default btn-sm">X</button>
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
                <table class="table table-hover text-nowrap table-bordered">
                    
                    <thead class="table-active">
                        <tr class="text-center">
                            <th>ID</th>
                            <th>Image</th>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Qty</th>
                            <th>SKU</th>
                            <th>Category</th>
                            <th >Details</th>
                            <th >Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @if ($products2->isNotEmpty())
                        @foreach ($products2 as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>
                                    @php
                                        $productImage = $product->products_images->first();                       
                                    @endphp
                                    {{-- <img src="{{ asset('public/uploads/product/small/2-4-1714562431.jpeg') }}" alt="Product Image" class="img-thumbnail" width="50"/> --}}
                                    @if (!empty($productImage))
                                        <img src="{{ asset('public/uploads/product/small/'.$productImage->image) }}" alt="Product Image" class="img-thumbnail" width="50"/>
                                    @else
                                        <img src="{{asset('admin/img/default-150x150.png')}}" class="text-danger img-thumbnail" width="50"/>
                                    @endif
                                </td>

                                <td class="text-left"><a href="#" class="text-decoration-none">{{ \Illuminate\Support\Str::limit($product->title, 50) }}</a></td>
                                <td>{{config('stripe.currency_symbol')}} {{$product->price}}</td>
                                <td> {{$product->qty}} left in Stock</td>
                                <td>{{$product->sku}}</td>											
                                <td>
                                    {{ $product->category->name ?? '' }}
                                    <p class="text-info" >{{ $product->subCategory->name ?? '' }}</p>
                                   {{-- {{ $product->category->name }} --}}
                                </td>	
                                <td>
                                    <button type="button" class="btn text-success" data-toggle="modal" data-target="#exampleModalCenter-{{ $product->id }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
                                            <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7"/>
                                        </svg>
                                    </button>
                                    <!-- Modal -->
                                    @include('admin.products2.common.product-details')                         
                                </td>										
                                <td>
                                    @if ($product->status==1)
                                       <svg class="text-success-500 h-6 w-6 text-success" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg> 
                                    @else
                                    <svg class="text-danger h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    @endif
                                    
                                </td>
                                <td>
                                    <a href="{{route('products2.edit',$product->id)}}">
                                        <svg class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                        </svg>
                                    </a>
                                    <a href="#" onclick="deleteProduct({{ $product->id }})"  class="text-danger w-4 h-4 mr-1">
                                        <svg wire:loading.remove.delay="" wire:target="" class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path	ath fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                          </svg>
                                    </a>
                                </td>
                               
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td>
                                    <h4 class="text-center text-danger">No Product Found. Please create some new products </h4>
                                </td>
                            </tr>
                            
                        @endif
                        
                       
                    </tbody>
                </table>										
            </div>
            <div class="card-footer clearfix">
                
                <ul class="pagination pagination m-0 float-right">
                    {{$products2->links()}}
                </ul>
            </div>
        </div>
    </div>
    <!-- /.card -->
</section>
<!-- /.content -->
@endsection

@section('scripts')
<script>
    //delete mathods
    function deleteProduct(id) {
        var url = '{{ route("products2.delete", "ID") }}';
        var newUrl = url.replace("ID", id);

        if (confirm("Are you sure you want to delete?")) {
            $.ajax({
                url: newUrl,
                type: 'delete',
                data: {},
                dataType: 'json',
                 headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },
                success: function (response) {
                    if (response.status) { // Use response.status
                        window.location.href = "{{ route('products.index') }} ";
                    }else{
                        window.location.href = "{{ route('products.index') }} ";
                    }
                }
            });
        }
    }
</script>
@endsection