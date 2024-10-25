@extends('layouts.admin')

@section('title','Edit shipping Charges')

@section('css')
    
@endsection

@section('content')


    <!-- Content Header (Page header) -->
<section class="content-header">
	<div class="container-fluid my-2">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1>Edit Shipping Mangement</h1> </div>
			<div class="col-sm-6 text-right"> <a href="{{route('shipping.create')}}" class="btn btn-primary">Back</a> </div>
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
                                        <option value=""disabled selected>Select a Country Loaction</option> 
                                        @if ($countries->isNotEmpty()) 
                                            @foreach ($countries as $country )
                                                <option {{ ($shippingCharge->country_id == $country->id) ? 'selected':''}} value="{{ $country->id}}">{{ $country->name}}</option> 
                                            @endforeach
                                            <option {{ ($shippingCharge->country_id == 'rest_of_world') ? 'selected':''}} value="rest_of_world" class="text-primary">Rest of The World</option> 
                                        @endif 
                                    </select>
                                    <p></p>
                                </div>
                            </div>

                                <div class="mb-3 ml-3">
                                    <input class="form-control" type="text" name="amount" id="amount" value="{{ $shippingCharge->amount}}">
                                    <p></p> 
                                </div>
                                <div class="mb-3 ml-3">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                           

                        </div>
                    </div>
                </div>
        </form>
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
        url: "{{ route('shipping.update', $shippingCharge->id) }}",
        type: 'put',
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

  
    </script>
@endsection