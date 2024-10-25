@extends('layouts.admin')
@section('title','Rating Manage')
@section('css')  
{{-- css --}}
@endsection


@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">					
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Products Ratings</h1>
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
                        <button title="reset" type="button" onclick="window.location.href='{{route('product.productRatings')}}' " class="btn btn-default btn-sm">X</button>
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
                <table class="table table-hover text-nowrap">
                    
                    <thead>
                        <tr>
                            <th width="60">ID</th>
                            <th>Product Title</th>
                            <th>Rating</th>
                            <th>Comment</th>
                            <th>Rated By</th>
                            <th width="100">Status</th>
                            <th width="100">View</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($ratings->isNotEmpty())
                        @foreach ($ratings as $rating)
                            <tr>
                                <td>{{ $rating->id }}</td>
                                <td>
                                    <a href="#">{{ Illuminate\Support\Str::limit($rating->productTitle, 30) }}</a>
                                </td>
                                <td>{{$rating->rating}}</td>
                                <td> 
                                    {{ Illuminate\Support\Str::limit($rating->comment, 30) }}
                                </td>
                                <td>{{$rating->username}}</td>												
                                <td>
                                    @include('admin.products2.common.rating_ststus')
                                </td>
                                <td>
                                    <button type="button" class="btn text-success" data-toggle="modal" data-target="#exampleModalCenter-{{ $rating->id }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
                                            <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7"/>
                                        </svg>
                                    </button>
                                    <!-- Modal -->
                                    @include('admin.products2.rating_details')
                                </td>
                                <td>
                                    <a href="#" onclick="deleteRating({{$rating->id}})" class="text-danger w-4 h-4 mr-1">
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
                                    <h4 class="text-center text-danger">No Product Rating Found </h4>
                                </td>
                            </tr>
                            
                        @endif
                        
                       
                    </tbody>
                </table>										
            </div>
            <div class="card-footer clearfix ">
                
                <ul class="pagination pagination m-0 float-right">
                 {{$ratings->links()}}
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
        function deleteRating(id) {
            var url = '{{ route("rating.delete", ":id") }}';
            url = url.replace(':id', id);
    
            if (confirm("Are you sure you want to delete?")) {
                $.ajax({
                    url: url,
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.status) {
                            alert(response.message);
                            window.location.href = "{{ route('product.productRatings') }}";
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status == 404) {
                            alert('Rating not found');
                        } else {
                            alert('An error occurred');
                        }
                    }
                });
            }
        }
//Status change
    function changeStatus(status,id) {
        if (confirm("Are you sure you want to change the status ?")) {
            $.ajax({
                url: '{{ route("product.changeRatingStatus")}}',
                type: 'get',
                data: {status:status, id:id},
                dataType: 'json',
                success: function (response) {
                     window.location.href = "{{ route('product.productRatings') }} ";

                }
            });
        }

    }
</script>
@endsection