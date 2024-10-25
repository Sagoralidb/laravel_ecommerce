@extends('layouts.admin')

@section('title','Shipping Charges')

@section('css')
    
@endsection

@section('content')


    <!-- Content Header (Page header) -->
<section class="content-header">
	<div class="container-fluid my-2">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1>Shipping Mangement</h1> 
            </div>
			{{-- <div class="col-sm-6 text-right"> <a href="{{route('shipping.create')}}" class="btn btn-primary">Back</a> </div> --}}
		</div>
	</div>
	<!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
	<!-- Default box -->
	<div class="container-fluid">
        @include('layouts.message')
		<form action="{{ route('categories.store') }}" method="POST" id="shipingForm" name="shipingForm" enctype="multipart/form-data"> @csrf
			<div class="card">
				<div class="card-body">
					<div class="row">
                            <div class="col-md-6">
                                <div class="mb-2">
                                    <select name="country" id="country" class="form-control">
                                        <option value=""disabled selected>Select a Country Location</option> 
                                        @if ($countries->isNotEmpty()) 
                                            @foreach ($countries as $country )
                                                <option value="{{ $country->id}}">{{ $country->name}}</option> 
                                            @endforeach
                                            <option value="rest_of_world" class="text-primary">Rest of The World</option> 
                                        @endif 
                                    </select>
                                    <p></p>
                                </div>
                            </div>

                                <div class="mb-3 ml-3">
                                    <input class="form-control" type="text" name="amount" id="amount" placeholder="Charage Amount">
                                    <p></p> 
                                </div>
                                <div class="mb-3 ml-3">
                                    <button type="submit" class="btn btn-primary">Create</button>
                                </div>
                           

                        </div>
                    </div>
                </div>
        </form>

        <div class="card">
            <div class="card-body">
                <div class="row">
                        <div class="col-md-12">
                            <table class="table table-striped">
                               <tr>
                                    <th>ID</th>
                                    <th>Country Location</th>
                                    <th>Amount</th>
                                    <th>Action</th>
                               </tr>
                                   @if ($shippingCharges->isNotEmpty())
                                       @foreach ($shippingCharges as $shippingCharg )
                                       <tr>
                                            <td>{{$shippingCharg->id}}</td>
                                            <td>
                                                {{($shippingCharg->country_id =='rest_of_world') ? 'Rest of The World': $shippingCharg->name }}
                                            </td>
                                            <td>{{config('stripe.currency_symbol')}} {{$shippingCharg->amount}}</td>
                                            <td>
                                                <a href="{{ route('shipping.edit',$shippingCharg->id)}}">
                                                    <svg class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                                    </svg>
                                                </a>
                                                <a href="javascript:void(0);" onclick="deleteRecord({{ $shippingCharg->id }})" class="text-danger w-4 h-4 mr-1">
                                                    <svg wire:loading.remove.delay="" wire:target="" class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                        <path	ath fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                                      </svg>
                                                </a>
                                            </td>
                                       </tr>
                                       @endforeach
                                   @endif
                            </table>
                        </div>
                </div>
            </div>
        </div>
     </div>
	<!-- /.card -->
</section>
<!-- /.content -->
</div>
@endsection

@section('scripts')
    <script>
       $("#shipingForm").submit(function(event) {
        event.preventDefault();
        var element = $(this);
        $("button[type=submit]").prop('disabled',true); 
        $.ajax({
            url: "{{ route('shipping.store') }}",
            type: 'post',
            data: element.serializeArray(),
            datatype: 'json',
            success: function(response) {
                $("button[type=submit]").prop('disabled',false); 
                if (response["status"] == true) {

                    window.location.href="{{route('shipping.create')}}";
                } else {
                    var errors = response['errors'];
                    if (errors['country']) {
                        $("#country").addClass('is-invalid')
                            .siblings('p')
                            .addClass('invalid-feedback').html(errors['country']);
                    } else {
                        $("#country").removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback').html("");
                    }

                    if (errors['amount']) {
                        $("#amount").addClass('is-invalid')
                            .siblings('p')
                            .addClass('invalid-feedback').html(errors['amount']);
                    } else {
                        $("#amount").removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback').html("");
                    }
                }
            },
            error: function(jqXHR, exception) {
                console.log("something is wrong, Refresh and try again");
            }
        });
    });
    // record delete function
     //delete mathods
     function deleteRecord(id) {
                var url = '{{ route("shipping.delete", "ID") }}';
                var newUrl = url.replace("ID", id);

                if (confirm("Are you sure you want to delete?")) {
                    $.ajax({
                        url: newUrl,
                        type: 'delete',
                        data: {},
                        dataType: 'json',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (response) {
                            if (response.status) { // Use response.status
                                window.location.href = "{{ route('shipping.create') }} ";
                            }
                        }
                    });
                }
            }
    
    </script>
@endsection