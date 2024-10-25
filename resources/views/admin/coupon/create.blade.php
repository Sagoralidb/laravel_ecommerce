@extends('layouts.admin')

@section('title','Create Coupon')

@section('css')
    
@endsection

@section('content')


    <!-- Content Header (Page header) -->
    <section class="content-header">					
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create Coupon</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{route('coupons.index')}}" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="container-fluid">
            <form action="{{ route('categories.store') }}" method="POST" id="discountForm" name="discountForm" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-body">								
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name"  class="text-danger">Code*</label>
                                    <input type="text" name="code" id="code" class="form-control" placeholder="Coupon code">	
                                <p></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name">Name</label>
                                    <input type="text"  name="name" id="name" class="form-control" placeholder="Coupon code name">	
                               <p></p>
                                </div>
                            </div>	
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name">Max Uses</label>
                                    <input type="text"  name="max_uses" id="max_uses" class="form-control" placeholder="Max Uses">
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name">Max Uses User</label>
                                    <input type="text"  name="max_uses_user" id="max_uses_user" class="form-control" placeholder="Max Uses User">
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="type">Type</label>
                                    <select name="type" id="type"class="form-control">
                                        <option value="percent">Percent</option>
                                        <option value="fixed">Fixed</option>
                                    </select>	
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="text-danger">Discount*</label>
                                    <input type="text"  name="discount_amount" id="discount_amount" class="form-control" placeholder="Discount amount">
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name">Minmum Amount</label>
                                    <input type="text"  name="min_amount" id="min_amount" class="form-control" placeholder="Minimum amount">
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="status">Status</label>
                                    <select name="status" id="status"class="form-control">
                                        <option value="1">Active</option>
                                        <option value="0">Block</option>
                                    </select>	
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="text-danger">Date: Starts At* </label>
                                    <input type="text" autocomplete="off"  name="starts_at" id="starts_at" class="form-control" placeholder="Select Started Date">
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name">Date: Expires At</label>
                                    <input type="text" autocomplete="off"  name="expires_at" id="expires_at" class="form-control" placeholder="Select expires At">
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name">Description</label>
                                   <textarea class="form-control" name="description" id="description" cols="30" rows="3"></textarea>	
                                    <p></p>
                                </div>
                            </div>

                        </div>
                    </div>							
                </div>
            <div class="pb-5 pt-3">
                <button type="submit" class="btn btn-primary">Create</button>
                <a href="{{route('coupons.index')}}" class="btn btn-outline-dark ml-3">Cancel</a>
            </div>
     
            </form>
            

           
        <!-- /.card -->
    </section>
    <!-- /.content -->
</div>

@endsection

@section('scripts')
<script>
    //Calender code
    $(document).ready(function(){
        $('#starts_at').datetimepicker({
            // options here
            format:'Y-m-d H:i:s',
        });
        $('#expires_at').datetimepicker({
            // options here
            format:'Y-m-d H:i:s',
        });
    });
</script>
    <script>
    
    // Discount Form Manage code....
       $("#discountForm").submit(function(event) {
    event.preventDefault();
    var element = $(this);
    $("button[type=submit]").prop('disabled',true); 
    $.ajax({
        url: "{{ route('coupons.store') }}",
        type: 'post',
        data: element.serializeArray(),
        datatype: 'json',
        success: function(response) {
            $("button[type=submit]").prop('disabled',false); 
            if (response["status"] == true) {

                window.location.href="{{route('coupons.index')}}";
                
                $("#code").removeClass('is-invalid')
                    .siblings('p')
                    .removeClass('invalid-feedback').html("");

                $("#discount_amountlug").removeClass('is-invalid')
                    .siblings('p')
                    .removeClass('invalid-feedback').html("");

                $("#starts_at").removeClass('is-invalid')
                    .siblings('p')
                    .removeClass('invalid-feedback').html(""); 

                $("#expires_at").removeClass('is-invalid')
                    .siblings('p')
                    .removeClass('invalid-feedback').html(""); 

            } else {

                var errors = response['errors'];
                if (errors['code']) {
                    $("#code").addClass('is-invalid')
                        .siblings('p')
                        .addClass('invalid-feedback').html(errors['code']);
                } else {
                    $("#code").removeClass('is-invalid')
                        .siblings('p')
                        .removeClass('invalid-feedback').html("");
                }
                if (errors['discount_amount']) {
                    $("#discount_amount").addClass('is-invalid')
                        .siblings('p')
                        .addClass('invalid-feedback').html(errors['discount_amount']);
                } else {
                    $("#discount_amount").removeClass('is-invalid')
                        .siblings('p')
                        .removeClass('invalid-feedback').html("");
                }
                if (errors['starts_at']) {
                    $("#starts_at").addClass('is-invalid')
                        .siblings('p')
                        .addClass('invalid-feedback').html(errors['starts_at']);
                } else {
                    $("#starts_at").removeClass('is-invalid')
                        .siblings('p')
                        .removeClass('invalid-feedback').html("");
                }
                if (errors['expires_at']) {
                    $("#expires_at").addClass('is-invalid')
                        .siblings('p')
                        .addClass('invalid-feedback').html(errors['expires_at']);
                } else {
                    $("#expires_at").removeClass('is-invalid')
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